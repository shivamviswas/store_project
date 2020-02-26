<?php

include_once('Dbh.php');

class Category extends Dbh
{
    protected function setCategory($name, $dec, $status)
    {

        if (!$this->isUserExist($name)) {
            $qry = $this->connect()->prepare("INSERT INTO `category`(`category_name`, category_des, `category_status`) 
                                            VALUES (:names,:dec,:status)");

            $qry->bindParam(':names', $name);
            $qry->bindParam(':dec', $dec);
            $qry->bindParam(':status', $status);

            return $qry->execute();
        } else {
            return false;
        }


    }

    protected function updateCategory($id, $name, $des)
    {

        $status='Active';
        $qry = $this->connect()->prepare("UPDATE `category` SET `category_name`= :names,`category_des`= :mobile WHERE category_id = :id AND category_status = :s");
        $qry->bindParam(':names', $name);
        $qry->bindParam(':mobile', $des);
        $qry->bindParam(':id', $id);
        $qry->bindParam(':s', $status);
        return $qry->execute();
    }


    protected function isUserExist($mobile)
    {

        $qry = $this->connect()->prepare("SELECT * FROM `category` WHERE category_name = :mobile",
            array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

        $qry->bindParam(':mobile', $mobile);

        $qry->execute();
        if ($qry->rowCount() === 1) {
            return true;
        } else {
            return false;
        }


    }


    public function categoryQuery()
    {
        $qry = $this->connect()->prepare("SELECT * FROM `category`");
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `category` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }


    protected function updateCategoryStatus($user_id, $status)
    {

        $qry = $this->connect()->prepare("UPDATE `category` SET `category_status`= :status WHERE category_id = :id");
        $qry->bindParam(':status', $status);
        $qry->bindParam(':id', $user_id);
        return $qry->execute();

    }

    protected function totalCategory()
    {
        return $this->categoryQuery()->rowCount();
    }

    protected function allCategoryData()
    {
        return $this->categoryQuery()->fetchAll();
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