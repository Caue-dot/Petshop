<?php

declare(strict_types=1);
define ('SITE_ROOT', realpath(dirname(__FILE__)));



function upload_image(array $file){
    $errors = [];
    $target_dir = "img_uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if(empty($file["tmp_name"])){
        $errors["file_empty"] = "Por favor, insira um arquivo";
    }
    //Checa se a imagem é uma imagem falsa
    if(isset($_POST["submit"]) && !empty($file["tmp_name"])){
        $check = getimagesize($file["tmp_name"]);
        if($check == false){
            $errors["not_image"] = "Este arquivo não é uma imagem!";
        }
    }

    if(file_exists($target_file)){
        $errors["already_exists"] = "Já existe um arquivo de mesmo nome!";
    }


    if($file["size"] > 500000){
        $errors["too_big"] = "Desculpe, este arquivo é muito grande.";
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
        $errors["extension_not_supported"] = "Desculpe, apenas JPG, JPEG e PNG são permitidos";
    }

    require_once '../includes/config_session.inc.php';
    if($errors){
        $_SESSION["errors_upload"] = $errors;
        header("Location: /prod_cad.php");
        return false;
    }

    if(move_uploaded_file($file["tmp_name"],  SITE_ROOT ."/" .$target_file)){
        return $target_file;
    }else{
        $errors["unexpected"] = "Desculpe, houve um erro ao subir a imagem.";
        $_SESSION["errors_upload"] = $errors;
        return false;
    }

}