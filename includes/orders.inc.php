<?php
//Lista todos os pedidos
include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include_once '../classes/Dbh.inc.php';
include_once  '../classes/products/Order.classes.php';
include_once  '../classes/products/OrderContr.classes.php';

$redirect_path = "../prod_list.php";

if(isset($_SESSION["user_id"])){
    //Somente permite acessar essa página se o usuario estiver logado
    $user_id = $_SESSION["user_id"];
    $orders_contr = new OrderContr($user_id);

    //Pega todos os pedidos associados ao usuário
    $orders = $orders_contr->get_orders("purchased");
    
    if($orders){
        $_SESSION["orders"] = $orders;
        header("Location: ../orders.php");
    }else{
        header("Location: ../orders.php?error=empty_orders");
    }

}else{
    //Caso contrario manda ele pra página de autenticação.
     header("Location: ../auth_page.php");
    
}

die();
