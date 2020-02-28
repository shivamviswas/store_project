<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die('' . header('location:../404.php'));
} else {
    include_once '../controller/OrderController.php';
    if (isset($_POST['setOrder'])) {
        $user_name = $_POST['user_name'];
        $user_mobile = $_POST['user_mobile'];
        $user_code = $_POST['user_code'];
        $discount = $_POST['discount'];
        $payment_method = $_POST['payment_method'];
        $total_amount = $_POST['total_amount'];
        $no_item = $_POST['no_item'];
        $itemArray =  $_POST['itemArray'];
        $status = 'Success';

        $order = new OrderController();
        $id=$order->setOrder($user_code, $user_name, $user_mobile, $discount, $total_amount, $itemArray, $payment_method, $no_item, $status);
         if($id>0){
            echo $id ;
         }
         else{
             echo 0;
         }

    }
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $order = new OrderController();

         if($order->deleteOrder($id)){
            echo 1;
         }
         else{
             echo 0;
         }

    }

}