<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) : bool{
    //Checa se os inputs estão vazios
    if(empty($username) || empty($pwd) || empty($email)){
        return true;
    }else{
        return false;
    }
}

function is_email_invalid(string $email){
    // Checa se o email é valido
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function is_username_taken(object $pdo, string $username){
    //Checa se o usuario já existe no banco de dados
    if(get_username($pdo, $username)){
        return true;
    }else{
        return false;
    }
}

function is_email_registered(object $pdo, string $email){
    //Checa se o email ja existe no banco de dados
    if(get_email($pdo, $email)){
        return true;
    }else{
        return false;
    }
}

function create_user(object $pdo, string $pwd, string $username, string $email){
    // Faz uma chamada no banco de dados para enviar os dados do usuario
    set_user($pdo,  $pwd,  $username,  $email);
}