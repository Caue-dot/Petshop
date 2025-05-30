<?php

declare(strict_types=1);

require_once 'prod_cad_model.inc.php';

function is_input_empty(string $name, string $description, int $price, array $img) : bool{
    //Checa se os inputs estão vazios
    if(empty($name) || empty($description) || empty($price) || !isset($img)){
        return true;
    }else{
        return false;
    }
}


function is_product_registered($pdo, $name){
    if(get_product($pdo, $name)){
        return true;
    }else{
        return false;
    }
}