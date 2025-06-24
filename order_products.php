<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();
include("classes/MainView.class.php");
$main_view = new MainView();

$id = $_GET["id"];


if(isset($id)  && !isset($_SESSION["order_products"])){
    header("location: includes/order_prod.inc.php?id=$id");
}


$order_user = isset($_SESSION["orders"]) ? $_SESSION["orders"][0]["user_id"] : null; 


if(!isset($_SESSION["user_id"]) || !isset($order_user) || $order_user !== $_SESSION["user_id"]){
    header("location: index.php");
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style_cart.css">
    <title>Produtos</title>
</head>
<body>
    <?php
        $main_view->header();
      ?>
    <main class="main-content">
        <section class="cart-container">
            <?php
            $view->list_products("order_products");
            unset($_SESSION["order_products"]);
            ?>
        </section>
    </main>
      <?php
          $main_view->footer();
      ?>
    

</body>
</html>