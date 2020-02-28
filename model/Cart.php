<?php
include_once 'Dbh.php';

class Cart extends Dbh
{
    /*INSERT INTO `cart`(`id`, `order_id`, `product_name`, `qyt`, `price`, `amount`) */
    public function create($order_id,$product_name,$qyt,$price,$amount,$pro_code){

        $qry = $this->connect()->prepare("INSERT INTO `cart`(`order_id`,`pro_code`, `product_name`, `qyt`, `price`, `amount`) VALUES (:o_i,:p_c,:p_n,:q,:p,:a)");
        $qry->bindValue(':q', $qyt,PDO::PARAM_INT);
        $qry->bindParam(':p_n', $product_name);
        $qry->bindValue(':p', $price,PDO::PARAM_INT);
        $qry->bindValue(':a', $amount,PDO::PARAM_INT);
        $qry->bindValue(':o_i', $order_id,PDO::PARAM_INT);
        $qry->bindValue(':p_c', $pro_code,PDO::PARAM_INT);
        $qry->execute();
    }
    protected function getItem($order_id){
        $qry = $this->connect()->prepare("SELECT * FROM `cart` WHERE order_id = :o_i ");
        $qry->bindValue(':o_i', $order_id,PDO::PARAM_INT);
        $qry->execute();
        return $qry;
    }

}