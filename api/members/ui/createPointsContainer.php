<?php

require __DIR__ . "../../../../database.php";
include "../../../system.php";
include "../../../data.php";

$MEMBER = $_POST["member"];
$ORDERS = GetOrders(["member_id" => $MEMBER], $database);
$MEMBERINFO = GetMember($MEMBER, $database);
?>

<div class="popup-container-parent">
    <div class="popup-background"></div>
    <div class="popup-content">
        <div class="popup-long-container">
            <div class="popup-close-button">
                <div class="icon">
                    <?php echo UseIcon("close") ?>
                </div>
            </div>
            <div class="popup-header"></div>
            <div class="popup-body">
                <div class="center-container">
                    <div class="grid-table-container">
                        <div class="table-info-container">
                            <div class="info-left">
                                <div class="headline">
                                    <div class="sub-title">
                                        <h3>Member: <?php echo $MEMBERINFO["fullname"] ?></h3>
                                        <h3>Member ID: <?php echo $MEMBERINFO["member_id"] ?></h3>
                                    </div>
                                    <div class="title">
                                        <h1>POINTS HISTORY</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="info-right">
                            </div>
                        </div>
                        <div class="table-content">
                            <?php echo CreateTable(
                                $POINTSTABLEHEADERTEXT,
                                $POINTSTABLEBODYKEY,
                                $ORDERS,
                                "order_id",
                                -1,
                                true
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>