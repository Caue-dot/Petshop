<?php

class UserView
{

    public function check_errors_login()
    {
        if (isset($_GET["error_login"])) {
            switch ($_GET["error_login"]) {
                case 'empty_input':
                    echo 'Preencha todos os campos!';
                    break;
                case 'information_wrong':
                    echo 'Usuário ou senha errados';
            }
        } else if (isset($_GET["login"]) && $_GET["login"] == "success") {
            echo 'Login realizado com sucesso!';
        }
    }


    public function check_errors_signup()
    {
        if (isset($_GET["error_signup"])) {

            switch ($_GET["error_signup"]) {
                case 'empty_input':
                    echo 'Preencha todos os campos!';
                    break;
                case 'invalid_email':
                    echo 'Email inválido';
                    break;
                case  'username_taken':
                    echo 'Esse nome de usuário ja foi registrado';
                    break;
                case 'email_already_registered':
                    echo 'Esse email já está cadastrado!';
                    break;
            }
        } else if (isset($_GET["register"]) && $_GET["register"] == "success") {
            echo 'Cadastro realizado com sucesso!';
        }
    }

    public function login_info()
    {
        if (isset($_SESSION["user_username"])) {
            echo $_SESSION["user_username"];
        } else {
            echo "not logged in";
        }
    }
}
