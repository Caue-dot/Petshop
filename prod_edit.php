<?php

include_once 'classes/products/ProductView.classes.php';
include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();
//Caso não tenha uma sessão e o nome de usuario não for admin volta pra pagina inicial
if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: index.php");
}

if (isset($_GET["id"])) {
    header("location: includes/prod_edit.inc.php?id=" . $_GET["id"]);
} else if (!isset($_SESSION["product"])) {
    echo 'Essa pagina que você está tentando acessar não existe mais!';
    die();
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

    <h1>Edição de produto </h1>
    <?php

    $view->show_product();

    ?>


    <?php
    $view->edit_inputs();
    ?>

</body>

</html>