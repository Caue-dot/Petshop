<?php



include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include '../classes/Dbh.inc.php';
include '../classes/products/Order.classes.php';
include '../classes/products/OrderContr.classes.php';


if (isset($_GET["id"]) && isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $order_contr = new OrderContr($user_id);
    $order_id = $_GET["id"];


    $order = $order_contr->get_order_by_id($order_id);
    if ($order["user_id"] !== $user_id) {
        header("location: ../index.php");
        die();
    }


    $products = $order_contr->get_products($order_id);
    $_SESSION["order_products"] = $products;
    header("location: ../order_products.php?id=$order_id");
} else {
    header("location: ../index.php");
}

die();
