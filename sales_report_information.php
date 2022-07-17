<?php

include "./system.php";
include "./database.php";
include  "./data.php";

$SALESREPORT = GetSalesReports(null,$database);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" constent="width=device-width, initial-scale=1.0">
    <title>Coffee 'n Cravings</title>

    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="program-content">
        <div class="main-header">
            <div class="header-top">
                <div class="top-button">
                    <a href="./index.php" class="text-button">
                        <div class="icon">
                            <?php echo UseIcon("back") ?>
                        </div>
                        <div class="text">
                            <span>BACK</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="header-bot">
                <div class="header-left">
                    <span>Welcome to Coffee N' Cravings Management System!</span>
                    <p>Find sales reports</p>
                </div>
                <div class="header-right">
                    <div class="search-engine-container">
                        <input type="text" class="search-engine table-search-engine"
                            placeholder="Search reports data...">
                        <div class="search-button">
                            <div class="text">
                                <span>Search</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-body">
            <div class="center-container">
                <div class="grid-table-container">
                    <div class="table-info-container">
                        <div class="info-left">
                            <div class="title">
                                <h1>SALES REPORTS INFORMATION</h1>
                            </div>
                        </div>
                        <div class="info-right">

                            <div class="icon-button table-deleted-button hide">
                                <div class="icon">
                                    <?php echo UseIcon("delete") ?>
                                </div>
                                <div class="text">
                                    <span>Delete</span>
                                </div>
                            </div>

                            <div class="icon-button table-generate-button">
                                <div class="icon">
                                    <?php echo UseIcon("check") ?>
                                </div>
                                <div class="text">
                                    <span>Generate Sales Report</span>
                                </div>
                            </div>

                            <div class="icon-button table-refresh-button">
                                <div class="icon">
                                    <?php echo UseIcon("refresh") ?>
                                </div>
                                <div class="text">
                                    <span>Refresh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-content">
                        <?php echo CreateTable($SALESREPORTINFOHEADERTEXT, $SALESREPORTINFOKEY, $SALESREPORT, "report_id", 5) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-container"></div>
    </div>

    <script src="./assets/js/sales.js" type="module"></script>
</body>

</html>