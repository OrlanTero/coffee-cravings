<?php
include  "../../database.php";
include  "../../system.php";

$ORDER = json_decode($_POST["order"]);
$SUMMARY = $ORDER->summary;
$PRODUCTS = $ORDER->orders;
$PREORDERID = $_POST["pre_order_id"];
$TRANSACTIONID = uniqid() . "-" . uniqid();

$PRODUCTDATA = [];

if (!empty($PRODUCTS)) {
    foreach ($PRODUCTS as $p) {
        $pd = [
            "product_id" => $p->product_id,
            "quantity" => $p->quantity,
            "price" => $p->price,
            "total" => $p->total
        ];

        array_push($PRODUCTDATA, $pd);
    }
}


$DATA = [
    "pre_order_id" => $PREORDERID,
    "transaction_id" => $TRANSACTIONID,
    "member_id" => !$ORDER->isMember ? null : $ORDER->member,
    "total_amount" => $SUMMARY->subtotal,
    "redeemed_points" => $SUMMARY->redeem,
    "earned_points" => $SUMMARY->earned,
    "discount" => $SUMMARY->discount,
    "final_amount" => $SUMMARY->total,
    "reward_points" => $SUMMARY->earned
];

echo AddOrder($DATA, $PRODUCTDATA, $SUMMARY->pointsAfter, $database);
