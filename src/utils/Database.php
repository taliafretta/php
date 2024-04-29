<?php

class Database
{
    public $connection;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "database";

    public function __construct()
    {
        // Create connection
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        return $this->connection;
    }

    // Close connection
    function closeConnection()
    {
        $this->connection->close();
    }
}
