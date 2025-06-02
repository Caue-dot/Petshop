<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/user_auth/Signup.classes.php';
    include '../classes/user_auth/Signup_contr.classes.php';

    $session = new Config_Session();
    $session->init();
    $signup = new SignupContr($username, $pwd, $email);
    $signup->create_user();
} else {
    header("Location: ../../../index.php");
}
