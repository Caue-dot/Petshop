
<?php
class Dbh{

    protected function connect(){
        try{
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=locahost;dbname=petshop', $username, $password);
            return $dbh;
        }catch(PDOException $e){
            print "Error!: ". $e . "<br>";
        }

    }

}