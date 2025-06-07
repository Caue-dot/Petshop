<?php


class Order extends Dbh{
    protected function set_order($user_id, $price){
        $query = "INSERT INTO orders(user_id, order_status, price) VALUES (:user_id, 'cart', :price)";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":price", $price);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    protected function set_order_status($order_id, $status){
        $query = "UPDATE orders SET order_status = :order_status  WHERE order_id = :order_id;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_status", $status);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();

    }

    protected function get_orders_model($user_id, $status){
        $query = "SELECT * FROM orders WHERE user_id = :user_id AND order_status = :order_status;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":order_status", $status);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function set_product($order_id, $product_id, $quantity){
        $query = "INSERT INTO orders_products(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function get_product_model($order_id, $product_id){
        $query = "SELECT * FROM orders_products WHERE order_id = :order_id AND product_id = :product_id;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function get_products_model($order_id){
        $query = "SELECT * FROM orders_products WHERE order_id = :order_id;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function set_quantity($order_id, $product_id, $quantity){
        $query = "UPDATE orders_products SET quantity = :quantity WHERE order_id = :order_id AND product_id = :product_id;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->execute();

    }
    
}