<?php
include_once 'Dbh.php';

class Order extends Dbh
{
    protected function create($user_code,$or_id, $user_name, $user_mobile, $discount, $total_amount, $payment_method, $no_item, $status)
    {
        $qry = $this->connect()->prepare("INSERT INTO `orders`(`no_item`, `user_name`, `user_code`, `user_mobile`, `discount`, `total_amount`, `payment_method`,`order_id`, `status`)
                                            VALUES (:n_i,:u_n,:u_c,:u_m,:d,:t,:p,:o_i,:s)");
        $qry->bindParam(':n_i', $no_item);
        $qry->bindParam(':u_c', $user_code);
        $qry->bindParam(':u_n', $user_name);
        $qry->bindParam(':u_m', $user_mobile);
        $qry->bindParam(':d', $discount);
        $qry->bindParam(':p', $payment_method);
        $qry->bindParam(':t', $total_amount);
        $qry->bindParam(':s', $status);
        $qry->bindParam(':o_i', $or_id);

        if($qry->execute()){
            return true;
        }else{
            return false;
        }
    }
    protected function get($order_id){
        $qry = $this->connect()->prepare("SELECT * FROM `orders` WHERE order_id = :o_i ");
        $qry->bindParam(':o_i', $order_id);
        $qry->execute();
        if($qry->rowCount()>0){
            return $qry;
        }else{
            return 0;
        }
    }
 protected function getAll(){
        $qry = $this->connect()->prepare("SELECT * FROM `orders`");
        $qry->execute();
        if($qry->rowCount()>0){
            return $qry;
        }else{
            return 0;
        }
    }
    protected function delete($id){
        $qry = $this->connect()->prepare("DELETE FROM `orders` WHERE order_id = :o_i");
        $qry->bindParam(':o_i', $id);
        return $qry->execute();
    }
}