<?php
//Edição de produtos
include_once("../classes/Dbh.inc.php");
include_once("../classes/products/Product.classes.php");
include_once("../classes/products/ProductContr.classes.php");
include_once("../classes/Config_session.class.php");


$session = new Config_Session();
$session->init();


if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: ../index.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    //Pega as informações do produto a ser editado

    if(!isset($_GET["id"])){
        header("Location: ../index.php");
        die();
    };


    $id = $_GET["id"];
   
    $product_contr = new ProductContr($id);
    $product = $product_contr->get_product("../prod_edit.php");

    $session = new Config_Session();
    $session->init();

    $_SESSION["product"] = $product;

    header("Location: ../prod_edit.php?id=$id");
    die();
}else if($_SERVER["REQUEST_METHOD"]  == "POST"){

    //Pega as informações que foram enviadas no formulario para editar o produto
    $name = empty($_POST["name"]) ? null : $_POST["name"];
    $description =  empty($_POST["description"]) ? null : $_POST["description"];
    $price = ((int)$_POST["price"] == 0) ? null : (int)$_POST["price"];

    $img = $_FILES["img"];
    $quantity = ((int)$_POST["quantity"] == 0) ? null : (int)$_POST["quantity"];
    $tag = $_POST["animal"];
    $product = $_SESSION["product"];

    $product_contr = new ProductContr($product["id"], $name, $description, $price, $img, $quantity,$tag);
    $product_contr->update_product();
    header("location: ../prod_list_admin.php");
    die();
}
