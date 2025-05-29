<?php

declare(strict_types=1);


function signup_inputs(){
   

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
        $errors = $_SESSION["errors_signup"];

        echo "<br>";

        foreach($errors as $error){
            echo "<p> $error </p>";
        }

        unset($_SESSION["errors_signup"]);
    }else if(isset($_GET["signup"] ) && $_GET["signup"] === "success"){
        echo "<br>";
        echo "<p>Sign up success! </p>";

    }
}