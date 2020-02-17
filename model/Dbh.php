<?php

class Dbh
{
    public function connect()
    {
        $host = 'localhost:3308';
        $user = 'root';
        $pass = '';
        $dbname = 'store';
        $con='';
        try {

            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass,$opt);


           // $con->setAttribute($opt);

        } catch (PDOException $e) {

            echo "Connection failed" . $e->getMessage();
        }

        return $con;
    }

}