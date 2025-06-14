<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();


if (!isset($_SESSION["orders"]) && !isset($_GET["error"])) {
    //Caso não tenha pego um pedido no banco, tenta achar um pedido
    header("location: includes/orders.inc.php");
} 

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $view->list_orders();
    ?>
</body>

</html>