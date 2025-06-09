<?php

include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include '../classes/Dbh.inc.php';
include '../classes/products/Order.classes.php';
include '../classes/products/OrderContr.classes.php';

$redirect_path = "../prod_list.php";

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
    $orders_contr = new OrderContr($user_id);
    $orders = $orders_contr->get_orders("purchased");
    if($orders){
        $_SESSION["orders"] = $orders;
        header("Location: ../orders.php");
    }

}

die();
