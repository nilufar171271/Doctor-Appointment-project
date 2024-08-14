<?php

namespace App;


use PDO, PDOException;

class Database 
{
    public $servername = "localhost";
    public $username = "root";
    //public $password = "";
    public $password = "";
    public $database ="appointment";
    public $DBH;
    public function __construct(){


        try {
             $this->DBH = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            

            // set the PDO error mode to exception
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $this->DBH;
        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }


    }

}
