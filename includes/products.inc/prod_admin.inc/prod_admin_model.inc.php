
<?php

function get_all_products($pdo){
    $query = "SELECT * FROM products";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}  

function delete_product($pdo, $id){
    $query = "DELETE FROM products WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}