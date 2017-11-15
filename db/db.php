<?php
namespace db;
use PDO;
class db
{
    private $connection;

    function __construct($dsn = "mysql:host=localhost;dbname=news", $user = 'root', $pass = '')
    {
        $this->connection = new PDO($dsn,$user,$pass);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }


}

