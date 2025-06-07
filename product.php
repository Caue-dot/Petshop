

<?php
include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();



if(isset($_GET["id"]) && !isset($_SESSION["product"] )){
    //Caso tenha um id no link e não tenha pego um produto no banco, tenta achar um produto com o id fornecido
    header("location: includes/product.inc.php?id=" . $_GET["id"]);
}else if(!isset($_GET["error"]) && !isset($_SESSION["product"])){
    //Evitando que a pessoa acesse um link invalido
    header("Location: product.php?error=not_found");
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
    $view->show_product(true);
    unset($_SESSION["product"]);
    
    $view->check_errors();
    
    ?>
</body>
</html>