import {
  Ajax,
  ManageCheckBoxes,
  ManageComboBoxes,
  TableListener,
  ToData,
  UpdateTable,
  CreatePopup,
} from "./function.js";
let RELOADED = false;

function GetSalesReport(data) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/orders/createSalesReport.php",
      type: "POST",
      data: Object.fromEntries(data),
      success: resolve,
    });
  });
}

function GetOrdersTable() {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/orders/getOrdersTable.php",
      type: "POST",
      success: resolve,
    });
  });
}

function Update() {
  GetOrdersTable().then((table) => {
    UpdateTable(table, null, null, null, onRefresh, null, onButton);
    RELOADED = false;
  });
}

function onRefresh(reset) {
  Update();
  if (!RELOADED) {
    alert("Updated!");
    RELOADED = true;
  }
}

function onSearch(search) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/orders/searchOrders.php",
      type: "POST",
      data: ToData({ search }),
      success: (res) => {
        if (res) {
          UpdateTable(res, null, null, null, onRefresh, null, onButton);
          resolve();
        }
      },
    });
  });
}

function onButton(order, reset) {
  Ajax({
    url: "./api/orders/ui/createProductOrderPopup.php",
    type: "POST",
    data: ToData({ order }),
    success: (popup) => {
      CreatePopup(popup, () => {});
    },
  });
}

function onGenerate() {
  Ajax({
    url: "./api/orders/ui/addSalesReport.php",
    type: "POST",
    success: (popup) => {
      CreatePopup(popup, (data) => {
        GetSalesReport(data).then((id) => {
          console.log(id);
          if (!id) {
            alert("Sorry, But there is no record from that timestamps");
          } else {
            const link = "./sales_report.php?report_id=" + id;
            window.location.assign(link);
          }
        });
      });
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const SEARCHENGINE = document.querySelector(".table-search-engine");
  const GENERATE = document.querySelector(".table-generate-button");

  TableListener(null, null, null, onRefresh, null, onButton);
  ManageComboBoxes();
  ManageCheckBoxes();
  SEARCHENGINE.addEventListener("input", () => onSearch(SEARCHENGINE.value));
  GENERATE.addEventListener("click", () => onGenerate());
});
