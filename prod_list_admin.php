<?php


include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();


include("classes/MainView.class.php");
$main_view = new MainView();
//Caso ja não tenha pego os produtos e ja não tenha sido retornado um erro, tenta conseguir a lista de todos os produtos
if (!isset($_SESSION["products"]) && !isset($_GET["error"])) {
    header("Location: includes/prod_list_admin.inc.php");
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_list_adm.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php $main_view->header(); ?>
    <main>
        <section class="product-list">
            <h2>Produtos em Estoque</h2>


            <?php
            $view->list_products_admin();
            $view->check_errors();
            unset($_SESSION["products"]);
            ?>

        </section>
    </main>
     <?php $main_view->footer(); ?>
</body>

</html>