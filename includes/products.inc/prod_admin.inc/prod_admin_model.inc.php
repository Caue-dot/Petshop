
<?php


function get_product($pdo, $id){
    $query = "SELECT * FROM products WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}  


function get_all_products($pdo){
    $query = "SELECT * FROM products";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}  

function delete_product($pdo, $id){
    require_once 'upload.php';
    $product = get_product($pdo, $id);
    delete_image($product["image"]);

    $query = "DELETE FROM products WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}