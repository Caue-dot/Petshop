<?php
include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: index.php");
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
    if (isset($_SESSION["products"]) && $_SESSION["products"]) {
        $products = $_SESSION["products"];

        foreach ($products as $product) {
            echo $product["name"] . " " . "R$" . $product["price"];
            echo '<br>';
            echo '<img src=' . $product["image"] . '>';
            echo '<br>';
            echo $product["description"];
            echo '<br>';
            echo '<a href="includes/prod_list.inc.php?delete=' . $product["id"] . '" ><button> Deletar Produto </button> </a>';
            echo '<br> <br> <br>';
        }
        unset($_SESSION["products"]);
    }

    if (isset($_GET["error"]) && $_GET["error"] === "empty") {
        echo '<br>';
        echo "Não há nenhum produto";
    }
    ?>

</body>

</html>