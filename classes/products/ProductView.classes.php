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
                echo 'Estoque: <b> '. $product["quantity"] . '</b>';
                echo '<br>';
                echo '<a href="includes/prod_edit.inc.php?id=' . $product["id"] . '" ><button> Editar Produto </button> </a>';
                echo '<br>';
                echo '<a href="includes/prod_list.inc.php?delete=' . $product["id"] . '" ><button> Deletar Produto </button> </a>';
                
                echo '<br> <br> <br>';
            }
            unset($_SESSION["products"]);
        }
    }


    public function show_product()
    {
        if (isset($_SESSION["product"]) && $_SESSION["product"]) {

            $product = $_SESSION["product"];

            echo $product["name"] . " " . "R$" . $product["price"];
            echo '<br>';
            echo '<img src=' . $product["image"] . '>';
            echo '<br>';
            echo $product["description"];
            echo '<br> <br> <br>';
        }
    }
    public function is_empty()
    {

        if (isset($_GET["error"]) && $_GET["error"] === "empty") {
            echo '<br>';
            echo "Não há nenhum produto";
        }
    }

    public function edit_inputs(){
       
        
      

      
        $product = $_SESSION["product"];
        $name = $product["name"];
        $description = $product["description"];
        $price = $product["price"];
        $quantity = $product["quantity"];

        


        echo '<form id="edit" action="includes/prod_edit.inc.php" method="post" enctype="multipart/form-data">';

        
        echo "
            <h3>Nome: </h3>
            <input type='text' name='name' value=$name>
            <br>
            <h3>Descrição: </h3>
            <textarea form='edit' name='description'>$description</textarea>
            <br>
            <h3>Preço: </h3>
            <input type='number' name='price' value=$price >
            <br>
            <h3>Quantidade do estoque</h3>
            <input type='number' name='quantity' value=$quantity>
            <br>
            <h3>Selecione uma imagem:</h3> 
            <input type='file' name='img'>
        
        
        <br><br>
        <input type='submit' value = 'Editar' name='submit'>";

        echo '</form> ';
        

    }
}
