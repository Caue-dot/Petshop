<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];


    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // Checa se há erros nos inputs
        $errors = [];
        if(is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Preencha todos os campos!";
        }

        $result = get_user($pdo, $username);

        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Usuario ou senha incorretos!";
        }

        $hashed_pwd = $result["pwd"];
        if(!is_username_wrong($result) && is_password_wrong($pwd, $hashed_pwd)){
            $errors["login_incorrect"] = "Usuario ou senha incorretos!";
        }


        require_once 'config_session.inc.php';
        if($errors){
            //Caso haja erros cria um cookie com os erros
            $_SESSION["errors_login"] = $errors;
         
            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId =  $newSessionId . "_"  . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = $result["username"];

        $_SESSION["last_regeneration"] = time();
        header("Location: ../index.php?login=success");

        $pdo = null;
        $stmt = null;

        die();

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }



}else{
    header("Location: ../index.php");
}