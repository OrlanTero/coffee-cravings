import {
  Ajax,
  ManageCheckBoxes,
  ManageComboBoxes,
  TableListener,
  ToData,
  UpdateTable,
  CreatePopup,
  RemovePopup,
  NotifAlert,
} from "./function.js";

let RELOADED = false;

function AddItem(item) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/addItem.php",
      type: "POST",
      data: Object.fromEntries(item),
      success: resolve,
    });
  });
}

function EditItem(item) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/editItem.php",
      type: "POST",
      data: Object.fromEntries(item),
      success: resolve,
    });
  });
}

function RemoveItems(items) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/removeItems.php",
      type: "POST",
      data: items,
      success: resolve,
    });
  });
}

function GetItemsTable() {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/getItemsTable.php",
      type: "POST",
      success: resolve,
    });
  });
}

function Update() {
  GetItemsTable().then((table) => {
    UpdateTable(table, onAdd, onEdit, onDelete, onRefresh, onFilter);
    RELOADED = false;
  });
}

function onAdd(reset) {
  Ajax({
    url: "./api/items/ui/createAdd.php",
    type: "POST",
    success: (popup) => {
      CreatePopup(popup, (data) => {
        AddItem(data).then((res) => {
          NotifAlert("Successfully Added!", res, () => {
            RemovePopup();
            reset();
          });
          Update();
        });
      });
    },
  });
}

function onRefresh(reset) {
  Update();
  
  if (!RELOADED) {
    alert("Updated!");
    RELOADED = false;
  }
}

function onFilter(data, reset) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/filtertable.php",
      type: "POST",
      data: ToData({ filter: data }),
      success: (res) => {
        if (res) {
          UpdateTable(res, onAdd, onEdit, onDelete, onRefresh, onFilter);
          reset();
          resolve();
        }
      },
    });
  });
}

function onSearch(search, filter) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/items/searchItems.php",
      type: "POST",
      data: ToData({ search, filter }),
      success: (res) => {
        if (res) {
          UpdateTable(res, onAdd, onEdit, onDelete, onRefresh, onFilter);
          resolve();
        }
      },
    });
  });
}

function onEdit(item, reset) {
  Ajax({
    url: "./api/items/ui/createEdit.php",
    type: "POST",
    data: ToData({ item }),
    success: (popup) => {
      CreatePopup(
        popup,
        (data) => {
          data.append("product_id", item);
          EditItem(data).then((res) => {
            NotifAlert("Successfully Edited!", res, () => {
              RemovePopup();
              reset();
            });
            Update();
          });
        },
        ["image"]
      );
    },
  });
}

function onDelete(items, reset) {
  Ajax({
    url: "./api/items/ui/createDelete.php",
    type: "POST",
    data: ToData({ items }),
    success: (popup) => {
      CreatePopup(popup, () => {
        RemoveItems(ToData({ items })).then((res) => {
          NotifAlert("Successfully Removed!", res, () => {
            RemovePopup();
            reset();
          });
          Update();
        });
      });
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const SEARCHENGINE = document.querySelector(".table-search-engine");
  const FILTERTABLE = document.querySelector(".table-filter input");

  TableListener(onAdd, onEdit, onDelete, onRefresh, onFilter);
  ManageComboBoxes();
  ManageCheckBoxes();
  SEARCHENGINE.addEventListener("input", () => {
    onSearch(SEARCHENGINE.value, FILTERTABLE.value);
  });
});
