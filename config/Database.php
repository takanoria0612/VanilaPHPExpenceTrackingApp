<?php
//config/Database.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Database {
    private $host = 'localhost';
    private $port = 8889; // MySQLポートを追加
    private $db_name = 'phpusdproject';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            // ポート番号を接続文字列に追加
            $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
