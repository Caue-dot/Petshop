

<?php
include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();

include("classes/MainView.class.php");
$main_view = new MainView();

if(!isset($_GET["error"])){
    if(isset($_GET["id"]) && !isset($_SESSION["product"]) || $_SESSION["product"]["id"] != $_GET["id"] ){
        //Caso tenha um id no link e não tenha pego um produto no banco ou o produto na sessão for diferente do produto requisitado, tenta achar um produto com o id fornecido
        header("location: includes/product.inc.php?id=" . $_GET["id"]);
    }else if(!isset($_SESSION["product"])){
        //Evitando que a pessoa acesse um link invalido
        header("Location: product.php?error=not_found");
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_product.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    $main_view->header();
    echo '<br><br><br>';
    $view->show_product(false);
    //unset($_SESSION["product"]);
    $view->check_errors();
    ?>

      </div>
                    </section>
                </main>";
    <?php
    $main_view->footer();
    ?>
</body>
</html>