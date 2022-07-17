<?php

include "../../../system.php";

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
                        <span>GENERATE SALES REPORT</span>
                    </div>
                </div>
            </div>
            <div class="popup-body">
                <form action="" class="popup-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="with-label" style="width: 100%;">
                            <label for="">
                                <span>Choose start date </span>
                            </label>
                            <input type="date" name="fromDate" placeholder="Item Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="with-label" style="width: 100%;">
                            <label for="">
                                <span>Choose end date </span>
                            </label>
                            <input type="date" name="toDate" placeholder="Item Price">
                        </div>
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
                                <span>Generate</span>
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