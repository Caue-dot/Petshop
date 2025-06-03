<?php

include_once("../classes/Upload.classes.php");
class Product extends Dbh
{


    protected function get_id_by_name($name){
        if(!isset($name)) return null;
        
        $query = "SELECT id FROM products WHERE name = :name;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function get_product_model($id)
    {
        $query = "SELECT * FROM products WHERE id = :id;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    


    protected function delete_product($id)
    {
        $product = $this->get_product_model($id);
        $upload = new Upload();
        $upload->delete_image($product["image"]);

        $query = "DELETE FROM products WHERE id = :id;";

        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    protected function set_product($name, $user_id, $description, $price, $image, $quantity)
    {
        $query = "INSERT INTO products(user_id, name, description, image, price, quantity) VALUES (:user_id, :name, :description, :image, :price, :quantity)";

        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quantity", $quantity);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function get_products()
    {
        $query = "SELECT * FROM products";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    protected function update_product_model($id, $name, $description, $price, $image, $quantity){

        $product = $this->get_product_model($id);
        $img_path = null;
        if($image["size"] != 0){
            $upload = new Upload();
            $upload->delete_image($product["image"]);
            $img_path = $upload->upload_image($image, "../prod_list.php");

        }


        $query = "UPDATE products 
        SET 
        name = COALESCE(:name, name),
        description = COALESCE(:description, description),
        price = COALESCE(:price, price),
        image = COALESCE(:image, image),
        quantity = COALESCE(:quantity, quantity)
        WHERE id = :id

        ";

        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $img_path);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quantity", $quantity);

        $stmt->execute();
    }
}

