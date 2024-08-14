<?php

namespace App;


use PDO, PDOException;

class Db extends PDO
{
    private $host   = 'localhost';
    private $user   = 'root';
    private $pass   = '';
    private $dbname = 'appointment';
    

    public function __construct($dsn = null, $user = null, $pass = null, $opts = null)
    {
        parent::__construct(
            "mysql:host={$this->host};dbname={$this->dbname}",
            $this->user,
            $this->pass,
            $opts
        );
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}