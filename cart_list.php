<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();


include("classes/MainView.class.php");
$main_view = new MainView();

if (!isset($_SESSION["products_cart"]) && !isset($_GET["error"]) || isset($_GET["error"]) && $_GET["error"] == "no_stock") {
    header("location: includes/cart_list.inc.php");
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <title>Document</title>
</head>

<body>
    <?php
    $main_view->header();
    ?>
    <div class="main-content">
        <main>
            <section class="cart-container">
                <h2>Itens no Carrinho</h2>

                <?php

                $view->list_cart();
                $view->check_errors();
                $view->cart_summary();
                unset($_SESSION["products_cart"]);

                ?>

            </section>
        </main>
    </div>

    <?php
    $main_view->footer();
    ?>

</body>

</html>