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
                $tag = htmlspecialchars($product["tag"]);

                echo $name . " " . "R$" . $price;
                echo '<br>';
                echo '<img width=300 src=' . filter_var($product["image"], FILTER_SANITIZE_URL) . '>';
                echo '<br>';
                echo $product["description"];
                echo '<br>';
                echo 'Estoque: <b> ' . $quantity . '</b>';
                echo '<br>';
                echo "Tags:<b>$tag</b>";
                echo '<br>';
                echo '<a href="includes/prod_edit.inc.php?id=' . $product["id"] . '" ><button> Editar Produto </button> </a>';
                echo '<br>';
                echo '<a href="includes/prod_list_admin.inc.php?delete=' . $product["id"] . '" ><button> Deletar Produto </button> </a>';

                echo '<br> <br> <br>';
            }

        }
    }


    public function list_products()
    {

        //Lista todos os produtos
        if (isset($_SESSION["products"]) && $_SESSION["products"]) {
            $products = $_SESSION["products"];

            
            foreach ($products as $product) {

                //Higieniza os inputs, para evitar cross-site-injection
                $product_id = $product["id"];
                $name = htmlspecialchars($product["name"]);
                $description = htmlspecialchars($product["description"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $price_installment = round($price/3,2);
                $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $img = filter_var($product["image"], FILTER_SANITIZE_URL);
                echo "
                <div class='product-card'>
                <a href=product.php?id=$product_id>
                    
                    <div class='product-image-wrapper'>
                        <img src=$img>
                        <span class='badge new'></span> 
                    </div>
                    <h3 class='product-name'>$name</h3>
                    <div class='product-rating'>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star-half-alt'></i>
                        <span>(120 Avaliações)</span>
                    </div>
                    <p class='product-price'>
                        <span class='original-price'>R$ $price</span>
                        <br>
                    </p>
                    <p class='product-installment'>ou 3x de R$ $price_installment sem juros</p>
                    </a>
                </div>
            ";
            }
            //unset($_SESSION["products"]);
        }
    }


    public function show_product($admin)
    {
        //Mostra um produto especifico
        if (isset($_SESSION["product"]) && $_SESSION["product"]) {


            //Higieniza os inputs, para evitar cross-site-injection
            $product = $_SESSION["product"];
            $product_id = $product["id"];
            $name = htmlspecialchars($product["name"]);
            $description = htmlspecialchars($product["description"]);
            $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);
            $img = filter_var($product["image"], FILTER_SANITIZE_URL) ;
            echo "<main>
                    <section class='product-detail-section'>
                        <div class='product-image-container'>
                            <img src='$img' alt='Imagem da Ração Seca para Cães Adultos'>
                        </div>
                        
                        <div class='product-info-container'>
                            <h2 class='product-name'>$name</h2>
                            
                            <p class='product-description'>
                                $description
                            </p>
                            
                            <div class='product-price'>
                                Preço: <span>R$ $price</span>
                            </div>
                            
                            <div class='product-stock'>
                                Estoque: <span>$quantity unidades disponíveis</span>
                            </div>
                            
                            <div class='add-to-cart-section'>
                                <label for='quantity'>Quantidade:</label>
                                <input type='number' id='quantity' name='quantity' value='1' min='1' max='50'>
                                <br>
                                <br>
                            </div>
                            <br><br><br><br>
                        ";
                if($quantity <= 0){
                    echo "<br><p><b>Desculpe, esse produto acabou!</b></p>";
                }else if(!$admin){
                    echo "<a href=includes/order.inc.php?cart=$product_id> <button class='add-to-cart-btn'>Adicionar ao Carrinho</button> </a>";
                }
                            

                        echo "
                        </div>
                    </section>
                </main>";

            echo '<br> <br> <br>';
        }
    }


    public function check_errors()
    {

        if (!isset($_GET["error"])) {
            return;
        }

        echo '<br>';
        switch ($_GET["error"]) {
            case "empty":
                echo "Não há nenhum produto";
                die();
                break;
            case "empty_search":
                echo "Insira algo no campo de pesquisa";
                die();
                break;
            case "not_found":
                echo "Produto não encontrado";
                die();
                break;
        }
    }

    public function edit_inputs()
    {

        if (!isset($_SESSION["product"]) || !$_SESSION["product"]) {
            return;
        }


        //Higieniza os inputs, para evitar cross-site-injection
        $product = $_SESSION["product"];
        $name = htmlspecialchars($product["name"]);
        $description = htmlspecialchars($product["description"]);
        $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);
        $tag = htmlspecialchars($product["tag"]);

        echo '<form id="edit" action="includes/prod_edit.inc.php" method="post" enctype="multipart/form-data">';
        //Preenche os inputs com os valores do produto editado
        echo "
            <h3>Nome: </h3>
            <input type='text' name='name' value='$name'>
            <br>
            <h3>Descrição: </h3>
            <textarea form='edit' name='description'>$description</textarea>
            <br>
            <h3>Preço: </h3>
            <input type='number' name='price' value=$price >
            <br>
            <h3>Quantidade do estoque</h3>
            <input type='number' name='quantity' value='$quantity'>
            <br>
            <h3>Tags</h3>
            <input type='text' name='animal' value='$tag'>
            <br>
            <h3>Selecione uma imagem:</h3> 
            <input type='file' name='img'>
        
        
        <br><br>
        <input type='submit' value = 'Editar' name='submit'>";

        echo '</form> ';
    }

   
}
