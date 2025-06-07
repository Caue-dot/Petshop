<?php


class OrderContr extends Order {
    private $user_id;
    private $price = 0;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    

    private function get_products($status){

        $order = $this->get_order("cart");
        if(!$order){
            //ERRO
            die();
        }
        $order_id = $order["order_id"];

        return parent::get_products_model($order_id);
    }
    private function get_product($product_id){
        $order = $this->get_order("cart");
        $product = parent::get_product_model($order["order_id"], $product_id);
        
        return $product;
    }

    private function get_order($status){
        return parent::get_orders_model($this->user_id, $status);
    }

    private function create_order(){
        parent::set_order($this->user_id, $this->price);
    }

    public function add_product($product_id){
        $order = $this->get_order("cart");
        if(!$order){
            $this->create_order();
            $order = $this->get_order("cart");
        }

        $order_id = $order["order_id"];

        $product = $this->get_product($product_id);
        
        if($product){

            //Checa se já possui o item no carrinho caso já possua aumenta a quantidade
            $product_id = $product["product_id"];
            $product_quantity = $product["quantity"];   
            parent::set_quantity($order_id, $product_id , $product_quantity+1);
            return;
        }
        parent::set_product($order_id, $product_id, 1);

    }

    public function purchase_order(){
        $order = $this->get_order("cart");
        if(!$order){
            //ERRO
            die();
        }
        $order_id = $order["order_id"];
        parent::set_order_status($order_id, "purchased");
    }

}