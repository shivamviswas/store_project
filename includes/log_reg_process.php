<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

} else {

    include_once('myFunctions.php');
    include_once('Config.php');
    include_once('../controller/AdminController.php');


    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $status = 'Active';
        if ($name == '' || $mobile == '' || $password == '' || $role == '' || $name == '') {
            echo alert('Please Fill All Details');
        }
        else {
            $addNewAdmin = new AdminController();

            if ($addNewAdmin->createUser($name, $mobile, $password, $role, $status)) {
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['mobile'] = $mobile;

                echo location_replace('../main_page/dashboard.php');


            } else {

                echo duplicateBack('Failed or Duplicate Mobile Number');

            }


//            if(Admin::insertDetail($con,$name,$mobile,$password,$role,$status))
//            {
//
//                echo location_replace('../main_page/dashboard.php');
//            }
//            else{
//                echo duplicateBack('Failed or Duplicate Mobile');
//            }
        }
    }

    if (isset($_POST['login'])) {
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        if ($mobile == '' || $password == '') {
            echo alert('Please Fill All Details');
        } else {
            $addNewAdmin = new AdminController();

            if ( $addNewAdmin->checkLogin( $mobile, $password )!='0') {

               echo location_replace('../main_page/dashboard.php');

            } else {

                echo duplicateBack('invalid mobile number or password');

            }
        }

    }

    if (isset($_POST['logout'])) {
        $addNewAdmin = new AdminController();
        if ($addNewAdmin->logout()) {
            echo location_replace('../index.php');
        }
    }
}





