<?php
declare(strict_types=1);


function get_username(object $pdo, string $username){
    //Pega o usuario com determinado username do banco de dados
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email){
    //Pega o usuario com determinado email do banco de dados
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $pwd, string $username, string $email){
    //Coloca as informações do usuario recem cadastrado no banco de dados
    $query = "INSERT INTO users(username, pwd, email) VALUES (:username, :pwd, :email)";

    $options = [
        'cost' => 12
    ];
    //Criptografia com hash na senha para aumentar a segurança antes de armazenar no banco de dados
    $hashedPwd = password_hash($pwd,PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}