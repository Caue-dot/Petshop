<?php

//Informações do banco de dados

$host = 'localhost';
$dbname = 'petshop';
$dbusername = "root";
$dbpassword = "";



try{
    
    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $dbusername, $dbpassword);
    //Configurar o pdo para acusar o erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
echo "Connection failed: ". $e -> getMessage();

}