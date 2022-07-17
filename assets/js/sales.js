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

function RemoveItems(items) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/sales/removeSalesReports.php",
      type: "POST",
      data: items,
      success: resolve,
    });
  });
}

function GetItemsTable() {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/sales/getSalesReportTable.php",
      type: "POST",
      success: resolve,
    });
  });
}

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

function Update() {
  GetItemsTable().then((table) => {
    UpdateTable(table, null, null, onDelete, onRefresh, null, onButton);
    RELOADED = false;
  });
}

function onRefresh(reset) {
  Update();

  if (!RELOADED) {
    alert("Updated!");
    RELOADED = false;
  }
}

function onSearch(search) {
  return new Promise((resolve) => {
    Ajax({
      url: "./api/sales/searchSalesReports.php",
      type: "POST",
      data: ToData({ search }),
      success: (res) => {
        if (res) {
          UpdateTable(res, null, null, onDelete, onRefresh, null, onButton);
          resolve();
        }
      },
    });
  });
}

function onDelete(reports, reset) {
  Ajax({
    url: "./api/sales/ui/createDelete.php",
    type: "POST",
    data: ToData({ reports }),
    success: (popup) => {
      CreatePopup(popup, () => {
        RemoveItems(ToData({ reports })).then((res) => {
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

function onButton(sale_report) {
  const link = "./sales_report.php?report_id=" + sale_report;
  window.open(link, "_blank");
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
            window.open(link, "_blank");
          }
        });
      });
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const SEARCHENGINE = document.querySelector(".table-search-engine");
  const GENERATE = document.querySelector(".table-generate-button");

  TableListener(null, null, onDelete, onRefresh, null, onButton);
  ManageComboBoxes();
  ManageCheckBoxes();
  SEARCHENGINE.addEventListener("input", () => {
    onSearch(SEARCHENGINE.value);
  });

  GENERATE.addEventListener("click", () => onGenerate());
});
