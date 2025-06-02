<?php

class Signup extends Dbh
{

    protected function get_username(string $username)
    {
        //Pega o usuario com determinado username do banco de dados

        $query = "SELECT username FROM users WHERE username = :username;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function get_email(string $email)
    {
        //Pega o usuario com determinado email do banco de dados
        $query = "SELECT email FROM users WHERE email = :email;";
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    protected function set_user(string $pwd, string $username, string $email)
    {
        //Coloca as informações do usuario recem cadastrado no banco de dados
        $query = "INSERT INTO users(username, pwd, email) VALUES (:username, :pwd, :email)";
        
        $options = [
            'cost' => 12
        ];
        //Criptografia com hash na senha para aumentar a segurança antes de armazenar no banco de dados
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
        
        $pdo = parent::connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
