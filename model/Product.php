<?php
include_once 'Dbh.php';

class Product extends Dbh
{

    /*<!--INSERT INTO `product`(`product_id`, `category_id`, `brnad_id`, `product_name`, `product_description`,
                            `product_unit`, `product_qyt`, `product_base_price`, `product_tax`,
                           `product_mrp`, `product_mini_order`, `product_enter_by`, `product_status`, `date`)-->*/
    protected function setProduct($name, $description, $cat_id, $brd_id, $mrp, $base_price, $qyt, $unit, $loc, $status)
    {
        if (!$this->isProductExist($name, $cat_id, $brd_id)) {
            $qry = $this->connect()->prepare("INSERT INTO `product`(`category_id`, `brnad_id`, `product_name`, `product_description`,
                                 `product_unit`, `product_qyt`, `product_base_price`, `product_mrp`,`location`,`product_status`) 
                                 VALUES (:c_i,:b_i,:n,:d,:u,:q,:b,:m,:l,:s)");
            $qry->bindParam(':c_i', $cat_id);
            $qry->bindParam(':b_i', $brd_id);
            $qry->bindParam(':n', $name);
            $qry->bindParam(':d', $description);
            $qry->bindParam(':u', $unit);
            $qry->bindParam(':q', $qyt);
            $qry->bindParam(':b', $base_price);
            $qry->bindParam(':m', $mrp);
            $qry->bindParam(':l', $loc);
            $qry->bindParam(':s', $status);
            return $qry->execute();
        } else {
            return false;
        }
    }


    protected function getAllProducts()
    {
        $qry = $this->connect()->prepare("SELECT * FROM `product`");
        $qry->execute();
        return $qry;
    }
    public function getNameId($name)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `product` WHERE `product_name` LIKE :n OR `product_id` LIKE :n OR `category_id` LIKE :n OR `brnad_id` LIKE :n AND product_status = 'Active'");
        $qry->bindValue(':n', '%' . $name . '%');
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `product` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }

    protected function updateProductStatus($id, $status)
    {

        $qry = $this->connect()->prepare("UPDATE `product` SET `product_status`= :status WHERE product_id = :id");
        $qry->bindParam(':status', $status);
        $qry->bindParam(':id', $id);
        return $qry->execute();

    }

    protected function updateProduct($id, $name, $des, $cat_id, $brd_id, $mrp, $base_price, $qyt, $unit, $loc)
    {

        $status = 'Active';
        $qry = $this->connect()->prepare("UPDATE `product` SET `category_id`= :c_i,`brnad_id`= :b_i,`product_name`= :n,`product_des`= :d,
        `product_unit`= :u,`product_qyt`= :q,`product_base_price`= :b,`product_mrp`= :m,`location`= :l WHERE product_id = :i AND product_status = :s");
        $qry->bindParam(':c_i', $cat_id);
        $qry->bindParam(':b_i', $brd_id);
        $qry->bindParam(':n', $name);
        $qry->bindParam(':d', $des);
        $qry->bindParam(':u', $unit);
        $qry->bindParam(':q', $qyt);
        $qry->bindParam(':b', $base_price);
        $qry->bindParam(':m', $mrp);
        $qry->bindParam(':l', $loc);
        $qry->bindParam(':i', $id);
        $qry->bindParam(':s', $status);
        return $qry->execute();
    }


    private function isProductExist($name, $cat, $brnd)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `product` WHERE `product_name` = :n AND brnad_id = :b AND category_id = :c");
        $qry->bindParam(':n', $name);
        $qry->bindParam(':c', $brnd);
        $qry->bindParam(':b', $cat);
        $qry->execute();
        if ($qry->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
    }


}