<?php
include_once("../classes/Dbh.inc.php");
include_once("../classes/products/Product.classes.php");
include_once("../classes/products/ProductContr.classes.php");

class OrderContr extends Order {
    private $user_id;
    private $price = 0;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    

    public function get_products($order_id){

        $order = $this->get_order_by_id($order_id);
        if(!$order){
            //ERRO
            die();
        }

        return parent::get_products_model($order_id);
    }
    private function get_product($product_id){
        $order = $this->get_orders("cart");
        $product = parent::get_product_model($order[0]["order_id"], $product_id);
        
        return $product;
    }

    public function get_orders($status){
        return parent::get_orders_model($this->user_id, $status);
    }

    public function get_order_by_id($order_id){
        return parent::get_order_by_id_model($order_id);
    }



    private function create_order(){
        parent::set_order($this->user_id, $this->price);
    }

    public function add_product($product_id, $price){
        $order = $this->get_orders("cart");
        if(!$order){
            $this->create_order();
            $order = $this->get_orders("cart");
        }

        $order_id = $order[0]["order_id"];

        $product = $this->get_product($product_id);
        if($product){

            //Checa se já possui o item no carrinho caso já possua aumenta a quantidade
            $product_id = $product["product_id"];
            $product_quantity = $product["quantity"];   
            parent::set_quantity($order_id, $product_id , $product_quantity+1);
            parent::add_price_order($order_id, $price);
            return;
        }
        parent::add_price_order($order_id, $price);
        parent::set_product($order_id, $product_id, 1);

    }

    public function purchase_order(){
        $order = $this->get_orders("cart");
        if(!$order){
            //ERRO
            // die();
        }

        $order_id = $order[0]["order_id"];

        $this->remove_quantity($order_id);
        parent::set_order_status($order_id, "purchased");
    }

    
    private function remove_quantity($order_id)
    {
        parent::remove_quantity_from_order($order_id);
    }

}