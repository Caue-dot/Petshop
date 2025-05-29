<?php

declare(strict_types=1);


function signup_inputs(){
    //Cria os inputs, e caso ja tenha salvo algum input do cookie "signup_data" e não tenha erros preenche automaticamente.

    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])){
        echo '<input type="text" name=username placeholder="Usuario" value="' . $_SESSION["signup_data"] ["username"] . '">';
        echo '<br>';
    }else{
        echo '<input type="text" name="username" placeholder= "Usuario" value="">';
      
        echo '<br>';

    }
    echo '<input type="text" name="pwd" placeholder="Senha">';
    echo '<br>';

     if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])){
        echo '<input type="text" name=email placeholder="Email" value="' . $_SESSION["signup_data"] ["email"] . '">';
        echo '<br>';
    }else{
        echo '<input type="text" name="email" placeholder="Email" value=""> ';
        echo '<br>';

    }

    unset($_SESSION["signup_data"]);

}

function check_signup_errors(){
    if(isset($_SESSION["errors_signup"])){
        //Caso tenha erro, mostra pro usuário
        $errors = $_SESSION["errors_signup"];

        echo "<br>";

        foreach($errors as $error){
            echo "<p> $error </p>";
        }

        unset($_SESSION["errors_signup"]);
    }else if(isset($_GET["signup"] ) && $_GET["signup"] === "success"){
        //Caso tenha sido cadastrado com sucesso mostre pro usuario 
        echo "<br>";
        echo "<p>Cadastrado com sucesso! </p>";

    }
}