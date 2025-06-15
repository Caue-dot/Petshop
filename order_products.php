<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include_once 'classes/products/OrderView.classes.php';
$view = new OrderView();


$id = $_GET["id"];

if(isset($id)  && !isset($_SESSION["order_products"])){
    header("location: includes/order_prod.inc.php?id=$id");
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
        $view->list_products("order_products");
        unset($_SESSION["order_products"]);
    ?>
</body>
</html>