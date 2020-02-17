<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) ==
    realpath($_SERVER['SCRIPT_FILENAME'])) {

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

} else {

    include_once('../includes/myFunctions.php');
    include_once('../controller/BrandsController.php');

    if (isset($_POST['addNewBrand'])) {
        $name = $_POST['name'];
        $dec = $_POST['description'];
        $status = 'Active';
        if ($name == '' || $dec == '') {
            echo duplicateBack('Please Fill All Details');
        } else {
            $addNewAdmin = new BrandsController();
            if ($addNewAdmin->create($name, $dec,$status)) {
                echo location('../main_page/dashboard.php?page=../Brand/index');
            } else {
                echo duplicateBack('Duplicate Brand Item');
            }
        }
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $addNewAdmin = new BrandsController();
        if ($addNewAdmin->delete($id)) {
            echo true;
        } else {
            echo false;
        }

    }

    if (isset($_POST['reactive'])) {
        $id = $_POST['reactive'];
        $addNewAdmin = new BrandsController();
        if ($addNewAdmin->reactive($id)) {
            echo true;
        } else {
            echo false;
        }

    }

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $des = $_POST['description'];
        $id = $_POST['id'];
        $addNewAdmin = new BrandsController();

        if ($addNewAdmin->update($id,$name,$des)) {
            echo location('../main_page/dashboard.php?page=../Brand/index');
        } else {
            echo duplicateBack('There are something went wrong');
        }
    }

    if (isset($_POST['getDataForUpdate'])) {
        $id = $_POST['getDataForUpdate'];
        $status='Active';
        $addNewAdmin = new BrandsController();
        echo json_encode($addNewAdmin->getBrandForUpdate($id));
    }




}