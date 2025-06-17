<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();

include("classes/MainView.class.php");
$main_view = new MainView();

if (!isset($_SESSION["orders"]) && !isset($_GET["error"])) {
    //Caso não tenha pego um pedido no banco, tenta achar um pedido
    header("location: includes/orders.inc.php");
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Compra - Pet Shop Feliz</title>
    <link rel="stylesheet" href="public/css/style_orders.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php $main_view->header() ?>
    <h1>Minhas Compras</h1>

    <main>
        <section class="order-history-section">
            <h2>Histórico de Pedidos</h2>
            <p class="no-orders-message" style="display: none;">Você ainda não realizou nenhuma compra.</p>

            <div class="order-list">

            <?php
            $view->list_orders();
            ?>

            </div>
        </section>
    </main>

    <?php $main_view->footer() ?>
</body>

</html>
<!-- 

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    

    
</body>

</html> -->