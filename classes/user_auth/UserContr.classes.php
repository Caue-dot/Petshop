<?php

class UserContr extends User
{
    private $username;
    private $pwd;
    private $email;
    private $redirect_path = "../auth_page.php";

    public function __construct($username, $pwd, $email)
    {
        $this->username  = $username;
        $this->pwd = $pwd;
        $this->email = $email;
    }



    private function is_input_empty_register(): bool
    {
        //Checa se os inputs estão vazios
        if (empty($this->username) || empty($this->pwd) || empty($this->email)) {
            return true;
        } else {
            return false;
        }
    }

     private function is_input_empty_login(): bool
    {
        //Checa se os inputs estão vazios
        if (empty($this->username) || empty($this->pwd)) {
            return true;
        } else {
            return false;
        }
    }

    private function is_email_invalid()
    {
        // Checa se o email é valido
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    private function username_to_user()
    {
        //Checa se o usuario já existe no banco de dados

        $result = parent::get_user_by_username($this->username);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    private function is_email_registered()
    {
        //Checa se o email ja existe no banco de dados
        if (parent::get_user_by_email($this->email)) {
            return true;
        } else {
            return false;
        }
    }

    private function is_password_wrong($hashed_pwd)
    {
        //Checa se a senha está errada
        if (!password_verify($this->pwd, $hashed_pwd)) {
            return true;
        } else {
            return false;
        }
    }

    //Register
    public function create_user()
    {
       


        //Error handlers
        if ($this->is_input_empty_register()) {
            header("Location:" . $this->redirect_path . "?error_signup=empty_input");
            die();
        }

        if ($this->is_email_invalid()) {
            header("Location:" . $this->redirect_path . "?error_signup=invalid_email");
            die();
        }

        if ($this->username_to_user()) {
            header("Location:" . $this->redirect_path  . "?error_signup=username_taken");
            die();
        }
        if ($this->is_email_registered()) {
            header("Location:" . $this->redirect_path . "?error_signup=email_already_registered");
            die();
        }


        // Insere no banco de dados o usuario recem cadastrado
        parent::set_user($this->pwd, $this->username, $this->email);

        header("Location:" . $this->redirect_path. "?register=success");
        die();
    }

    //Login

    public function login_user()
    {

        //Error handlers
        if ($this->is_input_empty_login()) {
            header("Location:" . $this->redirect_path . "?error_login=empty_input");
            die();
        }

        $user = $this->username_to_user();
        if (!$user) {
            header("Location:" . $this->redirect_path . "?error_login=information_wrong");
            die();
        }

        $hashed_pwd = $user["pwd"];
        if ($this->is_password_wrong($hashed_pwd)) {
            header("Location:" . $this->redirect_path . "?error_login=information_wrong");
            die();
        }

        //Cria uma novo cookie de sessão
        $newSessionId = session_create_id();
        $sessionId =  $newSessionId . "_"  . $user["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_username"] = $user["username"];

        $_SESSION["last_regeneration"] = time();
        header("Location:" . $this->redirect_path . "?login=success");

        die();
    }
}
