<?php


//Listagem de produtos no painel administrativo
include '../classes/Config_session.class.php';

$session = new Config_Session();
$session->init();

$redirect_path = "../prod_list_admin.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: ../index.php");
    die();
}

if (!isset($_SESSION["products"]) ) {

    include '../classes/Dbh.inc.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';
    


    $id = $_GET["delete"];
    $product_contr = isset($_GET["delete"]) ?  new ProductContr($id) :  new ProductContr();
    
    //Caso na requisição tenha "Delete", deleta o produto
    if (isset($_GET["delete"])) {
        $product_contr->delete_product();
    }

    //Pega todos os produtos
    $product_contr->get_all_products($redirect_path);
    header("Location:".$redirect_path."?list=success");
    die();

}else{
    echo "erro";
    header("Location: ../index.php");
}