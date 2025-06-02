<?php

class SignupContr extends Signup
{
    private $username;
    private $pwd;
    private $email;


    public function __construct($username, $pwd, $email)
    {
        $this->username  = $username;
        $this->pwd = $pwd;
        $this->email = $email;
    }

    private function is_input_empty(): bool
    {
        //Checa se os inputs estão vazios
        if (empty($this->username) || empty($this->pwd) || empty($this->email)) {
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

    private function is_username_taken()
    {
        //Checa se o usuario já existe no banco de dados
        if (parent::get_username($this->username)) {
            return true;
        } else {
            return false;
        }
    }

    private function is_email_registered()
    {
        //Checa se o email ja existe no banco de dados
        if (parent::get_email($this->email)) {
            return true;
        } else {
            return false;
        }
    }


    public function create_user()
    {
        // Faz uma chamada no banco de dados para enviar os dados do usuario
        parent::set_user($this->pwd, $this->username, $this->email);


        if ($this->is_input_empty()) {
            header("Location: ../../public/index.php?error=empty_input");
            die();
        }

        if ($this->is_email_invalid()) {
            header("Location: ../../public/index.php?error=invalid_email");
            die();
        }

        if ($this->is_username_taken()) {
            header("Location: ../../public/index.php?error=username_taken");
            die();
        }
        if ($this->is_email_registered()) {
            header("Location: ../../public/index.php?error=email_already_registered");
            die();
        }

        parent::set_user($this->pwd, $this->username, $this->email);

        header("Location: ../../public/index.php");
    }
}
