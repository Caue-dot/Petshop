<?php
//Pagina de produto

include_once ('../classes/Config_session.class.php');
include_once("../classes/Dbh.inc.php");
include_once("../classes/products/Product.classes.php");
include_once("../classes/products/ProductContr.classes.php");
include_once("../classes/Config_session.class.php");


$session = new Config_Session();
$session->init();


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    $id = $_GET["id"];
   
    $product_contr = new ProductContr($id);
    $product = $product_contr->get_product("../product.php");

    $_SESSION["product"] = $product;

    header("Location: ../product.php?id=$id");
}else{
    header("Location: ../index.php");
}

 die();