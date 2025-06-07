<?php
include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth_page.php");
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    include_once '../classes/Dbh.inc.php';
    include_once '../classes/products/Order.classes.php';
    include_once '../classes/products/OrderContr.classes.php';


    if (isset($_GET["cart"])) {
        $user_id = $_SESSION["user_id"];
        $product_id = $_GET["cart"];

        $order_contr = new OrderContr($user_id);
        $order_contr->add_product($product_id);
        header("Location: ../product.php?id=$product_id&added_cart=success");
    }
}
