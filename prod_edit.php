<?php

include_once 'classes/products/ProductView.classes.php';
include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();

include("classes/MainView.class.php");
$main_view = new MainView();


//Caso não tenha uma sessão e o nome de usuario não for admin volta pra pagina inicial

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
    <link rel="stylesheet" href="public/css/style_edit.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Edição de produto</title>
</head>

<body>
<?php $main_view->header(); ?>
<main>

    <?php
    $view->check_errors();
    $view->show_product_admin(true);
    $view->edit_inputs();
    ?>
    

</main>

<?php $main_view->footer(); ?>
<script src="public/js/img_displayer.js"></script> 
</body>

</html>