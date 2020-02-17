<?php
include_once 'Dbh.php';

class Brands extends Dbh
{

    protected function setBrand($name, $description, $status)
    {
        if (!$this->isBrandExist($name)) {
            $qry = $this->connect()->prepare("INSERT INTO `brand`(`brand_name`, `brand_des`, `brand_status`) VALUES (:n,:d,:s)");
            $qry->bindParam(':n', $name);
            $qry->bindParam(':d', $description);
            $qry->bindParam(':s', $status);
            return $qry->execute();
        } else {
            return false;
        }
    }


    protected function getAllBrands()
    {
    $qry = $this->connect()->prepare("SELECT * FROM `brand`");
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `brand` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }

    protected function updateBrandStatus($id, $status)
    {

        $qry = $this->connect()->prepare("UPDATE `brand` SET `brand_status`= :status WHERE brand_id = :id");
        $qry->bindParam(':status', $status);
        $qry->bindParam(':id', $id);
        return $qry->execute();

    }
    protected function updateBrand($id, $name, $des)
    {

        $status='Active';
        $qry = $this->connect()->prepare("UPDATE `brand` SET `brand_name`= :n,`brand_des`= :m WHERE brand_id = :i AND brand_status = :s");
        $qry->bindParam(':n', $name);
        $qry->bindParam(':m', $des);
        $qry->bindParam(':i', $id);
        $qry->bindParam(':s', $status);
        return $qry->execute();
    }
    

    private function isBrandExist($name)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `brand` WHERE `brand_name` = :n ");
        $qry->bindParam(':n', $name);
        $qry->execute();
        if ($qry->rowCount()===1) {
            return true;
        } else {
            return false;
        }
    }


}