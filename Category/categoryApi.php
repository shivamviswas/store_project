<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

}
else {

    include_once('../includes/myFunctions.php');
    include_once('../controller/CategoryController.php');

    if (isset($_POST['addNewCategory'])) {
        $name = $_POST['name'];
        $dec = $_POST['description'];
        $status = 'Active';
        if ($name == '' || $dec == '' || $name == '') {
            echo alert('Please Fill All Details');
        } else {
                $addNewAdmin = new CategoryController();
                if ($addNewAdmin->createCategory($name, $dec,$status)) {
                    echo location('../main_page/dashboard.php?page=../Category/index');
                } else {
                    echo duplicateBack('Duplicate Category Item');
                }
        }
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $status='Inactive';
             $addNewAdmin = new CategoryController();
                if ($addNewAdmin->deleteCategory($id,$status)) {
                    echo true;
                } else {
                   echo false;
                }

    }

    if (isset($_POST['reactive'])) {
        $id = $_POST['reactive'];
        $status='Active';
             $addNewAdmin = new CategoryController();
                if ($addNewAdmin->deleteCategory($id,$status)) {
                    echo true;
                } else {
                   echo false;
                }

    }


    if (isset($_POST['getUpdate'])) {
        $id = $_POST['getUpdate'];
        $status='Active';
        $addNewAdmin = new CategoryController();
       echo json_encode($addNewAdmin->getCategoryFor($id));
    }

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $des = $_POST['description'];
        $id = $_POST['id'];
        $addNewAdmin = new CategoryController();

                if ($addNewAdmin->editCategory($id,$name,$des)) {
                    echo location('../main_page/dashboard.php?page=../Category/index');
                } else {
                    echo duplicateBack('There are something went wrong');
                }
    }


}