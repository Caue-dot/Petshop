<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();


include("classes/MainView.class.php");
$main_view = new MainView();

if (!isset($_SESSION["products_cart"])) {
    header("location: includes/cart_list.inc.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_cart.css">
    <title>Document</title>
</head>

<body>
    <?php 
    $main_view->header();
    ?>
    <main>
        <section class="cart-container">
            <h2>Itens no Carrinho</h2>

            <?php
            
            $view->list_cart();
            $view->cart_summary();
            unset($_SESSION["products_cart"]);

            ?>
          
        </section>
    </main>

    <?php
     $main_view->footer();
    ?>

</body>

</html>