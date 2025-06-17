<?php


include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();

include("classes/MainView.class.php");
$main_view = new MainView();

//Caso ja não tenha pego os produtos e ja não tenha sido retornado um erro, tenta conseguir a lista de todos os produtos
if (!isset($_SESSION["products"])  && !isset($_GET["error"])) {

    if(isset($_GET["tag"])){
        $tag = $_GET["tag"];
        header("Location: includes/prod_list.inc.php?tag=$tag");
    }else{
        header("Location: includes/prod_list.inc.php");
    }
}

?>


<html lang="en">

<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" type="imagex/png" href="logodopetshop.jpg">
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Loja do Pet Shop</title>
</head>

<body>

    <?php $main_view->header(); ?>


    <form action="includes/prod_list.inc.php" method="GET">
        <input type="text" name="search" placeholder="Buscar produto">
        <input type="submit" value="Buscar">
    </form>


    <main class="product-grid-container">
        <section class="product-grid">
            <?php
            $view->list_products();
            $view->check_errors();
            unset($_SESSION["products"]);
            ?>
        </section>
    </main>



  <?php $main_view->footer(); ?>
</body>


</html>