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

function AddMember(item) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/members/addMember.php",
      type: "POST",
      data: Object.fromEntries(item),
      success: resolve,
    });
  });
}

function EditItem(member) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/members/editMember.php",
      type: "POST",
      data: Object.fromEntries(member),
      success: resolve,
    });
  });
}

function RemoveItems(members) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/members/removeMembers.php",
      type: "POST",
      data: members,
      success: resolve,
    });
  });
}

function GetMembersTable() {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/members/getMembersTable.php",
      type: "POST",
      success: resolve,
    });
  });
}

function Update() {
  GetMembersTable().then((table) => {
    UpdateTable(table, onAdd, onEdit, onDelete, onRefresh, onFilter, onButton);
    RELOADED = false;
  });
}

function onAdd(reset) {
  Ajax({
    url: "./api/members/ui/createAdd.php",
    type: "POST",
    success: (popup) => {
      CreatePopup(popup, (data) => {
        AddMember(data).then((res) => {
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
    RELOADED = true;
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
          UpdateTable(
            res,
            onAdd,
            onEdit,
            onDelete,
            onRefresh,
            onFilter,
            onButton
          );
          reset();
          resolve();
        }
      },
    });
  });
}

function onSearch(search) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/members/searchMembers.php",
      type: "POST",
      data: ToData({ search }),
      success: (res) => {
        if (res) {
          UpdateTable(
            res,
            onAdd,
            onEdit,
            onDelete,
            onRefresh,
            onFilter,
            onButton
          );
          resolve();
        }
      },
    });
  });
}

function onEdit(member, reset) {
  Ajax({
    url: "./api/members/ui/createEdit.php",
    type: "POST",
    data: ToData({ member }),
    success: (popup) => {
      CreatePopup(
        popup,
        (data) => {
          data.append("member_id", member);
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

function onDelete(members, reset) {
  Ajax({
    url: "./api/members/ui/createDelete.php",
    type: "POST",
    data: ToData({ members }),
    success: (popup) => {
      CreatePopup(popup, () => {
        RemoveItems(ToData({ members })).then((res) => {
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

function onButton(member, reset) {
  Ajax({
    url: "./api/members/ui/createPointsContainer.php",
    type: "POST",
    data: ToData({ member }),
    success: (popup) => {
      CreatePopup(popup, () => {});
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const SEARCHENGINE = document.querySelector(".table-search-engine");
  const FILTERTABLE = document.querySelector(".table-filter input");

  TableListener(onAdd, onEdit, onDelete, onRefresh, onFilter, onButton);
  ManageComboBoxes();
  ManageCheckBoxes();
  SEARCHENGINE.addEventListener("input", () => onSearch(SEARCHENGINE.value));
});
