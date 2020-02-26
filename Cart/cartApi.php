<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) ==
    realpath($_SERVER['SCRIPT_FILENAME'])) {

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

} else {

    include_once '../controller/CartController.php';
    include_once '../includes/myFunctions.php';

    if (isset($_POST['addCart'])) {
        $pro_id = $_POST['pro_id'];
        $qyt = $_POST['qyt'];
        $temp =  $_POST['temp'];
        $unit = $_POST['unit'];
        $status= 'active';

        $cart= new CartController();
         echo  $cart ->set($pro_id,$qyt,$status,$temp);


    }

    if (isset($_POST['deleteItem'])) {

        $pro_id = $_POST['pro_id'];
        $temp =  $_POST['temp'];;
        $cart= new CartController();

      echo  $cart ->deleteItem($pro_id,$temp);


    }

    if (isset($_POST['updateCart'])) {

        $pro_id = $_POST['pro_id'];
        $qyt = $_POST['qyt'];
        $temp = $_POST['temp']; ;
        $cart= new CartController();

      echo  $cart ->update($pro_id,$temp,$qyt);


    }

    if (isset($_POST['delete'])) {


        $cart= new CartController();

         if($cart ->delete()){
             return 'success';
         }
         else{
             return 'failed';
         }


    }
}