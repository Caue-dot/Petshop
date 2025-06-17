<?php


include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include '../classes/Dbh.inc.php';
include '../classes/products/Order.classes.php';
include '../classes/products/OrderContr.classes.php';

if(isset($_SESSION["user_id"])  ){

    $order_contr = new OrderContr($_SESSION["user_id"]);
    $redirect = "../purchase_page.php";

    if(isset($_GET['buy'])){
        $order_contr->purchase_order("../cart_list.php");
        header("location: $redirect?buy=true");
        die();
    }


}else{
    header("location: ../index.php");
}

die();