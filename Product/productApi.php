<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{

    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    die('' . header('location:../404.php'));

} else
    {

    include_once('../includes/myFunctions.php');
    include_once('../controller/ProductController.php');

    if(isset($_POST['addNewProduct'])){
        $name=$_POST['name'];
        $des=$_POST['des'];
        $cate_id=$_POST['cate'];
        $brand=$_POST['brand'];
        $location=$_POST['location'];
        $base=$_POST['base_price'];
        $unit=$_POST['unit'];
        $qyt=$_POST['qyt'];
        $mrp=$_POST['mrp'];
        $status='Active';

        if ($name == '' || $des == ''|| $mrp == ''|| $base == ''|| $qyt == '') {
            echo duplicateBack('Please Fill All Details');
        } else {
            $addNewAdmin = new ProductController();
            if ($addNewAdmin->create($name, $des, $cate_id, $brand, $mrp, $base, $qyt, $unit, $location, $status)) {
                echo location('../main_page/dashboard.php?page=../Product/index');
            } else {
                echo duplicateBack('Duplicate Brand Item');
            }
        }
    }
    if(isset($_POST['update'])){
        $name=$_POST['name'];
        $des=$_POST['des'];
        $cate_id=$_POST['cate'];
        $brand=$_POST['brand'];
        $location=$_POST['location'];
        $base=$_POST['base_price'];
        $unit=$_POST['unit'];
        $qyt=$_POST['qyt'];
        $mrp=$_POST['mrp'];
        $id=$_POST['id'];
        $status='Active';

        if ($name == '' || $des == ''|| $mrp == ''|| $base == ''|| $qyt == '') {
            echo duplicateBack('Please Fill All Details');
        } else {
            $addNewAdmin = new ProductController();
            if ($addNewAdmin-> update($id, $name, $des, $cate_id, $brand, $mrp, $base, $qyt, $unit, $location)) {
                echo location('../main_page/dashboard.php?page=../Product/index');
            } else {
                echo duplicateBack('Duplicate Brand Item');
            }
        }
    }
    if(isset($_POST['delete'])){
        $id=$_POST['delete'];
        $n= new ProductController();
        if($n->delete($id)){
            echo 'ok';
        } else {
            echo http_response_code(500);;
        }

    }

    if(isset($_POST['reactive'])){
        $id=$_POST['reactive'];
        $n= new ProductController();
        if($n->reactive($id)){
            echo 'ok';
        } else {
            echo http_response_code(500);;
        }

    }

    if(isset($_POST['get_product'])){
        $n= new ProductController();
        $rs = $n->get();
        foreach ($rs as $r) {
            if($r['product_qyt']>0 )
           {
               echo "<option value='" . $r['product_id'] . "'>" . $r['product_name'] . "</option>";
           }
        }

    }
    if(isset($_POST['get_product_product'])){
        $id=$_POST['get_product_product'];
        $n= new ProductController();
        $rs = $n->countElement('product_id',$id)->fetch(PDO::FETCH_ASSOC);
        echo json_encode($rs);
    }

    if(isset($_POST['getDataForUpdate'])){
        $id=$_POST['getDataForUpdate'];
        $n= new ProductController();
        echo json_encode($n->getProductForUpdate($id));

    }

    if (isset($_POST['getproduct'])) {
            $name = $_POST['getproduct'];
            $addNewAdmin = new ProductController();
            $r = $addNewAdmin->getPrductCart($name);

            echo json_encode($r);

        }


}