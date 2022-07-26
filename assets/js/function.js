export function Ajax({ type, url, success, error, data, formData }) {
  let request = new XMLHttpRequest();
  let form = new FormData();

  request.onreadystatechange = function () {
    if (request.readyState == XMLHttpRequest.DONE) {
      if (request.status == 200) {
        success && success(request.responseText);
      } else if (request.status == 400) {
        error && error("There was an error 400");
      } else {
        error && error("something else other than 200 was returned");
      }
    }
  };

  if (data) {
    Object.entries(data).forEach((pair) => form.append(pair[0], pair[1]));
  }

  request.open(type, url, true);
  request.send((data ? form : false) || formData);
}

export function ListenToCombo(element, callback) {
  const items = element.querySelectorAll(".item");
  const input = element.querySelector("input");

  input.addEventListener(
    "change",
    () => callback && callback(input.getAttribute("data-value"))
  );

  for (const item of items) {
    item.addEventListener("click", () => {
      callback && callback(input.getAttribute("data-value"));
    });
  }
}

export function GetComboItem(value, element) {
  const items = element.querySelectorAll(".item");

  for (const item of items) {
    const val = item.getAttribute("value");
    const text = item.querySelector("span").textContent;
    const data = { value: val, text };

    if (val === value) {
      return data;
    } else if (text.toLowerCase() === value) {
      return data;
    }
  }

  return null;
}

export function ManageComboBoxes() {
  const CUSTOMCOMBOBOXS = document.querySelectorAll(".custom-combo-box");

  for (const combo of CUSTOMCOMBOBOXS) {
    const main = combo.querySelector(".content");
    const floating = combo.querySelector(".floating-container");
    const items = floating.querySelectorAll(".item");
    const input = combo.querySelector("input");

    const reset = () => {
      for (const item of items) {
        item.classList.remove("hide");
      }
    };

    const onChange = () => {
      let find = false;

      for (const item of items) {
        const text = item.querySelector("span").textContent.toLowerCase();

        if (text === input.value.toLowerCase()) {
          find = true;
          break;
        }
      }

      if (!find) input.value = "";
    };

    const search = (toSearch) => {
      if (toSearch.length) {
        for (const item of items) {
          const text = item.querySelector("span").textContent.toLowerCase();
          if (text.indexOf(toSearch.toLowerCase()) >= 0) {
            item.classList.remove("hide");
          } else {
            if (!item.classList.contains("hide")) {
              item.classList.add("hide");
            }
          }
        }
      } else reset();
    };

    for (const item of items) {
      item.addEventListener("click", () => {
        input.value = item.querySelector("span").textContent;
        input.setAttribute("data-value", item.getAttribute("value"));
        combo.classList.remove("show");
      });
    }

    main.addEventListener("click", () => combo.classList.add("show"));

    input.addEventListener("input", () => search(input.value));

    input.addEventListener("change", () => onChange());

    input.addEventListener("blur", () => {
      if (input.value.length === 0) {
        reset();
      }
    });

    FNOnClickOutside(combo, (outside) => {
      outside && combo.classList.remove("show");
    });
  }
}

export function ManageCheckBoxes() {
  const CHECKBOXES = document.querySelectorAll(".custom-checkbox-parent");

  for (const ch of CHECKBOXES) {
    const cc = ch.querySelector(".circle");
    const ck = ch.querySelector("input");

    cc.addEventListener("click", (e) => {
      ck.click();
    });
  }
}

export function FNOnClickOutside(element, callback) {
  window.addEventListener("click", function (e) {
    if (callback) {
      callback(!element.contains(e.target), e.target);
    }
  });
}

export function UpdateTable(tableData, ...callbacks) {
  const GRIDTABLE = document.querySelector(".grid-table-container");
  const TABLECONTENT = GRIDTABLE.querySelector(".table-content");

  TABLECONTENT.innerHTML = tableData;
  TableListener(...callbacks);
}

export function TableListener(
  onAdd,
  onEdit,
  onDelete,
  onRefresh,
  onFilter,
  onButton
) {
  const GRIDTABLE = document.querySelector(".grid-table-container");
  const HEADER = document.querySelector(".grid-table-header");
  const BODY = document.querySelector(".grid-table-body");
  const MAINCKBOX = HEADER.querySelector(".table-checkbox");
  const ITEMS = BODY.querySelectorAll(".body-item");
  const SELECTEDBTN = GRIDTABLE.querySelector(".table-selected-button");
  const EDITBTN = GRIDTABLE.querySelector(".table-edit-button");
  const DELETEBTN = GRIDTABLE.querySelector(".table-deleted-button");
  const ADDBTN = GRIDTABLE.querySelector(".table-add-button");
  const REFRESHBTN = GRIDTABLE.querySelector(".table-refresh-button");
  const FILTERITEMS = GRIDTABLE.querySelectorAll(
    ".table-filter .floating-container .item"
  );
  const IDS = [...new Array(ITEMS.length)].map((_, i) => {
    return ITEMS[i].getAttribute("data-id");
  });

  let SELECTEDITEMS = [];

  const show = (element, bool) => {
    if (element) {
      if (bool) {
        element.classList.remove("hide");
      } else {
        element.classList.add("hide");
      }
    }
  };

  const selectItem = (item, select, unselect) => {
    const checkbox = item.querySelector("input");
    const id = item.getAttribute("data-id");

    if (checkbox) {
      if ((select && !unselect) || !checkbox.checked) {
        if (!SELECTEDITEMS.includes(id)) {
          SELECTEDITEMS.push(id);
        }
        item.classList.add("selected");
        checkbox.checked = true;
      } else {
        SELECTEDITEMS = SELECTEDITEMS.filter((i) => i !== id);
        item.classList.remove("selected");
        checkbox.checked = false;
      }
    }
    update();
  };

  const update = () => {
    if (MAINCKBOX) {
      MAINCKBOX.checked = SELECTEDITEMS.length === ITEMS.length;
    }

    show(EDITBTN, SELECTEDITEMS.length === 1);
    show(DELETEBTN, SELECTEDITEMS.length !== 0);
    show(SELECTEDBTN, SELECTEDITEMS.length !== 0);
    if (SELECTEDBTN) {
      SELECTEDBTN.querySelector("span").textContent =
        SELECTEDITEMS.length + " Items Selected";
    }
  };

  const findItem = (id) => {
    for (const item of ITEMS) {
      if (item.getAttribute("data-id") === id) {
        return item;
      }
    }
  };

  const check = (bool, arr) => {
    for (const body of arr || SELECTEDITEMS) {
      selectItem(findItem(body), true, !bool);
    }
  };

  const reset = () => {
    check(false);
    SELECTEDITEMS = [];
    update();
  };

  const listeners = () => {
    for (const item of ITEMS) {
      const button = item.querySelector(".icon-button");
      item.addEventListener("click", () => selectItem(item));

      if (button) {
        button.addEventListener("click", () => {
          onButton && onButton(item.getAttribute("data-id"), reset);
        });
      }
    }

    for (const item of FILTERITEMS) {
      item.addEventListener("click", () => {
        onFilter && onFilter(item.querySelector("span").textContent, reset);
      });
    }

    MAINCKBOX &&
      MAINCKBOX.addEventListener("change", () => {
        check(MAINCKBOX.checked, IDS);
        update();
      });

    SELECTEDBTN &&
      SELECTEDBTN.addEventListener("click", () => check(false, SELECTEDITEMS));

    ADDBTN && ADDBTN.addEventListener("click", () => onAdd && onAdd(reset));

    EDITBTN &&
      EDITBTN.addEventListener("click", () => {
        if (SELECTEDITEMS.length !== 0)
          onEdit && onEdit(SELECTEDITEMS[0], reset);
      });

    DELETEBTN &&
      DELETEBTN.addEventListener("click", () => {
        if (SELECTEDITEMS.length !== 0)
          onDelete && onDelete(SELECTEDITEMS, reset);
      });

    REFRESHBTN &&
      REFRESHBTN.addEventListener("click", () => onRefresh && onRefresh(reset));
  };

  reset();
  listeners();
}

export function ToData(obj) {
  const data = new FormData();

  for (const pair of Object.entries(obj)) {
    data.append(pair[0], pair[1]);
  }

  return Object.fromEntries(data);
}

export function PostQuery(url, data) {
  return new Promise((resolve) => {
    Ajax({
      url: url,
      type: "POST",
      data: data,
      success: resolve,
    });
  });
}

export function RemovePopup() {
  const POPUP = document.querySelector(".popup-container");
  POPUP.innerHTML = "";
}

export function CreatePopup(data, callback, except = [], somecallback = false) {
  const POPUP = document.querySelector(".popup-container");

  const listener = () => {
    const SAVE = POPUP.querySelector(".popup-save-button");
    const CANCEL = POPUP.querySelector(".popup-cancel-button");
    const FORM = POPUP.querySelector(".popup-form");
    const INPUTS = FORM ? FORM.querySelectorAll("input") : [];
    const IMAGEUPLOAD = FORM ? FORM.querySelector(".image-upload") : null;
    const PREVIEWIMAGE = POPUP.querySelector(".preview-image");
    const CLOSE = document.querySelector(".popup-close-button");
    const VerifyFormData = (formdata, except = []) => {
      let status = true;
      let empty = [];

      for (const pair of formdata.entries()) {
        if (!except.includes(pair[0])) {
          if (typeof pair[1] == "object") {
            if (!pair[1].size) {
              status = false;
              empty.push(pair[0]);
            }
          } else {
            if (pair[1].length === 0) {
              status = false;
              empty.push(pair[0]);
            }
          }
        }
      }

      return { status, empty };
    };

    const FindParent = (el, cn) => {
      let parent = el.parentNode;

      while (parent && !false) {
        if (parent.classList.contains(cn)) {
          find = true;
          break;
        }

        parent = parent.parentNode;
      }

      return parent;
    };

    const ApplyError = (inputErr) => {
      for (const input of INPUTS) {
        const parent = FindParent(input, "form-group");

        if (inputErr.includes(input.getAttribute("name"))) {
          parent.classList.add("error");
        } else {
          parent.classList.remove("error");
        }
      }
    };

    const Save = () => {
      if (FORM) {
        const formdata = new FormData(FORM);
        const verify = VerifyFormData(formdata, except);

        ApplyError(verify.empty);

        if (verify.status) {
          callback && callback(formdata);
        }
      } else {
        callback && callback();
      }
    };

    const Cancel = () => {
      if (confirm("Are you sure you want to cancel?")) {
        POPUP.innerHTML = "";
      }
    };

    const Preview = (e) => {
      const image = PREVIEWIMAGE.querySelector("img");

      if (e.target.files.length) {
        image.setAttribute("src", URL.createObjectURL(e.target.files[0]));
        PREVIEWIMAGE.classList.remove("hide");
      }
    };

    SAVE && SAVE.addEventListener("click", () => Save());
    CANCEL && CANCEL.addEventListener("click", () => Cancel());
    IMAGEUPLOAD && IMAGEUPLOAD.addEventListener("change", (e) => Preview(e));
    CLOSE && CLOSE.addEventListener("click", () => (POPUP.innerHTML = ""));
    somecallback !== false && somecallback(POPUP);
  };

  POPUP.innerHTML = data;
  ManageComboBoxes();
  listener();
}

export function CheckOverflow(el) {
  var curOverf = el.style.overflow;

  if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";

  var isOverflowing =
    el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;

  el.style.overflow = curOverf;

  return isOverflowing;
}

export function NotifAlert(msg, stat, callback) {
  if (stat == 1) {
    callback && callback();
    alert(msg || "Successfully Added!");
  } else {
    alert("Something's not right, please try again!");
  }
}
