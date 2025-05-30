<?php

declare(strict_types=1);

use BcMath\Number;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $price = (int)$price;
    $file = $_FILES["img"];
    

    try{
        require_once 'dbh.inc.php';
        require_once '../upload.php';
        require_once 'prod_cad_model.inc.php';
        require_once 'prod_cad_contr.inc.php';

        $errors = [];
        
        $user_id = $_SESSION["user_id"];
        if(is_input_empty($name, $description, $price, $file)){
            $errors["empty_input"] = "Preencha todos os campos!";
        }

        if(is_product_registered($pdo, $name)){
            $errors["product_registered"] = "Este nome já foi utilizado para outro produto!";
        }
        
        $img_path = upload_image($file);
        
        require_once 'config_session.inc.php';
        if($errors){
            $_SESSION["errors_prod_cad"] = $errors;
            header("Location: ../prod_cad.php");
            die();
        }

        
        if(is_array($img_path)){
            
        }
        set_product($pdo, $name,$user_id, $description, $price, $img_path);
        header("Location: ../prod_cad.php?cad=success");

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }



}else{
    header("Location: ../prod_cad.php");
}