<?php

class Signup extends Dbh{

    protected function checkUser($id, $email){
        $query = 'SELECT id FROM users WHERE id = ? OR user_email = ?;';
        $stmt = parent::connect()->prepare($query);

        if(!$stmt->execute(array($id, $email))){
            $stmt = null;
            header("Location: ../../public/index.php?error=stmtfailed");
        }
    }
}