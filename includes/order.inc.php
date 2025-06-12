<?php

//Adiciona um produto ao carrinho
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
        //So adiciona o produto se tiver na requisição "cart"
        $user_id = $_SESSION["user_id"];
        $product_id = $_GET["cart"];

        $order_contr = new OrderContr($user_id);
        $product = $_SESSION["product"];
        //Adiciona o produto ao pedido com o id do produto e o preço
        $order_contr->add_product($product_id, $product["price"]);
        //Redireciona o usuario de volta para a pagina do produto
        header("Location: ../product.php?id=$product_id&added_cart=success");
    }else{
         header("Location: ../index.php");
    }
}
