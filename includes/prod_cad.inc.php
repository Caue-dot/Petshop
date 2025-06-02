<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $price = (int)$price;
    $img = $_FILES["img"];
    


    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';

    $session = new Config_Session();
    $session->init();
    $signup = new ProductContr($name,$description,$price,$img);
    $signup->cad_product();
} else {
    header("Location: ../index.php");
}
