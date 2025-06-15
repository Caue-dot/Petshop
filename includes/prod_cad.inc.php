<?php
include_once("../classes/Config_session.class.php");


$session = new Config_Session();
$session->init();


if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: ../index.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $price = (int)$price;
    $img = $_FILES["img"];
    $quantity = $_POST["quantity"];
    $tag = $_POST["tag"];
    


    include '../classes/Dbh.inc.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';

    $session = new Config_Session();
    $session->init();

    //Cadastra o produto
    $signup = new ProductContr(null, $name,$description,$price,$img,$quantity,$tag);
    $signup->cad_product();
    header("Location: ../prod_list_admin.php?cad=success");
  
} else {
    header("Location: ../index.php");
}


  die();