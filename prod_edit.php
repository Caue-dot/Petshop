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



if(isset($_GET["id"]) && !isset($_SESSION["product"] )){
    //Caso tenha um id no link e não tenha pego um produto no banco, tenta achar um produto com o id fornecido
    header("location: includes/prod_edit.inc.php?id=" . $_GET["id"]);
}else if(!isset($_GET["error"]) && !isset($_SESSION["product"])){
    //Evitando que a pessoa acesse um link invalido
    header("Location: prod_edit.php?error=not_found");
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

    $view->check_errors();
    $view->show_product(true);
    $view->edit_inputs();

    

    ?>

</body>

</html>