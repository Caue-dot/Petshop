<?php


include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include '../classes/Dbh.inc.php';
include '../classes/products/Order.classes.php';
include '../classes/products/OrderContr.classes.php';

if(isset($_SESSION["user_id"])  ){

    $order_contr = new OrderContr($_SESSION["user_id"]);
    $redirect = "../cart_list.php";

    
    if(isset($_GET['remove'])){
        $order_contr->remove_product($_GET['remove']);
        header("location: $redirect");
        die();
    }
    
    
    $cart = $order_contr->get_orders("cart");



    if($cart){
        $products = $order_contr->get_products($cart[0]["order_id"]);
        $order = $cart[0];
        $_SESSION["products_cart"] = $products;
        $_SESSION["order"] = $order;
        header("location: $redirect");
    }else{
        header ("location: $redirect?error=empty_cart");
    }

}else{
    header("location: ../index.php");
}

die();