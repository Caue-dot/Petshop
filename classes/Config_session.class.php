<?php

// Configuração dos Cookies


class Config_Session
{
    private $interval = 60 * 30;

    private function regenerate_session_id()
    {
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }


    private function regenerate_session_id_loggedin()
    {
        session_regenerate_id(true);

        $userId = $_SESSION["user_id"];
        $newSessionId = session_create_id();
        $sessionId =  $newSessionId . "_"  . $userId;
        session_id($sessionId);

        $_SESSION["last_regeneration"] = time();
    }


    private function check_timer()
    {
        //Caso o cookie expire, Regenera e reseta o timer;
        if (time() - $_SESSION['last_regeneration']  < $this->interval) {
            return;
        }

        if (isset($_SESSION["user_id"])) {
            $this->regenerate_session_id();
        } else {
            $this->regenerate_session_id_loggedin();
        }
    }

    public function init()
    {
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_strict_mode', 1);

        session_set_cookie_params([
            'lifetime' => 1800,
            //Domain deverá ser modificado no futuro pelo endereço
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax'

        ]);
        

      

        session_start();

        if (isset($_SESSION['last_regeneration'])) {
            $this->check_timer();
            return;
        }

        if (isset($_SESSION["user_id"])) {
            //Cria o cookie caso não exista
            $this->regenerate_session_id_loggedin();
        } else {

            //Cria o cookie caso não exista
            $this->regenerate_session_id();
        }
    }
}
