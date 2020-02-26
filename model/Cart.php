<?php
include_once 'Dbh.php';

class Cart extends Dbh
{
    protected function getCartItems($tem_id)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `cart` WHERE `temp_code` = :s");
        $qry->bindParam(':s', $tem_id);
        $qry->execute();
        return $qry;

    }
    protected function getAllCartItems()
    {
        $qry = $this->connect()->prepare("SELECT * FROM `cart`");
        $qry->execute();
        return $qry;
    }

    public function countElement($check, $condition)
    {
        $qry = $this->connect()->prepare("SELECT * FROM `cart` Where $check = :cond");
        $qry->bindParam(':cond', $condition);
        $qry->execute();
        return $qry;
    }

    /*INSERT INTO `cart`(`id`, `product_id`, `product_name`, `qyt`, `unit`, `price`, `status`, `temp_code`) */
    protected function setCart($product_id, $product_name, $qyt, $unit, $price, $status, $temp_code)
    {

        if (!$this->isItemExist($product_id, $temp_code)) {
            $qry = $this->connect()->prepare("INSERT INTO `cart`(`product_id` ,`product_name`, `qyt`, `unit`,`price`, `status`, `temp_code`) VALUES (:p_i,:p_n,:q,:u,:p,:s,:t)");
            $qry->bindParam(':p_i', $product_id);
            $qry->bindParam(':p_n', $product_name);
            $qry->bindParam(':q', $qyt);
            $qry->bindParam(':u', $unit);
            $qry->bindParam(':p', $price);
            $qry->bindParam(':s', $status);
            $qry->bindParam(':t', $temp_code);
            return $qry->execute();
        } else {
            $qry = $this->connect()->prepare("UPDATE `cart` SET `product_name`=:p_n,`qyt`=:q,`unit`=:u,`price`=:p,`status`=:s WHERE `temp_code`=:t AND `product_id`=:p_i");
            $qry->bindParam(':p_i', $product_id);
            $qry->bindParam(':p_n', $product_name);
            $qry->bindParam(':q', $qyt);
            $qry->bindParam(':u', $unit);
            $qry->bindParam(':p', $price);
            $qry->bindParam(':s', $status);
            $qry->bindParam(':t', $temp_code);
            return $qry->execute();
        }
    }
    protected function deleteCartItem($pro_id, $temp)
    {
        $qry = $this->connect()->prepare("DELETE FROM `cart` WHERE `product_id` like :s AND `temp_code` like :t ");
        $qry->bindParam(':s', $pro_id);
        $qry->bindParam(':t', $temp);
        return $qry->execute();
    }

    protected function updateCart($pro_id, $temp, $price ,$qyt)
    {$qry = $this->connect()->prepare("UPDATE `cart` SET `qyt`=:q,`price`=:p WHERE `temp_code`=:t AND `product_id`=:p_i");
        $qry->bindParam(':p_i', $pro_id);

        $qry->bindParam(':q', $qyt);
        $qry->bindParam(':p', $price);

        $qry->bindParam(':t', $temp);
        return $qry->execute();
    }

    protected function deleteAll()
    {
        $qry = $this->connect()->prepare("TRUNCATE `cart`");
        return $qry->execute();
    }

    private function isItemExist($product_id, $temp_code)
    {

        $qry = $this->connect()->prepare("SELECT * FROM `cart` WHERE `product_id` like :s AND `temp_code` like :t ");
        $qry->bindParam(':s', $product_id);
        $qry->bindParam(':t', $temp_code);
        $qry->execute();
        if ($qry->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
    }

}