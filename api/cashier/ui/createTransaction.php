<?php

require __DIR__ . "../../../../database.php";
include "../../../system.php";

$ORDER = json_decode($_POST["order"]);
$SUMMARY = $ORDER->summary;
$PRODUCTS = $ORDER->orders;
$PREORDERID = $_POST["pre_order_id"];

$CATEGORIES = GetCategories($database);
?>


<div class="popup-container-parent">
    <div class="popup-background"></div>
    <div class="popup-content">
        <div class="popup-container">
            <div class="popup-header">
                <div class="icon-title">
                    <div class="icon">
                        <?php echo UseIcon("plus-circle") ?>
                    </div>
                    <div class="title">
                        <span>ORDER #<?php echo $PREORDERID ?></span>
                    </div>
                </div>
                <div class="preview-image hide">
                    <div class="preview">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
            <div class="popup-body">
                <form action="" class="popup-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="texts">
                            <h3>TO PAY: <span>PHP <?php echo $SUMMARY->total ?></span></h3>
                            <h3>AMMOUNT RECEIVE: <span class="receive">PHP 0</span></h3>
                            <h3>CHANGE: <span class="change">PHP 0</span></h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="amount" placeholder="Ammount Recieve">
                    </div>
                </form>
            </div>
            <div class="popup-footer">
                <div class="center-container">
                    <div class="flex-content">
                        <div class="icon-button blue popup-save-button">
                            <div class="icon">
                                <?php echo UseIcon("check") ?>
                            </div>
                            <div class="text">
                                <span>Proceed</span>
                            </div>
                        </div>
                        <div class="icon-button red popup-cancel-button">
                            <div class="icon">
                                <?php echo UseIcon("back") ?>
                            </div>
                            <div class="text">
                                <span>Cancel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>