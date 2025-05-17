<?php

namespace App\Config;

use App\Interface\DatabaseInterface;
use mysqli;

include __DIR__ . '/../../app/interface/databaseInteface.php';

class Database implements DatabaseInterface
{

    protected $host, $username, $password, $database, $conn;
    public function __construct()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'sam-jaya';
    }

    public function connect()
    {
        if ($this->conn === null) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
            $this->conn->set_charset("utf8mb4");
        }
        return $this->conn;
    }
}
