<?php

//Adiciona um produto ao carrinho
include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth_page.php");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    include_once '../classes/Dbh.inc.php';
    include_once '../classes/products/Order.classes.php';
    include_once '../classes/products/OrderContr.classes.php';
    include_once '../classes/products/Product.classes.php';
    include_once '../classes/products/ProductContr.classes.php';

    if (isset($_GET["cart"])) {
        //So adiciona o produto se tiver na requisição "cart"
        $user_id = $_SESSION["user_id"];
        $product_id = $_GET["cart"];
        $quantity = $_POST["quantity"];

        $order_contr = new OrderContr($user_id);
        $product_contr = new ProductContr($product_id);
        $product = $product_contr->get_product("../product.php");

        //Adiciona o produto ao pedido com o id do produto e o preço
        $order_contr->add_product($product,$quantity ,"../product.php");
        //Redireciona o usuario de volta para a pagina do produto
        header("Location: ../product.php?id=$product_id&added_cart=success");
    }else{
         header("Location: ../index.php");
    }
}
