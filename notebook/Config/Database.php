<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $db_name = "notebook";
    private $username = "root";
    private $password = "";
    private $connection = null;

    public function getConnection()
    {
        if (is_null($this->connection)) {
            try {
                $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->connection->exec("set names utf8");
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
        }
        return $this->connection;
    }

    private function query($sql, $params)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function queryLimit($sql, $start, $end)
    {
        $stmt = $this->getConnection()->prepare($sql);

        $stmt->bindParam(1, $start, PDO::PARAM_INT);
        $stmt->bindParam(2, $end, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOneObject($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function queryAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params);
    }

}