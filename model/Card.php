<?php
include_once 'Dbh.php';

class Card extends Dbh
{
    /*INSERT INTO `cart`(`id`, `order_id`, `product_name`, `qyt`, `price`, `amount`) */
    public function create($user_code,$user_name,$balance,$no_item,$order_id,$total_base,$type){

        $qry = $this->connect()->prepare("INSERT INTO `card_balance`( `user_code`, `user_name`, `balance`, `no_item`, `order_id`, `total_amount`,`type`) 
                                                                    VALUES (:u_c,:u_n,:b,:n_i,:o_i,:t_a,:t)");
        $qry->bindValue(':u_c', $user_code,PDO::PARAM_INT);
        $qry->bindParam(':u_n', $user_name);
        $qry->bindValue(':b', $balance,PDO::PARAM_INT);
        $qry->bindValue(':n_i', $no_item,PDO::PARAM_INT);
        $qry->bindValue(':o_i', $order_id,PDO::PARAM_INT);
        $qry->bindValue(':t_a', $total_base,PDO::PARAM_INT);
        $qry->bindValue(':t', $type,PDO::PARAM_INT);
        return $qry->execute();
    }
    protected function getItem($order_id){
        $qry = $this->connect()->prepare("SELECT * FROM `cart` WHERE order_id = :o_i ");
        $qry->bindValue(':o_i', $order_id,PDO::PARAM_INT);
        $qry->execute();
        return $qry;
    }

}