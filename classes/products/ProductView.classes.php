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
                $product_id = $product["id"];
                $description = htmlspecialchars($product["description"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $tag = htmlspecialchars($product["tag"]);
                $img = filter_var($product["image"], FILTER_SANITIZE_URL);


                echo " <div class='product-card'>
                        <img src='$img' alt='$name'>
                        <div class='product-info'>
                            <h3>$name</h3>
                            <p class='description'>$description</p>
                            <p class='price'>R$ $price</p>
                            <p class='stock'>Quantidade em estoque: <b>$quantity Unidades</b></p>
                            <p class='stock'>Tags: $tag</p>
                        </div>
                        <div class='product-actions'>
                            <a href=includes/prod_edit.inc.php?id=$product_id> <button class='edit-btn'>Editar</button> </a>
                            <a href=includes/prod_list_admin.inc.php?delete=$product_id> <button class='delete-btn'>Deletar</button> </a>
                        </div>
                    </div>
                    ";


            
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
                $price_installment = round($price / 3, 2);
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
            unset($_SESSION["product"]);
        }
    }


    public function show_product_admin()
    {
        //Mostra um produto especifico
        if (isset($_SESSION["product"]) && $_SESSION["product"]) {


            //Higieniza os inputs, para evitar cross-site-injection
            $product = $_SESSION["product"];
            $name = htmlspecialchars($product["name"]);
            $description = htmlspecialchars($product["description"]);
            $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantity = filter_var($product["quantity"], FILTER_SANITIZE_NUMBER_INT);
            $img = filter_var($product["image"], FILTER_SANITIZE_URL);

            echo "<section class='product-details'>
                <h2>Informações Atuais do Produto</h2>
                <div class='product-info-card'>
                    <img src='$img' alt='Imagem da Ração Seca para Cães Adultos'>
                    <div class='info-content'>
                        <h3>Nome: $name</h3>
                        <p><strong>Descrição:</strong>$description</p>
                        <p><strong>Preço:</strong> R$ $price</p>
                        <p><strong>Estoque:</strong> $quantity Unidades</p>
                    </div>
                </div>
            </section>";
        }
    }


    public function show_product()
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
            $img = filter_var($product["image"], FILTER_SANITIZE_URL);
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
                            
                           
                            <br><br>
                        ";
            if ($quantity <= 0) {
                echo "<br><p><b>Desculpe, esse produto acabou!</b></p>";
            } else {
                echo "
                    <form action='includes/order.inc.php?cart=$product_id' method='POST'> 
                    
                    
                
                    <div class='add-to-cart-section'>
                                <label for='quantity'>Quantidade:</label>
                                <input type='number' id='quantity' name='quantity' value='1' min='1' max='$quantity'>
                                <br>
                                <br>
                            </div> <br> <br>";
                echo "<button class='add-to-cart-btn'>Adicionar ao Carrinho</button>
                    
                    </form>";
            }
            if (isset($_GET['added_cart'])) {
                echo 'Adicionado com successo no carrinho!';
            }




            echo '<br>';

           
        }
        unset($_SESSION["product"]);
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
            case "no_quantity":
                echo "Quantidade no carrinho atingiu o limite do estoque!";
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



        echo " <section class='edit-form-section'>
        <h2>Formulário de Edição</h2>
        <form class='edit-form' action='includes/prod_edit.inc.php' method='POST'>
            <div class='form-group'>
                <label for='product-name'>Nome do Produto:</label>
                <input type='text' id='product-name' name='name' value='$name' required>
            </div>

            <div class='form-group'>
                <label for='product-description'>Descrição:</label>
                <textarea id='product-description' name='description' rows='5' required>$description</textarea>
            </div>

            <div class='form-group'>
                <label for='product-price'>Preço (R$):</label>
                <input type='number' id='product-price' name='price' step='0.01' value=$price required>
            </div>

            <div class='form-group'>
                <label for='product-stock'>Quantidade em Estoque:</label>
                <input type='number' id='product-stock' name='quantity' value='$quantity' required>
            </div>

            <div class='form-group'>
                <label for='product-stock'>Tags:</label>
                <input type='text' id='product-stock' name='tag' value='$tag'>
            </div>

            <div class='form-group'>
                <label for='product-image'>Arquivo da Imagem:</label>
                <input type='file' id='product-image' name='productImage' accept='image/*'>
                <p class='image-note'>Deixe em branco para manter a imagem atual.</p>
            </div>

            <div class='form-actions'>
                <button type='submit' class='save-btn'>Salvar Alterações</button>
                <button type='button' class='cancel-btn' onclick='window.history.back();'>Cancelar</button>
            </div>
        </form>
    </section>";

        
    }
}
