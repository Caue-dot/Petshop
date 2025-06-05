
<?php


include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();


//Caso ja não tenha pego os produtos e ja não tenha sido retornado um erro, tenta conseguir a lista de todos os produtos
if (!isset($_SESSION["products"])  && !isset($_GET["error"])) {
    header("Location: includes/prod_list.inc.php");
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="includes/prod_list.inc.php" method="GET">
        <input type="text" name="search" placeholder="Buscar produto">
        <input type="submit" value="Buscar">
    </form>
    <?php
    $view->list_products();
    $view->check_errors();
    ?>
</body>
</html>