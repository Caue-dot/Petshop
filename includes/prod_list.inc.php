<?php



if (!isset($_SESSION["products"]) ) {

    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/products/Product.classes.php';
    include '../classes/products/ProductContr.classes.php';

    $product_contr = new ProductContr();

    if (isset($_GET["delete"])) {
        $id = $_GET["delete"];
        $product_contr->delete_product($id);
    }

    $product_contr->get_products();

}
