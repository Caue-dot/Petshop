<?php

class ProductView
{
    public function list_products()
    {
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
    }

    public function is_empty()
    {

        if (isset($_GET["error"]) && $_GET["error"] === "empty") {
            echo '<br>';
            echo "Não há nenhum produto";
        }
    }
}
