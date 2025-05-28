<?php

//Informações do banco de dados
$dsn = "mysql:host=localhost; dbname:petshop";
$dbusername = "root";
$dbpassword = "";



try{
    
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    //Configurar o pdo para acusar o erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
echo "Connection failed: ". $e -> getMessage();

}