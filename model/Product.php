<?php
include_once 'Dbh.php';

class Product extends Dbh
{

    protected function setProduct($name, $description, $status)
    {
        if (!$this->isProductExist($name)) {
            $qry = $this->connect()->prepare("INSERT INTO `brand`(`brand_name`, `brand_des`, `brand_status`) VALUES (:n,:d,:s)");
            $qry->bindParam(':n', $name);
            $qry->bindParam(':d', $description);
            $qry->bindParam(':s', $status);
            return $qry->execute();
        } else {
            return false;
        }
    }


    protected function getAllProducts()
    {
    $qry = $this->connect()->prepare("SELECT * FROM `brand`");
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `Products` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }

    protected function updateProductStatus($id, $status)
    {

        $qry = $this->connect()->prepare("UPDATE `brand` SET `brand_status`= :status WHERE brand_id = :id");
        $qry->bindParam(':status', $status);
        $qry->bindParam(':id', $id);
        return $qry->execute();

    }
    protected function updateProduct($id, $name, $des)
    {

        $status='Active';
        $qry = $this->connect()->prepare("UPDATE `Products` SET `Products_name`= :n,`Products_des`= :m WHERE Products_id = :i AND Products_status = :s");
        $qry->bindParam(':n', $name);
        $qry->bindParam(':m', $des);
        $qry->bindParam(':i', $id);
        $qry->bindParam(':s', $status);
        return $qry->execute();
    }


    private function isProductExist($name)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `Products` WHERE `Products_name` = :n ");
        $qry->bindParam(':n', $name);
        $qry->execute();
        if ($qry->rowCount()===1) {
            return true;
        } else {
            return false;
        }
    }


}