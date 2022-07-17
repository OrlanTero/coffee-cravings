<?php

$PRODUCTIMAGEPATH = "./assets/media/store/";

$PRODUCTIMAGEPATHUPLOADS = "./assets/media/uploads/";

$ORDERSSTABLEHEADERTEXT = ["Order ID", "Total Amount", "Member ID", "Redeem Points", "Earned Points", "Discount", "Final Amount", "Date Made", "Details"];

$POINTSTABLEHEADERTEXT = ["Order ID", "Total Amount", "Redeem Points", "Earned Points", "Discount", "Final Amount", "Reward Points"];

$PRODUCTTABLEHEADERTEXT = ["Item ID", "Item Name", "Item Price", "Item Category", "Item Image"];

$MEMBERSTABLEHEADERTEXT = ["ID", "Name", "Address", "Email", "Phone", "Points", "Details"];

$SALESREPORTINFOHEADERTEXT = ["Sales Report ID", "From Date", "To Date", "Date Made", "Details"];

$ORDERSSTABLEBODYKEY = ["order_id", "total_amount", "member_id", "redeemed_points", "earned_points", "discount", "final_amount", "date_made", "Details"];

$POINTSTABLEBODYKEY = ["order_id", "total_amount", "redeemed_points", "earned_points", "discount", "final_amount", "reward_points"];

$PRODUCTTABLEBODYKEY = ["product_id", "name", "price", "category", "image"];

$SALESREPORTINFOKEY = ["sales_report_id", "from_date", "to_date", "date_made", "Details"];

$MEMBERSTABLEBODYKEY = ["member_id", "fullname", "address", "email", "phone", "points", "Details"];

$LOCALCATEGORIES = ["Drinks", "Rice Meal", "Snacks"];

$LOCALPRODUCTS = [
    ["ItemID" => "1", "ItemCategory" => "Drinks", "ItemName" => "Cafe Americano", "Price" => "70", "Image" => ""], ["ItemID" => "2", "ItemCategory" => "Drinks", "ItemName" => "Cafe Latte", "Price" => "80", "Image" => ""], ["ItemID" => "3", "ItemCategory" => "Drinks", "ItemName" => "Cappuccino", "Price" => "85", "Image" => ""], ["ItemID" => "4", "ItemCategory" => "Drinks", "ItemName" => "Mocha", "Price" => "85", "Image" => ""], ["ItemID" => "5", "ItemCategory" => "Drinks", "ItemName" => "Caramel Macchiato", "Price" => "90", "Image" => ""], ["ItemID" => "6", "ItemCategory" => "Drinks", "ItemName" => "Caramel Latte", "Price" => "90", "Image" => ""], ["ItemID" => "7", "ItemCategory" => "Drinks", "ItemName" => "Hot Chocolate", "Price" => "80", "Image" => ""], ["ItemID" => "8", "ItemCategory" => "Drinks", "ItemName" => "Cafe Misto", "Price" => "80", "Image" => ""], ["ItemID" => "9", "ItemCategory" => "Drinks", "ItemName" => "Dark Roast Coffee", "Price" => "80", "Image" => ""], ["ItemID" => "10", "ItemCategory" => "Drinks", "ItemName" => "Flat White Coffee", "Price" => "85", "Image" => ""], ["ItemID" => "11", "ItemCategory" => "Drinks", "ItemName" => "Affogato", "Price" => "90", "Image" => ""], ["ItemID" => "12", "ItemCategory" => "Drinks", "ItemName" => "Cold Brew Coffee", "Price" => "90", "Image" => ""], ["ItemID" => "13", "ItemCategory" => "Drinks", "ItemName" => "Strawberry", "Price" => "75", "Image" => ""], ["ItemID" => "14", "ItemCategory" => "Drinks", "ItemName" => "Blueberry", "Price" => "75", "Image" => ""], ["ItemID" => "15", "ItemCategory" => "Drinks", "ItemName" => "Blue Lemonade", "Price" => "75", "Image" => ""], ["ItemID" => "16", "ItemCategory" => "Drinks", "ItemName" => "Honey Lemonade", "Price" => "75", "Image" => ""], ["ItemID" => "17", "ItemCategory" => "Drinks", "ItemName" => "Iced Tea", "Price" => "50", "Image" => ""], ["ItemID" => "18", "ItemCategory" => "Drinks", "ItemName" => "Bottled Water", "Price" => "20", "Image" => ""], ["ItemID" => "19", "ItemCategory" => "Drinks", "ItemName" => "Canned Soft Drinks", "Price" => "50", "Image" => ""], ["ItemID" => "20", "ItemCategory" => "Rice Meal", "ItemName" => "Hotsilog", "Price" => "65", "Image" => ""], ["ItemID" => "21", "ItemCategory" => "Rice Meal", "ItemName" => "Longsilog", "Price" => "65", "Image" => ""], ["ItemID" => "22", "ItemCategory" => "Rice Meal", "ItemName" => "Tapsilog", "Price" => "85", "Image" => ""], ["ItemID" => "23", "ItemCategory" => "Rice Meal", "ItemName" => "Tocilog", "Price" => "65", "Image" => ""], ["ItemID" => "24", "ItemCategory" => "Rice Meal", "ItemName" => "Malingsilog", "Price" => "65", "Image" => ""], ["ItemID" => "25", "ItemCategory" => "Rice Meal", "ItemName" => "Chicksilog", "Price" => "80", "Image" => ""], ["ItemID" => "26", "ItemCategory" => "Rice Meal", "ItemName" => "Porksilog", "Price" => "90", "Image" => ""], ["ItemID" => "27", "ItemCategory" => "Rice Meal", "ItemName" => "Bangsilog", "Price" => "90", "Image" => ""], ["ItemID" => "28", "ItemCategory" => "Rice Meal", "ItemName" => "Cornsilog", "Price" => "60", "Image" => ""], ["ItemID" => "29", "ItemCategory" => "Rice Meal", "ItemName" => "Extra Rice", "Price" => "15", "Image" => ""], ["ItemID" => "30", "ItemCategory" => "Rice Meal", "ItemName" => "Fried Rice", "Price" => "25", "Image" => ""], ["ItemID" => "31", "ItemCategory" => "Snacks", "ItemName" => "Carbonara", "Price" => "95", "Image" => ""], ["ItemID" => "32", "ItemCategory" => "Snacks", "ItemName" => "Italian Spaghetti", "Price" => "100", "Image" => ""], ["ItemID" => "33", "ItemCategory" => "Snacks", "ItemName" => "Creamy Tuna Pesto", "Price" => "110", "Image" => ""], ["ItemID" => "34", "ItemCategory" => "Snacks", "ItemName" => "Baked Macaroni", "Price" => "100", "Image" => ""], ["ItemID" => "35", "ItemCategory" => "Snacks", "ItemName" => "Garlic Parmesan", "Price" => "120", "Image" => ""], ["ItemID" => "36", "ItemCategory" => "Snacks", "ItemName" => "Sweet BBQ Wings", "Price" => "120", "Image" => ""], ["ItemID" => "37", "ItemCategory" => "Snacks", "ItemName" => "Signature Buffalo Wings", "Price" => "120", "Image" => ""], ["ItemID" => "38", "ItemCategory" => "Snacks", "ItemName" => "Honey Garlic", "Price" => "120", "Image" => ""], ["ItemID" => "39", "ItemCategory" => "Snacks", "ItemName" => "Teriyaki Chicken Wings", "Price" => "120", "Image" => ""], ["ItemID" => "40", "ItemCategory" => "Snacks", "ItemName" => "Korean Chicken Wings", "Price" => "120", "Image" => ""], ["ItemID" => "41", "ItemCategory" => "Snacks", "ItemName" => "Classic Homestyle Wings", "Price" => "110", "Image" => ""], ["ItemID" => "42", "ItemCategory" => "Snacks", "ItemName" => "Cheesy Fries", "Price" => "60", "Image" => ""], ["ItemID" => "43", "ItemCategory" => "Snacks", "ItemName" => "Beef Nachos", "Price" => "95", "Image" => ""], ["ItemID" => "44", "ItemCategory" => "Snacks", "ItemName" => "Beef Tacos", "Price" => "35", "Image" => ""], ["ItemID" => "45", "ItemCategory" => "Snacks", "ItemName" => "Burger", "Price" => "40", "Image" => ""]
];

$LOCALMEMBERS = [
    [
        "member_id" => "1",
        "lastname" => "Teves",
        "firstname" => "Ralph",
        "middlename" => "Jocef",
        "address" => "21 Emerald St. Medalva Hills Village, Brgy. San Isidro, Angono, Rizal",
        "email" => "rjteves@gmail.com",
        "phone" => "09395545222",
        "points" => "0",
    ],
    [
        "member_id" => "2",
        "lastname" => "Reyes",
        "firstname" => "Alex",
        "middlename" => "De Guzman",
        "address" => "B902, L13, Marilao, Bulacan, Cavite",
        "email" => "alex@gmail.com",
        "phone" => "09315214222",
        "points" => "10",
    ],
    [
        "member_id" => "3",
        "lastname" => "Macaya",
        "firstname" => "Emmanuel",
        "middlename" => "Francis",
        "address" => "01 Diamond St. Medalva Hills Village, Brgy. San Isidro, Angono, Rizal",
        "email" => "emman@gmail.com",
        "phone" => "09395551548",
        "points" => "0",
    ],
    [
        "member_id" => "4",
        "lastname" => "Simon",
        "firstname" => "Joshua",
        "middlename" => "Pete",
        "address" => "07 Road 9, Arveemar Homes, Brgy. San Isidro, Antipolo, Rizal",
        "email" => "joshua@gmail.com",
        "phone" => "09395551224",
        "points" => "8",
    ],
    [
        "member_id" => "5",
        "lastname" => "Valeros",
        "firstname" => "Carl",
        "middlename" => "Cruz",
        "address" => "17 Road 5, Arveemar Homes, Brgy. San Isidro, Antipolo, Rizal",
        "email" => "carl@gmail.com",
        "phone" => "09395534625",
        "points" => "0",
    ],
    [
        "member_id" => "6",
        "lastname" => "Teves",
        "firstname" => "John",
        "middlename" => "Paul",
        "address" => "22 Road 3, Arveemar Homes, Brgy. San Isidro, Antipolo, Rizal",
        "email" => "john@gmail.com",
        "phone" => "09395534625",
        "points" => "6",
    ],
    [
        "member_id" => "7",
        "lastname" => "Tejerero",
        "firstname" => "Malou",
        "middlename" => "Jamer",
        "address" => "30 Onyx St. Medalva Hills Village, Brgy. San Isidro, Angono, Rizal",
        "email" => "malou@gmail.com",
        "phone" => "09395545227",
        "points" => "0",
    ],
    [
        "member_id" => "8",
        "lastname" => "Del Rosario",
        "firstname" => "Monica",
        "middlename" => "Fishler",
        "address" => "14 Topaz St. Medalva Hills Village, Brgy. San Isidro, Angono, Rizal",
        "email" => "monica@gmail.com",
        "phone" => "09395547828",
        "points" => "4",
    ],
    [
        "member_id" => "9",
        "lastname" => "James",
        "firstname" => "Lebron",
        "middlename" => "Wade",
        "address" => "22 Road 7, Arveemar Homes, Brgy. San Isidro, Antipolo, Rizal",
        "email" => "lebron@gmail.com",
        "phone" => "09395565429",
        "points" => "0",
    ],
    [
        "member_id" => "10",
        "lastname" => "Curry",
        "firstname" => "Stephen",
        "middlename" => "Thompson",
        "address" => "21 Road 7, Arveemar Homes, Brgy. San Isidro, Antipolo, Rizal",
        "email" => "stephen@gmail.com",
        "phone" => "09395547830",
        "points" => "2",
    ]
];