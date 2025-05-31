<?php

declare(strict_types=1);

function check_upload_errors(){
    if(isset($_SESSION["errors_upload"])){
        $errors = $_SESSION["errors_upload"];

        echo '<br>';

        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        unset($_SESSION["errors_upload"]);
    }
}

function check_cad_errors(){
    if(isset($_SESSION["errors_prod_cad"])){
        $errors = $_SESSION["errors_prod_cad"];

        echo '<br>';

        foreach ($errors as $error) {
            echo $error;
        }

        unset($_SESSION["errors_prod_cad"]);

    }else if(isset($_GET["cad"]) && $_GET["cad"]==="success"){

        echo 'Produto cadastrado com sucesso!';
    }
}