<?php

//Lista os produtos de uma order especifica

include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();
include '../classes/Dbh.inc.php';
include '../classes/products/Order.classes.php';
include '../classes/products/OrderContr.classes.php';


if (isset($_GET["id"]) && isset($_SESSION["user_id"])) {
    //Checa se a requisição tem um id e se o usuario está logado
    $user_id = $_SESSION["user_id"];

    $order_contr = new OrderContr($user_id);
    $order_id = $_GET["id"];

    //Pega o pedido com base no id de usuario e no id do pedido
    $order = $order_contr->get_order_by_id($order_id);
    if ($order["user_id"] !== $user_id) {
        //Caso alguem esteje tentando acessar um pedido de outro usuario retorna ele pra pagina inicial.
        header("location: ../index.php");
        die();
    }

    //Pega todos os produtos da order.
    $products = $order_contr->get_products($order_id);
    $_SESSION["order_products"] = $products;

    //Retorna o usuario pra pagina de produtos do pedido
    header("location: ../order_products.php?id=$order_id");
} else {
    header("location: ../index.php");
}

die();
