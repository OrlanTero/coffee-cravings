<?php

include "./system.php";
include "./database.php";
include  "./data.php";

$CATEGORIES = GetCategories($database);
$PRODUCTS = GetProducts(null, $database);

$CATS = array_map(function ($cat) {
    return [
        "category_name" => $cat["category_name"],
        "category_id" => $cat["category_id"],
        "active" => false,
    ];
}, $CATEGORIES);

array_unshift($CATS, [
    "category_name" => "ALL",
    "category_id" => null,
    "active" => true,
]);

if (empty($CATS)) {
    CreateCategories($LOCALCATEGORIES, $database);
}



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
        <div class="flex-two-row">
            <div class="row-1">
                <div class="main-header large">
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
                            <p>Let's Proceed with the order</p>
                        </div>
                        <div class="header-right">
                            <div class="search-engine-container">
                                <input type="text" class="search-engine table-search-engine"
                                    placeholder="Search menu items...">
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
                        <div class="grid-table-container full-width">
                            <div class="table-info-container">
                                <div class="info-left">
                                    <div class="title">
                                        <h1>COFFEE N' CRAVINGS MENU</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-table-items">
                                <div class="table-header">
                                    <?php foreach ($CATS as $category) : ?>
                                    <div class="header-button" data-id="<?php echo $category["category_id"] ?>"
                                        data-category="<?php echo $category["category_name"] ?>">
                                        <div
                                            class="icon-button big <?php echo $category["active"] ? "selected" : "" ?>">
                                            <div class="text">
                                                <span><?php echo $category["category_name"] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="table-content">
                                    <?php echo CreateProductTableOfItems($PRODUCTS, $PRODUCTIMAGEPATHUPLOADS) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row-2 check-out-container">
                <?php echo CreateOrderCheckoutContainer($database) ?>
            </div>
        </div>
        <div class="popup-container"></div>
    </div>

    <script src="./assets/js/cashierss.js" type="module"></script>
</body>

</html>