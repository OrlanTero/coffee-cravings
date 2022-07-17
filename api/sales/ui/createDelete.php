<?php

require __DIR__ . "../../../../database.php";
include "../../../system.php";

$REPORTS = $_POST["reports"];
?>


<div class="popup-container-parent">
    <div class="popup-background"></div>
    <div class="popup-content">
        <div class="popup-container">
            <div class="popup-header">
                <div class="icon-title">
                    <div class="icon">
                        <?php echo UseIcon("delete") ?>
                    </div>
                    <div class="title">
                        <span>DELETING <?php echo count(explode(",", $REPORTS)) ?> REPORTS</span>
                    </div>
                </div>
            </div>
            <div class="popup-body">
                <p>Are you sure you want delete this reports?</p>
            </div>
            <div class="popup-footer">
                <div class="center-container">
                    <div class="flex-content">
                        <div class="icon-button blue popup-save-button">
                            <div class="icon">
                                <?php echo UseIcon("check") ?>
                            </div>
                            <div class="text">
                                <span>Delete</span>
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