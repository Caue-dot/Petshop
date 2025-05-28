<?php

// Configuração dos Cookies

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime' => 1800,
    //Domain deverá ser modificado no futuro pelo endereço
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true

]);

session_start();


if(!isset($_SESSION['last_regeneration'])){
    //Cria o cookie caso não exista
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}else{
    $interval = 60 * 30;
    //Caso o cookie expire, Regenera e reseta o timer;
    if(time() - $_SESSION['last_regeneration']  >= $interval){
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
