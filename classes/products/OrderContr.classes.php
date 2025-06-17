<?php
include_once("../classes/Dbh.inc.php");
include_once("../classes/products/Product.classes.php");
include_once("../classes/products/ProductContr.classes.php");

class OrderContr extends Order
{
    private $user_id;
    private $price = 0;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }


    public function get_products($order_id)
    {

        $order = $this->get_order_by_id($order_id);
        if (!$order) {
            //ERRO
            die();
        }

        return parent::get_products_model($order_id);
    }
    private function get_product($product_id)
    {
        $order = $this->get_orders("cart");
        $product = parent::get_product_model($order[0]["order_id"], $product_id);

        return $product;
    }

    public function get_orders($status)
    {
        return parent::get_orders_model($this->user_id, $status);
    }

    public function get_order_by_id($order_id)
    {
        return parent::get_order_by_id_model($order_id);
    }

  
    private function create_order()
    {
        parent::set_order($this->user_id, $this->price);
    }

    public function add_product($product,$quantity ,$redirect_error)
    {
        $order = $this->get_orders("cart");
        $product_quantity = $product["quantity"];
        $product_id = $product["id"];
        $price = $product["price"];
        $total_price = $price * $quantity;

        if (!$order) {
            $this->create_order();
            $order = $this->get_orders("cart");
        }
        if(count($order) > 1){
            echo "erro fatal";
            die();
        }
        $order_id = $order[0]["order_id"];

        $order_product = $this->get_product($product_id);


        if($product["quantity"] < $quantity){
            //ERRO
            echo 'Você está tentando adicionar mais do que tem no estoque!'; 
            die();
        }
        if ($order_product!==false) {

            //Checa se já possui o item no carrinho caso já possua aumenta a quantidade
            $order_product_id = $order_product["product_id"];
            $order_quantity = $order_product["order_quantity"];

            if ($product_quantity <= $order_product["order_quantity"]) {
                header("Location: " . $redirect_error . "?error=no_quantity");
                die();
            }
            parent::add_price_order($order_id, $total_price);
            parent::set_quantity($order_id, $order_product_id, $order_quantity + $quantity);

            return;
        }

        parent::add_price_order($order_id, $total_price);
        parent::set_product($order_id, $product_id, $quantity);
    }

    public function remove_product($product_id){
        $order = $this->get_orders("cart")[0];
        $order_id = $order["order_id"];

        $order_product = $this->get_product($product_id);
        if(!$order){
            //ERRO
            echo('Um erro inesperado aconteceu :(');
            die();

        }

    
        
        $price = $order_product["price"] * $order_product["order_quantity"];

        parent::remove_price_order($order_id, $price);
        parent::remove_product_model($product_id, $order_id);

        if($this->get_products($order_id) == false){
            //Sem produtos no carrinho!
            $this->delete_order($order_id);
            

        }


    }

    public function purchase_order($redirect_error){
        $order = $this->get_orders("cart");
        if (!$order) {
            echo 'Não ha pedidos a serem comprados';
            die();
        }

        $order_id = $order[0]["order_id"];
        $products = $this->get_products($order_id);
        foreach ($products as $product){
            $quantity = $product["quantity"];
            $order_quantity = $product["order_quantity"];
            $product_name= $product["name"];

    
            if($quantity < $order_quantity){
                header("location: $redirect_error?error=no_stock&product=$product_name");
                die();
            }
        }
        
        parent::remove_products_stock_model($order_id);
        parent::set_order_status($order_id, "purchased");
        unset($_SESSION["products"]);
        unset($_SESSION["product"]);
        unset($_SESSION["order"]);
    }

    protected function delete_order($order_id){
        if($this->get_order_by_id($order_id)){
            //Order existe
            parent::delete_order($order_id);
            unset($_SESSION["orders"]);
            unset($_SESSION["products_cart"]);
        }
    }

  
  


  
}
