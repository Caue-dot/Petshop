<?php

class SignupContr{
    private $username;
    private $pwd;
    private $email;


    public function __construct($username, $pwd, $email)
    {   
        $this->username  = $username;
        $this->pwd = $pwd;
        $this->email = $email;
    }
}