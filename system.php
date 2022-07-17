<?php

include __DIR__ . "./functions.php";

function UseIcon($name, $p = '')
{
    $SOME = empty($p) ? '' : $p;
    $PATH = __DIR__ . "/" . $SOME . "assets/media/icons/";
    $ICON = $PATH . $name . ".svg";

    if (file_exists($ICON)) {
        return file_get_contents($ICON);
    }
    else {
        return null;
    }
}


function ToKeysObj($data, $key, $keyText)
{
    $keys = [];

    foreach ($data as $item) {
        $value = ["value" => $item[$key], "text" => $item[$keyText]];

        array_push(
            $keys,
            $value
        );
    }

    return $keys;
}


function CreateComboBox($name, $value, $contents, $placeholder = "")
{
    $output = '
            <div class="custom-combo-box ' . $name . '">
                <div class="content">
                    <input type="text" name="' . $name . '" value="' . $value . '" placeholder="' . $placeholder . '">
                    <div class="icon">';
    $output .= UseIcon("down");
    $output .= '</div></div>';
    $output .= '<div class="floating-container">';

    foreach ($contents as $item) {
        if (isset($item["value"])) {
            $output .= '
                        <div class="item" value="' . $item["value"] . '"><span>' . $item["text"] . '</span></div>
                    ';
        }
        else {
            $output .= '
                        <div class="item"><span>' . $item . '</span></div>
                    ';
        }
    }

    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

function CreateCheckbox()
{
    $output = '
    <div class="custom-checkbox-parent">
        <div class="checkbox-content">
            <div class="circle"></div>
            <label class="custom-checkbox">
                <input type="checkbox" class="table-checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
    ';

    return $output;
}


function CreateTable($headeritems, $bodyitems, $data, $idname, $button = -1, $nocheckbox = false, $scrollable = true)
{

    $output = '<div class="custom-grid-table ' . ($scrollable ? '' : "no-scroll") . '">
                <table>';

    $output .= '<thead class="grid-table-header"><tr>';

    if (!$nocheckbox) {
        $output .= '<th>' . CreateCheckbox() . '</th>';
    }

    foreach ($headeritems as $item) {
        $output .= '<th>' . $item . '</th>';
    }

    $output .= '</tr></thead>';

    $output .= '<tbody class="grid-table-body">';

    foreach ($data as $item) {

        $output .= '<tr class="body-item" data-id="' . $item[$idname] . '">';

        if (!$nocheckbox) {
            $output .= '<td>' . CreateCheckbox() . '</td>';
        }

        if ($button >= 0) {
            $btnitems = array_fill(0, $button, $button);
            $bitem = array_fill(0, count($bodyitems), $item);
            $ranged = range(0, $button);
            $contents = array_map(function ($key, $val, $r, $b) {
                return $r === $b - 1 ? $key : ($val === null ? "" : $val[$key]);
            }, $bodyitems, $bitem, $ranged, $btnitems);
            $i = 0;

            foreach ($contents as $content) {
                if ($i === $button - 1) {
                    $output .= '
                    <td>
                        <div class="icon-button">
                            <div class="text">
                                <span>' . $content . '</span>
                            </div>
                        </div>
                    </td>
                    ';
                }
                else {
                    $output .= '<td>' . $content . '</td>';
                }
                $i++;
            }
        }
        else {
            $bitem = array_fill(0, count($bodyitems), $item);
            $contents = array_map(function ($key, $val) {
                return $val === null ? "" : (isset($val[$key]) ? $val[$key] : "");
            }, $bodyitems, $bitem);

            foreach ($contents as $content) {
                $output .= '<td>' . $content . '</td>';
            }
        }

        $output .= '</tr>';
    }

    $output .= '</tbody>';

    $output .= '</table></div>';

    return $output;
}


function CreateFN($category, $extension)
{
    $id = uniqid();
    return strtolower($category) . '-' . $id . '.' . $extension;
}


function ReadImagesFNFrom($dir)
{
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $images = array();

            while (($file = readdir($dh)) !== false) {
                if (!is_dir($dir . $file)) {
                    $images[] = $file;
                }
            }

            closedir($dh);
            asort($images, SORT_NUMERIC);
            return $images;
        }
    }

    return null;
}

function GetImagesFromDir($dir)
{
    $images = [];
    $file_display = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

    if (file_exists($dir) == false) {
        return ["Directory \'', $dir, '\' not found!"];
    }
    else {
        $dir_contents = scandir($dir);
        foreach ($dir_contents as $file) {
            $file_type = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($file_type, $file_display) == true) {
                $images[] = $file;
            }
        }
        return $images;
    }
}


// PRODUCT FUNCTIONS //

function CreateCategory($category, $database)
{
    $table = "categories";
    $data = ["category_name" => $category];

    if (!CountRow($table, $data, $database)) {
        return Insert($table, $data, $database);
    }

    return false;
}

function CreateCategories($categories, $database)
{
    foreach ($categories as $category) {
        if (CreateCategory($category, $database)) {
            echo "Category " . $category . " was inserted!";
        }
    }
}

function CreateProduct($product, $database)
{
    return Insert("products", $product, $database);
}

function UploadProductImageFromPath($category, $fromPath, $topath = "./assets/media/uploads/")
{
    $extension = pathinfo($fromPath, PATHINFO_EXTENSION);
    $filename = CreateFN($category, $extension);
    $path = $topath . $filename;
    $imageData = file_get_contents($fromPath);
    $upload = file_put_contents($path, $imageData);

    if ($upload)
        return $filename;
    else
        return false;
}

function UploadProductImageFromTmp($file, $category)
{
    $target_dir = __DIR__ . "/assets/media/uploads/";
    $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
    $filename = CreateFN($category, $extension);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $msg = "";

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);

    if ($check !== false) {
        $msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else {
        $msg = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $msg = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
    ) {
        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return [
                "status" => true,
                "filename" => $filename,
                "message" => $msg
            ];
        }
        else {
            $msg = "Sorry, there was an error uploading your file.";

            return [
                "status" => false,
                "filename" => $filename,
                "message" => $msg
            ];
        }
    }
}

function UploadImageAndCreateProduct($file, $item, $database)
{
    $upload = UploadProductImageFromTmp($file, $item["category"]);

    if ($upload["status"]) {
        $item["image"] = $upload["filename"];
        return CreateProduct($item, $database);
    }
    else {
        return $upload["message"];
    }
}

function RemoveItemImage($productID, $database)
{
    $product = GetProduct($productID, $database);
    $target_dir = __DIR__ . "/assets/media/uploads/";
    $image = $target_dir . $product["image"];

    if (is_file($image)) {
        unlink($image);
    }
}

function UploadImageAndEditProduct($productID, $file, $item, $database)
{


    $upload = UploadProductImageFromTmp($file, $item["category"]);

    if ($upload["status"]) {
        $item["image"] = $upload["filename"];

        RemoveItemImage($productID, $database);

        return EditItem($productID, $item, $database);
    }
    else {
        return $upload["message"];
    }
}

function CreateProductsFromLocal($products, $imagePath, $toimagepath, $database)
{
    $FILENAMES = ReadImagesFNFrom($imagePath);
    $PRODUCTS = array_map(function ($prod, $name) {
        $product = [
            "name" => $prod["ItemName"],
            "category" => $prod["ItemCategory"],
            "price" => $prod["Price"],
            "image" => $name
        ];

        return $product;
    }, $products, $FILENAMES);

    $ERRORS = 0;
    $SUCCESS = 0;

    foreach ($PRODUCTS as $product) {
        $fromPath = $imagePath . $product["image"];
        $filename = UploadProductImageFromPath($product["category"], $fromPath, $toimagepath);

        if (!$filename) {
            $ERRORS++;
        }
        else {
            $product["image"] = $filename;
            if (Insert("products", $product, $database)) {
                $SUCCESS++;
            }
        }
    }

    if ($ERRORS === 0) {
        return $SUCCESS . " Items Successfully Inserted!";
    }
    else {
        return $SUCCESS . "Success";
    }
}

function GetCategories($database)
{
    return Select("categories", null, true, $database);
}

function GetProducts($filter, $database)
{
    return Select("products", $filter, true, $database);
}

function GetProduct($productID, $database)
{
    return Select("products", ["product_id" => $productID], false, $database);
}

function EditItem($product_id, $item, $database)
{
    return Update("products", $item, ["product_id" => $product_id], $database);
}

function SearchProducts($search, $filter, $database)
{
    return Search("products", $search, ["product_id", "name", "price", "category", "image"], $filter, $database);
}

function RemoveItems($items, $database)
{
    try {
        foreach ($items as $product_id) {
            RemoveItemImage($product_id, $database);
            Delete("products", ["product_id" => $product_id], $database);
        }
    }
    catch (\Throwable $th) {
        return false;
    }

    return true;
}

// EMD PRODUCT FUNCTIONS //

// MEMBERS FUNCTIONS //
function GetMembers($filter, $database)
{
    return Select("members", $filter, true, $database);
}

function GetMember($memberId, $database)
{
    return Select("members", ["member_id" => $memberId], false, $database);
}

function EditMember($member_id, $item, $database)
{
    return Update("members", $item, ["member_id" => $member_id], $database);
}

function RemoveMembers($members, $database)
{
    try {
        foreach ($members as $member_id) {
            RemoveItemImage($member_id, $database);
            Delete("members", ["member_id" => $member_id], $database);
        }
    }
    catch (\Throwable $th) {
        return false;
    }

    return true;
}


function CreateMembers($members, $database)
{
    foreach ($members as $member) {
        if (CreateMember($member, $database)) {
            echo "Category " . $member["lastname"] . " was inserted!";
        }
    }
}

function CreateMember($member, $database)
{
    $member["fullname"] = $member["lastname"] . ", " . $member["firstname"] . " " . $member["middlename"];
    return Insert("members", $member, $database);
}


function SearchMembers($search, $filter, $database)
{
    return Search("members", $search, ["member_id", "lastname", "middlename", "email", "phone", "points"], $filter, $database);
}

function GetOrders($filter, $database)
{
    return Select("orders", $filter, true, $database, " ORDER BY date_made DESC");
}

// END MEMBERS FUNCTIONS //

//  CASHIER FUNCTIONS //

function AddPointHistory($order_id, $order, $database)
{
    $data = [
        "order_id" => $order_id,
        "member_id" => $order["member_id"],
        "total_amount" => $order["total_amount"],
        "redeemed_points" => $order["redeemed_points"],
        "earned_points" => $order["earned_points"],
        "discount" => $order["discount"],
        "final_amount" => $order["final_amount"],
        "reward_points" => $order["reward_points"]
    ];

    return Insert("points_history", $data, $database);
}

function InsertOrderProducts($order_id, $products, $database)
{
    foreach ($products as $product) {
        $product["order_id"] = $order_id;
        Insert("product_orders", $product, $database);
    }

    return true;
}

function UpdateMemberPoint($member_id, $points, $database)
{
    return Update("members", ["points" => $points], ["member_id" => $member_id], $database);
}

function AddOrder($order, $products, $points, $database)
{
    if (Insert("orders", $order, $database)) {
        $O = Select("orders", ["transaction_id" => $order["transaction_id"]], false, $database);
        $order_id = $O["order_id"];
        if (InsertOrderProducts($order_id, $products, $database)) {
            if ($order["member_id"]) {
                if (UpdateMemberPoint($order["member_id"], $points, $database)) {
                    return AddPointHistory($order_id, $order, $database);
                }
                else {
                    return 105;
                }
            }
            else {
                return true;
            }
        }
        else {
            return 103;
        }
    }

    return false;
}

function GetProductOrders($filter, $database)
{
    return Select("product_orders", $filter, true, $database);
}

function CreateProductTableOfItems($products, $path)
{

    $output = '
        <div class="table-body">
            <div class="body-grid-table">';

    foreach ($products as $product) {
        $output .= '
            <div class="body-grid-table-item" data-id="' . $product["product_id"] . '">
                <div class="item-top">
                    <img src="' . $path . $product["image"] . '" alt="">
                </div>
                <div class="item-bot">
                    <p>' . $product["name"] . '</p>
                    <span>PHP ' . $product["price"] . '</span>
                </div>
            </div>';
    }

    $output .= '
            </div>
        </div>
    ';

    return $output;
}

function CreateOrderItem($product_id, $database)
{
    $product = GetProduct($product_id, $database);
    $output = '
        <div class="item" data-id="' . $product_id . '">
        <div class="item-left">
            <div class="small-circular-button delete-item-button">
                <div class="icon">
                    ' . UseIcon("delete") . '
                </div>
            </div>
            <div class="text">
                <p>' . $product["name"] . '</p>
                <span data-price="' . $product["price"] . '">PHP ' . $product["price"] . '</span>
            </div>
        </div>
        <div class="item-right">
            <div class="form-group">
                <div class="flex-number-input">
                    <div class="add-minus-button">
                        <div class="small-circular-button minus-btn">
                            <div class="icon">
                                ' . UseIcon("minus") . '
                            </div>
                        </div>
                        <div class="txt">
                            <input type="number" name="text" value="1" disabled>
                        </div>

                        <div class="small-circular-button add-btn">
                            <div class="icon">
                            ' . UseIcon("plus") . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';

    return ["product" => $product, "element" => $output];
}

function CreatePreOrderID($database)
{
    $found = false;

    while (!$found) {
        $preorderid = rand(50, 200);
        if (!CountRow("orders", ["pre_order_id" => $preorderid], $database)) {
            $found = true;
            return $preorderid;
        }
    }
}

function CreateOrderCheckoutContainer($database)
{
    $MEMBERS = GetMembers(null, $database);
    $ORDER_PRE_ID = CreatePreOrderID($database);
    $MEMBERCOMBO = CreateComboBox("member_combo", "", ToKeysObj($MEMBERS, "member_id", "fullname"), "Search Member");
    $REDEEMCOMBO = CreateComboBox("redeem", "", [
        ["value" => 3, "text" => 3],
        ["value" => 5, "text" => 5],
        ["value" => 10, "text" => 10],
        ["value" => 20, "text" => 20],
    ], "Redeem");

    $output = '
    <div class="order-information-container-parent">
    <div class="order-information-container">
        <form action="" class="order-info-form">
            <div class="container-top">
                <div class="form-group">
                    <div class="flex-content">
                    ' . $MEMBERCOMBO . '
                        <div class="icon-button plain refresh-members-button" style="margin: 0 5px;">
                            <div class="icon" style="margin:0px">
                            ' . UseIcon("refresh") . '
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="three-flex-content">
                        <input type="text" name="member_id" placeholder="ID">
                        <input type="text" name="points" placeholder="Points" disabled>
                        ' . $REDEEMCOMBO . '
                    </div>
                </div>
                <div class="form-group">
                    <div class="title">
                        <p class="pre-order-content" data-id="' . $ORDER_PRE_ID . '">Order #' . $ORDER_PRE_ID . '</p>
                        <h2>CURRENT ORDER</h2>
                    </div>
                </div>
            </div>
            <div class="container-center">
                <div class="products-order-container"></div>
            </div>
            <div class="container-bot">
                <div class="key-value-container">
                    <div class="key">
                        <span>Redeem Points</span>
                    </div>
                    <div class="value">
                        <span class="text-redeem">0</span>
                    </div>
                </div>
                <div class="key-value-container">
                    <div class="key">
                        <span>Earned Points</span>
                    </div>
                    <div class="value">
                        <span class="text-earned">0</span>
                    </div>
                </div>
                <div class="key-value-container">
                    <div class="key">
                        <span>Total Points</span>
                    </div>
                    <div class="value">
                        <span class="text-total-points">0</span>
                    </div>
                </div>
                <div class="key-value-container">
                    <div class="key">
                        <span>Discounts</span>
                    </div>
                    <div class="value">
                        <span class="text-discounts">0</span>
                    </div>
                </div>
                <div class="key-value-container">
                    <div class="key">
                        <span>Sub Total</span>
                    </div>
                    <div class="value">
                        <span class="text-sub-total">PHP 0</span>
                    </div>
                </div>
                <div class="key-value-container">
                    <div class="key">
                        <span><b>TOTAL</b></span>
                    </div>
                    <div class="value">
                        <span><b class="text-total">PHP 0</b></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="submit-container">
                        <div class="icon-button checkout-button">
                            <div class="text">
                                <span>Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    ';

    return $output;
}

// END CASHIER FUNCTIONS //

// ORDERS FUNCTIONS //

function RemoveSalesReports($reports, $database)
{

    try {
        foreach ($reports as $report_id) {
            Delete("sales_reports", ["report_id" => $report_id], $database);
        }
    }
    catch (\Throwable $th) {
        return false;
    }

    return true;
}

function GetSalesReport($from, $to, $database)
{
    $query = "SELECT * FROM orders WHERE date_made BETWEEN '$from' AND '$to' ";
    $stmt = $database->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function GetSalesReports($filter, $database)
{
    return Select("sales_reports", $filter, true, $database);
}

function SearchSalesReports($search, $filter, $database)
{
    return Search("sales_reports", $search, ["sales_report_id", "from_date", "to_date", "date_made"], $filter, $database);
}

function CreateSalesReport($from, $to, $database)
{
    $reports = GetSalesReport($from, $to, $database);
    $report_id = uniqid() . '-' . uniqid();
    $IDS = array_map(function ($r) {
        return $r["order_id"];
    }, $reports);

    $quantities = [];
    $totalsales = 0;

    foreach ($IDS as $id) {
        $ps = GetProductOrders(["order_id" => $id], $database);
        foreach ($ps as $pr) {
            if (!in_array($pr["product_id"], array_keys($quantities))) {
                $quantities[$pr["product_id"]] = ["quantity" => intval($pr["quantity"]), "product_id" => $pr["product_id"]];
            }
            else {
                $quantities[$pr["product_id"]]["quantity"] += $pr["quantity"];
            }

            $totalsales += $pr["price"];
        }
    }

    $values = array_column($quantities, "quantity");
    array_multisort($values, SORT_DESC, $quantities);
    $popular = array_slice(array_column($quantities, "product_id"), 0, 10, true);
    $popular = implode(",", array_values($popular));
    $orders = implode(",", $IDS);
    $quantities = implode(",", array_slice(array_column($quantities, "quantity"), 0, 10, true));
    if (!empty($reports)) {
        $data = [
            "report_id" => $report_id,
            "orders" => $orders,
            "popular" => $popular,
            "quantities" => $quantities,
            "from_date" => $from,
            "to_date" => $to,
            "total_sales" => $totalsales
        ];
        if (Insert("sales_reports", $data, $database)) {
            return $report_id;
        }
    }

    return false;
}

function GetSalesReportRecord($report_id, $database)
{
    return Select("sales_reports", ["report_id" => $report_id], false, $database);
}

function GetOrder($order_id, $database)
{
    return Select("orders", ["order_id" => $order_id], false, $database);
}

function SearchOrders($search, $filter, $database)
{
    return Search("orders", $search, ["order_id", "pre_order_id", "date_made", "total_amount", "member_id", "redeemed_points", "earned_points", "discount", "final_amount"], $filter, $database);
}

// END ORDERS FUNCTIONS //