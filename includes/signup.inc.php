<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];


    try{
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // Checa se há erros nos inputs
        $errors = [];
        if(is_input_empty($username, $pwd, $email)){
            $errors["empty_input"] = "Preencha todos os campos!";
        }

        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Email inválido utilizado";
        }

        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "Nome de usuário já existente";
        }

        if(is_email_registered($pdo, $email)){
            $errors["email_used"] = "Email já cadastrado";
        }

        require_once 'config_session.inc.php';
        if($errors){
            //Caso haja erros cria um cookie com os erros
            $_SESSION["errors_signup"] = $errors;
            
            //Cria um cookie para salvar os campos preenchidos
            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        //Cria o usuario
        create_user($pdo, $pwd, $username, $email);
        header("Location: ../index.php?signup=success");
        $pdo = null;
        $stmt = null;

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }



}else{
    header("Location: ../index.php");
}