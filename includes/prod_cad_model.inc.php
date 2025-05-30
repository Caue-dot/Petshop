<?php

declare(strict_types=1);

function get_product($pdo, $name){
    $query = "SELECT * FROM products WHERE name = :name;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_product($pdo, $name,$user_id, $description, $price, $image){
    $query = "INSERT INTO products(user_id, name, description, image, price) VALUES (:user_id, :name, :description, :image, :price)";


    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":price", $price);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}