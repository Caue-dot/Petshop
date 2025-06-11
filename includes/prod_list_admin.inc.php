<?php


$redirect_path = "../prod_list_admin.php";
if (!isset($_SESSION["products"]) ) {

    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';

    $id = $_GET["delete"];
    $product_contr = new ProductContr($id);
    if (isset($_GET["delete"])) {
        $product_contr->delete_product();
    }

    $product_contr->get_all_products($redirect_path);
    header("Location:".$redirect_path."?list=success");
    die();

}