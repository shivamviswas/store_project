<?php

include_once '../model/Order.php';
include_once '../model/Cart.php';
include_once '../controller/ProductController.php';
include_once '../includes/myFunctions.php';
class OrderController extends Order
{
    private $cart;
    private $pro;
    public function __construct()
    {
        $this->cart = new Cart();
        $this->pro = new ProductController();
    }

    public function setOrder($user_code, $user_name, $user_mobile, $discount, $total_amount, $itemArray, $payment_method, $no_item, $status)
    {
        $str=30;
        $or_id= $str.randomCode(rand(6,6));
        if($this->create($user_code,$or_id, $user_name, $user_mobile, $discount, $total_amount, $payment_method, $no_item, $status))
        {
            for($x=0; $x<count($itemArray);$x++){
                $this->cart->create($or_id,$itemArray[$x]['name'],$itemArray[$x]['qyt'],$itemArray[$x]['price'],$itemArray[$x]['amount'],$itemArray[$x]['code']);
                $this->pro->decrementQyt($itemArray[$x]['code'],$itemArray[$x]['qyt']);
            }
           return $or_id;
       }
       else{
           return 0;
       }
    }

    public function getOrderById($orderId){
        return $this->get($orderId);
    }
    public function getOrders(){
        return $this->getALL()->fetchAll();
    }

    public function deleteOrder($id)
    {
        return $this->delete($id);
    }
}