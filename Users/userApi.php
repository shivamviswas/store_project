<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) ==
    realpath($_SERVER['SCRIPT_FILENAME']))
{

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

}
else
    {

    include_once('../includes/myFunctions.php');
    include_once('../controller/UserController.php');

    if (isset($_POST['addNewUser'])) {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $date = $_POST['date'];
        $code = $_POST['code'];
        $status = 'Active';
        if ($name == '' || $mobile == '' || $code == '' || $date == '' || $name == '') {
            echo alert('Please Fill All Details');
        } else {
            $addNewAdmin = new UserController();
            if ($addNewAdmin->createUser($name, $mobile, $code, $date, $status)) {
                echo location('../main_page/dashboard.php?page=../Users/index');
            } else {
                echo duplicateBack('Failed or Duplicate Mobile Number');
            }
        }
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $status = 'Inactive';
        $addNewAdmin = new UserController();
        if ($addNewAdmin->deleteUser($id, $status)) {
            echo true;
        } else {
            echo false;
        }

    }

    if (isset($_POST['reactive'])) {
        $id = $_POST['reactive'];
        $status = 'Active';
        $addNewAdmin = new UserController();
        if ($addNewAdmin->deleteUser($id, $status)) {
            echo true;
        } else {
            echo false;
        }

    }


    if (isset($_POST['getUpdate'])) {
        $id = $_POST['getUpdate'];
        $status = 'Active';
        $addNewAdmin = new UserController();
        echo json_encode($addNewAdmin->getUserFor($id));
    }

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $code = $_POST['code'];
        $id = $_POST['user_id'];
        $addNewAdmin = new UserController();

        $addNewAdmin = new UserController();
        if ($addNewAdmin->editUser($id, $name, $code, $mobile)) {
            echo location('../main_page/dashboard.php?page=../Users/index');
        } else {
            echo duplicateBack('There are something went wrong');
        }
    }

    if (isset($_POST['getUser'])) {
        $name = $_POST['getUser'];
        $addNewAdmin = new UserController();
        $r = $addNewAdmin->getUserForId($name);
         if ($r->rowCount() > 0) {
            $r->fetch(PDO::FETCH_OBJ);
            $result = array();
            foreach ($r as $row) {

                $response = array("value" => $row['mobile'], "code" => $row['code'],
                    "label" => $row['name'],
                    "id" => $row['user_id'],);
                array_push($result, $response);
            }
           echo json_encode($result);
        }
        else{
            echo 'failed'; /*http_response_code(500);*/
        }
    }


}