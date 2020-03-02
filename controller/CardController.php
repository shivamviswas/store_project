<?php

include_once '../model/Card.php';
include_once '../controller/ProductController.php';
include_once '../controller/UserController.php';

class CardController extends Card
{
    private $product;
    private $user;

    public function __construct()
    {
        $this->product = new ProductController();
        $this->user = new UserController();
    }

    public function getCardItemById($order_id)
    {
        return $this->getItem($order_id);
    }

    public function setCardBalance($user_code,$user_name,$no_item,$itemArray,$user_mobile,$order_id,$type)
    {
        $total_base = 0;

        for ($x = 0; $x < count($itemArray); $x++) {
            $r = $this->product->countElement('product_id', $itemArray[$x]['code'])->fetch();
            $total_base += ($r['product_mrp']*$itemArray[$x]['qyt'])-($r['product_base_price']*$itemArray[$x]['qyt']) ;
        }

        $balance=(50*$total_base/100);
        /*INSERT INTO `card_balance`( `user_code`, `user_name`, `balance`, `no_item`, `order_id`, `total_amount`)*/
       if ( $this->create($user_code,$user_name,$balance,$no_item,$order_id,$total_base,$type))
       {
        $this->user->updateBalance($user_code,$balance);
       }
    }
}