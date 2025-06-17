<?php


class OrderView
{
    public function list_orders()
    {

        //Lista todos os pedidos
        if (isset($_SESSION["orders"]) && $_SESSION["orders"]) {
            $orders = $_SESSION["orders"];

            foreach ($orders as $order) {
                //Higieniza os inputs, para evitar cross-site-injection
                $order_id = $order["order_id"];
                $created_at = $order["created_at"];


                echo "<div class='order-item'>
                        <div class='order-id'>
                            <strong>ID do Pedido:</strong> <a href='order_products.php?id=$order_id'>#$order_id</a>
                        </div>
                        <div class='order-date'>
                            <strong>Data da Compra:</strong> $created_at
                        </div>
                    </div>
                    ";
            }
        }
    }


    public function list_products($name)
    {

        //Lista todos os produtos
        if (isset($_SESSION[$name]) && $_SESSION[$name] && $_GET["id"]) {
            $products = $_SESSION[$name];
            $id = $_GET["id"];


            echo "<h1>Pedido Id: $id </h1>";
            foreach ($products as $product) {

                //Higieniza os inputs, para evitar cross-site-injection
                $name = htmlspecialchars($product["name"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_var($product["order_quantity"], FILTER_SANITIZE_NUMBER_INT);
                $total_price = sprintf('%.2f', $price * $quantity);
                $img = filter_var($product["image"], FILTER_SANITIZE_URL);
                
                 echo "<div class='product-list'>
                        <div class='product-item'>
                            <img src='$img' alt='$name'>
                            <div class='item-details'>
                                <h3>$name</h3>
                                <p class='item-price'>R$ $total_price</p>
                                <p>Quantidade: $quantity </p>
                            </div>
                        </div>
                    </div>";
            }
        }
    }


    public function list_cart()
    {
        if (isset($_SESSION["products_cart"]) && $_SESSION["products_cart"]) {
            $products = $_SESSION["products_cart"];


            foreach ($products as $product) {

                //Higieniza os inputs, para evitar cross-site-injection
                $id = $product['id'];
                $name = htmlspecialchars($product["name"]);
                $description = htmlspecialchars($product["description"]);
                $price = filter_var($product["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_var($product["order_quantity"], FILTER_SANITIZE_NUMBER_INT);
                $total_price = sprintf('%.2f', $price * $quantity);
                $img = filter_var($product["image"], FILTER_SANITIZE_URL);

                echo "<div class='product-list'>
                        <div class='product-item'>
                            <img src='$img' alt='$name'>
                            <div class='item-details'>
                                <h3>$name</h3>
                                <p class='item-price'>R$ $total_price</p>
                                <p>Quantidade: $quantity </p>
                            </div>
                           <a href=includes/cart_list.inc.php?remove=$id> <button class='remove-item-btn'>Remover</button> </a>
                        </div>
                    </div>";
            }
        }
        if (isset($_GET['buy'])) {
            echo '<p>Compra realizada com successo</p>';
        }
    }



    public function cart_summary()
    {
        if (isset($_SESSION["products_cart"]) && isset($_SESSION["order"])) {

            $products = $_SESSION["products_cart"];
            $order = $_SESSION["order"];
            $order_id = $order["order_id"];
            $order_price = filter_var($order["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);



            echo "<div class='cart-summary'>
                    <h2>Resumo do Pedido</h2>";

            foreach ($products as $product) {
                $quantity = $product["quantity"];
                $order_quantity = $product["order_quantity"];
                $product_name = $product["name"];



                if ($quantity < $order_quantity) {
                    echo "<p> O produto $product_name acabou!   <a href=prod_list.php> <button class='continue-shopping-btn'>Continuar Comprando</button> </a>
                </div>";
                    die();
                }
            }
                  
           echo   " <p class='total'>Total: <span id='total'>$order_price</span></p>
                    <a href='purchase_page.php?id=$order_id'> <button class='checkout-btn'>Finalizar Compra</button> </a>
                      <a href=prod_list.php> <button class='continue-shopping-btn'>Continuar Comprando</button> </a>
                </div>";
                  
        }
    }


    public function check_errors()
    {

        if (!isset($_GET["error"])) {
            return;
        }

        echo '<br>';
        switch ($_GET["error"]) {
            case "empty_cart":
                echo "<b>O Carrinho está vazio!</b>";
                die();
                break;
            case "no_stock":
                $product_name = $_GET["product"];
                echo "O produto: $product_name está em falta!";
        }

        unset($_GET['error']);
    }
}
