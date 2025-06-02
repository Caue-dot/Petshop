<?php
include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: index.php");
}

//Caso ja não tenha pego os produtos e ja não tenha sido retornado um erro, tenta conseguir a lista de todos os produtos
if (!isset($_SESSION["products"]) && !isset($_GET["error"])) {
    header("Location: includes/prod_list.inc.php");
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>

<body>


    <a href="includes/prod_list.inc.php">Botão</a>
    <?php
        $view->list_products();
        $view->is_empty();
    ?>

</body>

</html>