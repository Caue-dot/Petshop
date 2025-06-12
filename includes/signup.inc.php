<?php
//Cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/user_auth/User.classes.php';
    include '../classes/user_auth/UserContr.classes.php';

    $session = new Config_Session();
    $session->init();
    $user = new UserContr($username, $pwd, $email);
    //Cria o usuario
    $user->create_user();
    header("Location: ../auth_page.php?register=success");
} else {
    header("Location: ../../index.php");
   
}

 die();
