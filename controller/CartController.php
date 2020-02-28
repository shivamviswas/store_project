<?php

include_once '../model/Cart.php';
include_once '../controller/ProductController.php';

class CartController extends Cart
{
        public function getCartItemById($order_id){
                return $this->getItem($order_id);
        }
}