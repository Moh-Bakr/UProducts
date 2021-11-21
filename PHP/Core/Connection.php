<?php

class Connection
{
    public static function GetConnection()
    {
        $host = "";
        $database_name = "";
        $username = "";
        $password = "";
        $conn = null;
        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $database_name, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $conn;
    }

}

