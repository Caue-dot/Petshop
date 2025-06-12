<?php

//Listagem dos produtos pro cliente
$redirect_path = "../prod_list.php";
include_once '../classes/Config_session.class.php';
$session = new Config_Session();
$session->init();


if (!isset($_SESSION["products"]) ) {

    include '../classes/Dbh.inc.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';

    $product_contr = new ProductContr();

    if(isset($_GET["search"])){
        //Pesquisa de produtos com base no nome e descrição
        $search = $_GET["search"];
        $product_contr->search_product($search, $redirect_path);
        header("Location:" . $redirect_path . "?list=success");
    }else if($_GET["tag"]){
        //Pesquisa de produtos com base na tag
        $search = $_GET["tag"];
        $product_contr->search_product_by_tag($search, $redirect_path);
        header("Location:" . $redirect_path . "?tag=$search");
    }else{
        //Lista todos os produtos por padrão
        $product_contr->get_all_products($redirect_path);
        header("Location:".$redirect_path."?list=success");
    }
    die();
}
