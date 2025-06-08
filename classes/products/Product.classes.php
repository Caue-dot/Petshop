<?php

include_once("../classes/Upload.classes.php");
class Product extends Dbh
{
//Model



    protected function get_id_by_name($name){
        //Caso não tenha o nome retorna null
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
        //Pega um produto com determinado id do banco de dados
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
        //Deleta um produto com um determinado id do banco de dados

        //Deleta a imagem do produto 
        $product = $this->get_product_model($id);
        $upload = new Upload();
        $upload->delete_image($product["image"]);


        //Deleta do banco de dados o produto
        $query = "DELETE FROM products WHERE id = :id;";

        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    protected function set_product($name, $user_id, $description, $price, $image, $quantity, $animal)
    {
        //Insere no banco de dados um produto
        $query = "INSERT INTO products(user_id, name, description, image, price, quantity, animal) 
        VALUES (:user_id, :name, :description, :image, :price, :quantity, :animal)";

        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":animal", $animal);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function get_all_products_model()
    {
        //Pega todos os produtos do banco de dados
        $query = "SELECT * FROM products ORDER BY name";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function search_product_model($search){
        $query = "SELECT * FROM products WHERE MATCH(name, description) AGAINST(:search IN NATURAL LANGUAGE MODE);";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":search", $search);
        
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function search_product_by_tag_model($search){
        $query = "SELECT * FROM products WHERE MATCH(animal) AGAINST(:search IN NATURAL LANGUAGE MODE);";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":search", $search);
        
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    protected function update_product_model($id, $name, $description, $price, $image, $quantity, $animal){
        //Modifica um produto no banco de dados


        //Deleta a imagem antiga e cria a nova
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
        quantity = COALESCE(:quantity, quantity),
        animal = :animal
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
        $stmt->bindParam(":animal", $animal);

        $stmt->execute();
    }
}

