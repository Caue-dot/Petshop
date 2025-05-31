<?php

declare(strict_types=1);

function show_products(){
    if(isset($_SESSION["products"]) && $_SESSION["products"]){
        $products = $_SESSION["products"];

        foreach ($products as $product) {
            echo $product["name"] . " " . $product["price"] . "R$";
            echo '<br>';
            echo '<img src='. $product["image"] . '>';
            echo '<br>';
            echo $product["description"];
            echo '<br>';
            echo '<a href="prod_admin.php?delete='. $product["id"] .'" ><button> Deletar Produto </button> </a>';
            echo '<br> <br> <br>';
        }
        unset($_SESSION["products"]);
    }
}


function check_is_empty(){
    if(isset($_SESSION["is_empty"])){
        echo $_SESSION["is_empty"];
        echo '<a href="prod_cad.php"> <button>Cadastre agora!</button> </a>' ;
        unset($_SESSION["is_empty"]);
    }

}

