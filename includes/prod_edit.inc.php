<?php

include_once ('../classes/Config_session.class.php');
include_once("../classes/Dbh.inc.php");
include_once("../classes/products/Product.classes.php");
include_once("../classes/products/ProductContr.classes.php");
include_once("../classes/Config_session.class.php");


$session = new Config_Session();
$session->init();


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id"];
   
    $product_contr = new ProductContr($id);
    $product = $product_contr->get_product("../prod_edit.php");

    $session = new Config_Session();
    $session->init();

    $_SESSION["product"] = $product;

    header("Location: ../prod_edit.php?id=$id");
    die();
}else if($_SERVER["REQUEST_METHOD"]  == "POST"){
    $name = empty($_POST["name"]) ? null : $_POST["name"];
    $description =  empty($_POST["description"]) ? null : $_POST["description"];
    $price = ((int)$_POST["price"] == 0) ? null : (int)$_POST["price"];

    $img = $_FILES["img"];
    $quantity = ((int)$_POST["quantity"] == 0) ? null : (int)$_POST["quantity"];
    $animal = $_POST["animal"];
    $product = $_SESSION["product"];

    $product_contr = new ProductContr(null, $name, $description, $price, $img, $quantity,$animal);
    $product_contr->update_product($product["id"]);
    header("location: ../prod_list_admin.php");
    die();
}
