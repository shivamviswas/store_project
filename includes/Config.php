<?php

class Config
{
    public static function connect()
    {
        $host = 'localhost:3308';
        $user = 'root';
        $pass = '';
        $dbname = 'store';
        $con='';
        try {

            $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        } catch (PDOException $e) {
            echo "Connection failed" . $e->getMessage();
        }

        return $con;
    }
}