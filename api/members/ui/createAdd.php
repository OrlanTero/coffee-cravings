<?php

require __DIR__ . "../../../../database.php";
include "../../../system.php";

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
                        <span>ADD MEMBER</span>
                    </div>
                </div>
            </div>
            <div class="popup-body">
                <form action="" class="popup-form" method="post">
                    <div class="form-group">
                        <input type="text" name="lastname" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstname" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="middlename" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Adress">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Phone Number">
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
                                <span>Save</span>
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