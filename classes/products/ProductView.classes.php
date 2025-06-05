<?php

class ProductView
{
    public function list_products_admin()
    {

        //Lista todos os produtos
        if (isset($_SESSION["products"]) && $_SESSION["products"]) {
            $products = $_SESSION["products"];


            foreach ($products as $product) {

                //Higieniza os inputs, para evitar cross-site-injection
                $name = htmlspecialchars($product["name"]);
                $description = htmlspecialchars($product["description"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);

                echo $name . " " . "R$" . $price;
                echo '<br>';
                echo '<img width=300 src=' . filter_var($product["image"], FILTER_SANITIZE_URL) . '>';
                echo '<br>';
                echo $product["description"];
                echo '<br>';
                echo 'Estoque: <b> ' . $quantity . '</b>';
                echo '<br>';
                echo '<a href="includes/prod_edit.inc.php?id=' . $product["id"] . '" ><button> Editar Produto </button> </a>';
                echo '<br>';
                echo '<a href="includes/prod_list_admin.inc.php?delete=' . $product["id"] . '" ><button> Deletar Produto </button> </a>';

                echo '<br> <br> <br>';
            }
            unset($_SESSION["products"]);
        }
    }

    
    public function list_products()
    {

        //Lista todos os produtos
        if (isset($_SESSION["products"]) && $_SESSION["products"]) {
            $products = $_SESSION["products"];


            foreach ($products as $product) {

                //Higieniza os inputs, para evitar cross-site-injection
                $name = htmlspecialchars($product["name"]);
                $description = htmlspecialchars($product["description"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);

                echo $name . " " . "R$" . $price;
                echo '<br>';
                echo '<img width=300 src=' . filter_var($product["image"], FILTER_SANITIZE_URL) . '>';
                echo '<br>';
                echo $product["description"];
                echo '<br>';
                echo 'Estoque: <b> ' . $quantity . '</b>';

                echo '<br> <br> <br>';
            }
            unset($_SESSION["products"]);
        }
    }


    public function show_product()
    {   
        //Mostra um produto especifico
        if (isset($_SESSION["product"]) && $_SESSION["product"]) {

            
            //Higieniza os inputs, para evitar cross-site-injection
            $product = $_SESSION["product"];
            $name = htmlspecialchars($product["name"]);
            $description = htmlspecialchars($product["description"]);
            $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);

            echo $name . " " . "R$" . $price;
            echo '<br>';
            echo '<img src=' . filter_var($product["image"], FILTER_SANITIZE_URL) . '>';
            echo '<br>';
            echo $description;
            echo '<br>';
            echo 'Estoque: <b> ' . $quantity . '</b>';
            echo '<br> <br> <br>';
        }
    }
    public function is_empty()
    {
        //Checa se não há produtos registrados
        if (isset($_GET["error"]) && $_GET["error"] === "empty") {
            echo '<br>';
            echo "Não há nenhum produto";
        }
    }

    public function edit_inputs()
    {
        
        //Higieniza os inputs, para evitar cross-site-injection
        $product = $_SESSION["product"];
        $name = htmlspecialchars($product["name"]);
        $description = htmlspecialchars($product["description"]);
        $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);




        echo '<form id="edit" action="includes/prod_edit.inc.php" method="post" enctype="multipart/form-data">';

        //Preenche os inputs com os valores do produto editado
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
