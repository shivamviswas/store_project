<?php

include_once('Dbh.php');

class Admin extends Dbh
{

    protected function setUser($name, $mobile, $password, $role, $status)
    {

        $name = (new self)->validString($name);
        $mobile = (new self)->validString($mobile);
        $password = (new self)->validPass($password);
        $role = (new self)->validString($role);
        $status = (new self)->validString($status);

        if (!$this->isUserExist($mobile)){
            $qry = $this->connect()->prepare(
                "INSERT INTO `admin`(`name`, `mobile`, `pass`, `role`, `status`) 
            VALUES (:names,:mobile,:pass,:role,:status)");

        $qry->bindParam(':names', $name);
        $qry->bindParam(':mobile', $mobile);
        $qry->bindParam(':pass', $password);
        $qry->bindParam(':role', $role);
        $qry->bindParam(':status', $status);

        return $qry->execute();
        }
        else{
          return false;
        }


    }

    protected function checkUser($mobile, $password)
    {

        $mobile = (new self)->validString($mobile);
        $password = (new self)->validPass($password);

        $qry = $this->connect()->prepare("SELECT * FROM `admin` WHERE mobile=:mobile AND pass=:pass");

        $qry->bindParam(':mobile', $mobile);
        $qry->bindParam(':pass', $password);;
        $qry->execute();

        if ($qry->rowCount() > 0) {
            return $qry;
        } else {
            return '0';
        }


    }

    protected function isUserExist($mobile)
    {
        $mobile = (new self)->validString($mobile);
        $qry = $this->connect()->prepare("SELECT * FROM `admin` WHERE mobile=:mobile");
        $qry->bindParam(':mobile', $mobile);
        $qry->execute();
        if ($qry->rowCount() === 1) {
            return true;
        } else {
            return false;
        }


    }

    public function validString($string)
    {
        $string = strip_tags($string);
        $string = str_replace(" ", "", $string);
        return $string;
    }

    public function validPass($string)
    {
        $string = md5($string);
        return $string;
    }
}