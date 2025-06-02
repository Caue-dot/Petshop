<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verifica se e a requisição é post e coloca os valores do formulario em variáveis

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    include '../classes/Dbh.inc.php';
    include '../classes/Config_session.class.php';
    include '../classes/user_auth/User.classes.php';
    include '../classes/user_auth/UserContr.classes.php';


    $session = new Config_Session();
    $session->init();
    $user = new UserContr($username, $pwd, null);
    $user->login_user();
} else {
    header("Location: ../../index.php");
}
