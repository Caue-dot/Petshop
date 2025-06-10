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


    public function list_products()
    {

        //Lista todos os produtos
        if (isset($_SESSION["order_products"]) && $_SESSION["order_products"]) {
            $products = $_SESSION["order_products"];


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
        }
        unset($_SESSION["order_products"]);
    }
}
