
<?php

function get_all_products($pdo){
    $query = "SELECT * FROM products";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}  