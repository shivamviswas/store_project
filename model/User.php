<?php

include_once('Dbh.php');

class User extends Dbh
{
    protected function setUser($name, $mobile, $code, $date, $status)
    {

        $mobile = (new self)->validString($mobile);
        $code = (new self)->validString($code);
        $date = (new self)->validString($date);
        $status = (new self)->validString($status);

        if (!$this->isUserExist($code)) {
            $qry = $this->connect()->prepare("INSERT INTO `users`( `code`, `name`, `mobile`, `status`, `dateTime`) 
                                                        VALUES (:code,:names,:mobile,:status,:date)");

            $qry->bindParam(':names', $name);
            $qry->bindParam(':mobile', $mobile);
            $qry->bindParam(':code', $code);
            $qry->bindParam(':date', $date);
            $qry->bindParam(':status', $status);

            return $qry->execute();
        } else {
            return false;
        }


    }

    protected function updateUser($id, $name, $code, $mobile)
    {
        $id = (new self)->validString($id);
        $mobile = (new self)->validString($mobile);
        $status='Active';
        $qry = $this->connect()->prepare("UPDATE `users` SET `name`= :names,`mobile`= :mobile WHERE user_id = :id AND status = :s");
        $qry->bindParam(':names', $name);
        $qry->bindParam(':mobile', $mobile);
        $qry->bindParam(':id', $id);
        $qry->bindParam(':s', $status);
        return $qry->execute();
    }

    protected function isUserExist($mobile)
    {
        $mobile = (new self)->validString($mobile);

        $qry = $this->connect()->prepare("SELECT * FROM `users` WHERE code = :mobile",
            array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

        $qry->bindParam(':mobile', $mobile);

        $qry->execute();
        if ($qry->rowCount() === 1) {
            return true;
        } else {
            return false;
        }


    }

    public function getUser()
    {
        $qry = $this->connect()->prepare("SELECT * FROM `users`");
        $qry->execute();
        return $qry;
    }

    public function userQuery()
    {
        $qry = $this->connect()->prepare("SELECT * FROM `users`");
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `users` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }


    protected function updateUserStatus($user_id, $status)
    {
        $user_id = (new self)->validString($user_id);
        $status = (new self)->validString($status);

        $qry = $this->connect()->prepare("UPDATE `users` SET `status`= :status WHERE user_id = :id");
        $qry->bindParam(':status', $status);
        $qry->bindParam(':id', $user_id);
        return $qry->execute();

    }

    protected function totalUsers()
    {
        return $this->userQuery()->rowCount();
    }

    protected function allUsersData()
    {
        return $this->userQuery()->fetchAll();
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