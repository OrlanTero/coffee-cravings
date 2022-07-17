import {
  Ajax,
  CreatePopup,
  GetComboItem,
  ListenToCombo,
  ManageCheckBoxes,
  ManageComboBoxes,
  NotifAlert,
  RemovePopup,
  ToData,
} from "./function.js";

let CURRENT_PRODUCT_CATEGORY = "ALL";
const VALUES = {
  SELECTEDMEMBER: [],
  SELECTED: [],
  ORDERS: [],
  ORDERSUBMITED: false,
};

let SUMMARY = {
  total: 0,
  subtotal: 0,
  redeem: 0,
  earned: 0,
  discount: 0,

  pointsBefore: 0,
  pointsAfter: 0,
};

function CreateOrderItem(item) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/cashier/createOrderItem.php",
      type: "POST",
      data: ToData({ item }),
      success: (i) => resolve(JSON.parse(i)),
    });
  });
}

function AddOrder(pre_order_id, order) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/cashier/addOrder.php",
      type: "POST",
      data: { order: JSON.stringify(order), pre_order_id },
      success: resolve,
    });
  });
}

function CreateTransaction(pre_order_id, order) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/cashier/ui/createTransaction.php",
      type: "POST",
      data: { order: JSON.stringify(order), pre_order_id },
      success: (popup) => {
        CreatePopup(popup, resolve, [], (popup) => {
          const input = popup.querySelector("input[name=amount]");
          const receive = popup.querySelector(".receive");
          const change = popup.querySelector(".change");

          input.addEventListener("input", () => {
            const ch = parseFloat(
              parseFloat(input.value) - parseFloat(order.summary.total)
            );

            receive.innerHTML = "PHP " + input.value;
            change.innerHTML = "PHP " + ch ?? "";
          });
        });
      },
    });
  });
}

function GetMember(member) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/cashier/getMember.php",
      type: "POST",
      data: ToData({ member }),
      success: (i) => resolve(JSON.parse(i)),
    });
  });
}

function onSearch(search, category, reset) {
  Ajax({
    url: "./api/cashier/searchProducts.php",
    type: "POST",
    data: ToData({ search, category }),
    success: (table) => Update(table, category, reset),
  });
}

function ManageOrderInfo() {
  const POINTDISCOUNTS = {
    3: 0.02,
    5: 0.05,
    10: 0.12,
    20: 0.25,
  };

  const resetValues = () => {
    VALUES.SELECTEDMEMBER = [];
    VALUES.SELECTED = [];
    VALUES.ORDERS = [];
    VALUES.ORDERSUBMITED = false;

    SUMMARY = {
      total: 0,
      subtotal: 0,
      redeem: 0,
      earned: 0,
      discount: 0,

      pointsBefore: 0,
      pointsAfter: 0,
    };

    ApplySelected([]);
    listener();
  };

  const resetForm = () => {
    const CONTAINER = document.querySelector(".check-out-container");

    Ajax({
      url: "./api/cashier/createCheckoutContainer.php",
      type: "POST",
      success: (container) => {
        CONTAINER.innerHTML = container;
        ManageCheckBoxes();
        ManageComboBoxes();
        resetValues();
      },
    });
  };

  const submitOrder = () => {
    const isMember = VALUES.SELECTEDMEMBER.length;
    const PREORDERID = document
      .querySelector(".pre-order-content")
      .getAttribute("data-id");
    if (VALUES.ORDERSUBMITED) return;

    const restruct = (order) => {
      order.product_id = order.product.product_id;
      delete order.product;
      return order;
    };

    const data = {
      isMember,
      member: isMember ? VALUES.SELECTEDMEMBER[0].member_id : null,
      orders: VALUES.ORDERS.map(restruct),
      summary: SUMMARY,
    };

    if (confirm("Do you really want to proceed with this order?")) {
      console.log(PREORDERID, data);

      CreateTransaction(PREORDERID, data).then(() => {
        RemovePopup();
        AddOrder(PREORDERID, data).then((res) => {
          NotifAlert("Order Successfully Added!", res);
          resetForm();
        });
      });
    }
  };

  const getOrder = (id) => {
    return VALUES.ORDERS.filter((i) => i.id === id)[0];
  };

  const getProduct = (id) => {
    const TABLE = document.querySelector(".body-grid-table");
    const PRODUCTS = TABLE.querySelectorAll(".body-grid-table-item");

    for (const product of PRODUCTS) {
      const pid = product.getAttribute("data-id");

      if (pid === id) return product;
    }

    return null;
  };

  const getitem = (id) => {
    const ORDERINFO = document.querySelector(
      ".order-information-container-parent"
    );
    const FORM = ORDERINFO.querySelector(".order-info-form");
    const ORDERSCONTAINER = FORM.querySelector(".products-order-container");
    const ITEMS = ORDERSCONTAINER.querySelectorAll(".item");

    for (const item of ITEMS) {
      if (item.getAttribute("data-id") === id) {
        return item;
      }
    }

    return null;
  };

  const applyOrder = () => {
    const ORDERINFO = document.querySelector(
      ".order-information-container-parent"
    );
    const FORM = ORDERINFO.querySelector(".order-info-form");
    const TXTREDEEM = FORM.querySelector(".text-redeem");
    const TXTDISCOUNT = FORM.querySelector(".text-discounts");
    const TXTEARNED = FORM.querySelector(".text-earned");
    const TXTTOTAL = FORM.querySelector(".text-total");
    const TXTSUBTOTAL = FORM.querySelector(".text-sub-total");
    const TXTTOTALPTS = FORM.querySelector(".text-total-points");
    TXTREDEEM.textContent = SUMMARY.redeem;
    TXTDISCOUNT.textContent = SUMMARY.discount;
    TXTEARNED.textContent = SUMMARY.earned;
    TXTTOTALPTS.textContent = SUMMARY.pointsAfter;
    TXTSUBTOTAL.textContent = "PHP " + SUMMARY.subtotal;
    TXTTOTAL.textContent = "PHP " + SUMMARY.total;
  };

  const getPointsBefore = () => {
    return VALUES.SELECTEDMEMBER.length ? parseFloat(VALUES.SELECTEDMEMBER[0].points) : 0
  }

  const computeOrder = () => {
    const hasMember = VALUES.SELECTEDMEMBER.length > 0;
    const wantRedeem = SUMMARY.redeem > 0;
    let total = 0;
    let subtotal = 0;
    let percentage = 0;
    let discount = 0;
    let pointsAfter = SUMMARY.pointsBefore;

    SUMMARY.pointsBefore = getPointsBefore()

    // IF USER WANTS TO REDEEM POINTS - NO POINTS TO EARN
    // IF WALK IN - NO POINTS T O EARN
    // Member - CAN EARN POINTS 

    if (VALUES.ORDERS.length) {
      total = VALUES.ORDERS.map((o) => o.total).reduce((a, b) => a + b);
      subtotal = total;

      if (wantRedeem && hasMember) {
        pointsAfter -= SUMMARY.redeem;
        percentage = POINTDISCOUNTS[SUMMARY.redeem];

        if (percentage) {
          discount = total * percentage;
          total -= discount;
        }

        SUMMARY.earned = 0;
      } else if (!wantRedeem && hasMember) {
        percentage = POINTDISCOUNTS[SUMMARY.redeem];

        if (percentage) {
          discount = total * percentage;
          total -= discount;
          pointsAfter -= SUMMARY.redeem;
        }

        SUMMARY.earned = parseFloat((total / 150).toFixed(2));

      } else {
        SUMMARY.earned = 0;
        SUMMARY.discount = 0;
      }
    } else {
      SUMMARY.earned = 0;
    }

    SUMMARY.total = total;
    SUMMARY.subtotal = subtotal;
    SUMMARY.discount = parseFloat(discount.toFixed(2));

    SUMMARY.pointsAfter = parseFloat(
      (pointsAfter + SUMMARY.earned).toFixed(2)
    );

    applyOrder();
  };

  const removeProduct = (id) => {
    const element = getitem(id);
    element && element.remove();
    VALUES.SELECTED = VALUES.SELECTED.filter((s) => s !== id);
    VALUES.ORDERS = VALUES.ORDERS.filter((i) => i.id !== id);
  };

  const selectProduct = (product, targetID) => {
    if (product !== null) {
      const id = product.getAttribute("data-id");
      const already = VALUES.SELECTED.includes(id);
      const ORDERINFO = document.querySelector(
        ".order-information-container-parent"
      );
      const FORM = ORDERINFO.querySelector(".order-info-form");
      const ORDERSCONTAINER = FORM.querySelector(".products-order-container");
      if (!already) {
        VALUES.SELECTED.push(id);
        product.classList.add("selected");

        CreateOrderItem(id).then(({ product, element }) => {
          const item = document.createElement("SPAN");
          item.innerHTML = element;

          ORDERSCONTAINER.appendChild(item);

          addItemListener(item, id);

          item.scrollIntoView();

          VALUES.ORDERS.push({
            id: id,
            product: product,
            quantity: 1,
            price: parseInt(product.price),
            total: parseInt(product.price),
          });

          computeOrder();
        });
      } else {
        product.classList.remove("selected");
        removeProduct(id);
        computeOrder();
      }
    } else {
      removeProduct(targetID);
      computeOrder();
    }
  };

  const addProductListener = (product) => {
    product.addEventListener("click", () => {
      selectProduct(product);
    });
  };

  const addItemListener = (item, id) => {
    const price = item.querySelector(".item-left .text span");
    const add = item.querySelector(".item-right .add-btn");
    const minus = item.querySelector(".item-right .minus-btn");
    const input = item.querySelector(".item-right input[name=text]");
    const deletebtn = item.querySelector(".delete-item-button");

    const compute = () => {
      const order = getOrder(id);

      order.quantity = parseInt(input.value);
      order.total = order.price * order.quantity;
      price.textContent = "PHP " + order.total;

      computeOrder();
    };

    add.addEventListener("click", () => {
      input.value = parseInt(input.value) + 1;
      compute();
    });

    minus.addEventListener("click", () => {
      if (parseInt(input.value) - 1 > 0) {
        input.value = parseInt(input.value) - 1;
        compute();
      }
    });

    deletebtn.addEventListener("click", () =>
      selectProduct(getProduct(id), id)
    );
  };

  const setMember = (id) => {
    const ORDERINFO = document.querySelector(
      ".order-information-container-parent"
    );
    const FORM = ORDERINFO.querySelector(".order-info-form");
    const POINTSINPUT = FORM.querySelector("input[name=points]");
    const REDEEMINPUT = FORM.querySelector("input[name=redeem]");

    GetMember(id).then((data) => {
      VALUES.SELECTEDMEMBER[0] = data;
      SUMMARY.pointsBefore = data.points;
      POINTSINPUT.value = data.points > 0 ? data.points + " Points" : "N/A";
      REDEEMINPUT.value = "";
      computeOrder();
    });
  };

  const tableListener = () => {
    const TABLE = document.querySelector(".body-grid-table");
    const PRODUCTS = TABLE.querySelectorAll(".body-grid-table-item");

    PRODUCTS.forEach((prodct) => addProductListener(prodct));

    const BUTTONS = document.querySelectorAll(".table-header .header-button");

    const reset = () => {
      for (const btn of BUTTONS) {
        btn.querySelector(".icon-button").classList.remove("selected");
      }
    };

    BUTTONS.forEach((btn) =>
      btn.addEventListener("click", () => {
        onFilter(btn.getAttribute("data-category"), tableListener);
        reset();
        btn.querySelector(".icon-button").classList.add("selected");
      })
    );
  };

  const listener = () => {
    const ORDERINFO = document.querySelector(
      ".order-information-container-parent"
    );

    const FORM = ORDERINFO.querySelector(".order-info-form");
    const COMBO = FORM.querySelector(".member_combo");
    const INPUT = COMBO.querySelector("input[name=member_combo]");
    const REDEEMINPUT = FORM.querySelector("input[name=redeem]");
    const REDEEMCOMBO = FORM.querySelector(".redeem");
    const REFRESHBTN = FORM.querySelector(".refresh-members-button");
    const MEMBERID = FORM.querySelector("input[name=member_id]");
    const CHECKOUTBUTTON = FORM.querySelector(".checkout-button");

    REFRESHBTN.addEventListener("click", () => resetForm());

    ListenToCombo(COMBO, function (member) {
      MEMBERID.value = member;
      setMember(member);
    });

    MEMBERID.addEventListener("change", () => {
      const member = GetComboItem(MEMBERID.value, COMBO);

      if (member) {
        INPUT.value = member.text;
        setMember(MEMBERID.value);
      } else {
        INPUT.value = "";
      }
    });

    ListenToCombo(REDEEMCOMBO, (value) => {
      if (VALUES.SELECTEDMEMBER.length) {
        const points = parseInt(VALUES.SELECTEDMEMBER[0].points);
        const percentage = POINTDISCOUNTS[value];

        if (percentage) {
          if (points >= value) {
            SUMMARY.redeem = parseInt(value);
          } else {
            REDEEMINPUT.value = null;
            SUMMARY.redeem = 0;
            alert("Not Enough points");
          }
        } else {
          REDEEMINPUT.value = null;
          SUMMARY.redeem = 0;
          alert("Invalid Redeem Amount, Choose only from 3, 5, 10 and 20");
        }
        if (percentage && points >= value) {
          SUMMARY.redeem = parseInt(value);

        } else {
          REDEEMINPUT.value = null;
          SUMMARY.redeem = 0;
        }
      }
      computeOrder();
    });

    CHECKOUTBUTTON.addEventListener("click", () => {
      if (VALUES.ORDERS.length) {
        submitOrder();
      } else {
        alert("No Orders");
      }
    });
  };

  resetValues();
  tableListener();
  const SEARCHENGINE = document.querySelector(".table-search-engine");

  SEARCHENGINE.addEventListener("input", () => {
    onSearch(SEARCHENGINE.value, CURRENT_PRODUCT_CATEGORY, tableListener);
  });
}

function ApplySelected(selects) {
  const items = document.querySelectorAll(".body-grid-table-item");
  for (const item of items) {
    if (selects.includes(item.getAttribute("data-id"))) {
      item.classList.add("selected");
    } else {
      if (item.classList.contains("selected")) {
        item.classList.remove("selected");
      }
    }
  }
}

function Update(table, category, reset) {
  const TABLECONTENT = document.querySelector(".table-content");
  TABLECONTENT.innerHTML = table;
  CURRENT_PRODUCT_CATEGORY = category;
  ApplySelected(VALUES.SELECTED);
  if (reset) reset();
}

function onFilter(filter, reset) {
  Ajax({
    url: "./api/cashier/filterProducts.php",
    type: "POST",
    data: ToData({ filter }),
    success: (table) => Update(table, filter, reset),
  });
}

document.addEventListener("DOMContentLoaded", () => {
  ManageCheckBoxes();
  ManageComboBoxes();
  ManageOrderInfo();
});
