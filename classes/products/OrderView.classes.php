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
                $price = filter_var($order["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                echo "<a href='order_products.php?id=$order_id'>";
                echo "Pedido n:" . $order_id . " " . "R$" . $price;
                echo "</a>";
                echo '<br> <br> <br>';
            }
            unset($_SESSION["orders"]);
        }
    }


    public function list_products($name)
    {

        //Lista todos os produtos
        if (isset($_SESSION[$name]) && $_SESSION[$name]) {
            $products = $_SESSION[$name];


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
                echo '<br> <br> <br>';
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
    }



    public function cart_summary()
    {
        if (isset($_SESSION["products_cart"]) && isset($_SESSION["order"])) {

            $order = $_SESSION["order"];
            $order_price = filter_var($order["price"], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);


            echo "<div class='cart-summary'>
                    <h2>Resumo do Pedido</h2>
                    <p class='total'>Total: <span id='total'>$order_price</span></p>
                    <a href='includes/cart_list.inc.php?buy=true'> <button class='checkout-btn'>Finalizar Compra</button> </a>
                    <a href=prod_list.php> <button class='continue-shopping-btn'>Continuar Comprando</button> </a>
                </div>";
        }
    }
}
