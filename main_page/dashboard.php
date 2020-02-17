
<?php
session_start();
if(!isset($_SESSION['name'])&&!isset($_SESSION['mobile']))
{
    header('Location:../index.php');
}
$dash='active';
$user='';
$brand='';
$cate='';
$order='';
$sales='';
$prof='';
$pro='';
?>

<!DOCTYPE html>
<html lang="en">
<!--header-->
<?php include('header.php')?>
<body class="">

<div class="wrapper ">

<!--sidebar bar-->
    <?php include('sidebar.php')?>
<!--sidebar bar end-->

    <div class="main-panel">
        <!-- Navbar -->
        <?php include('navbar.php')?>
        <!-- End Navbar -->

        <!-- main page-->
        <div id="loading">
            Loading...
        </div>
        <?php
        $page='analytic';
        if(isset($_GET['page']))
        {
           $page= $_GET['page'];
        }
        include $page.'.php';
        ?>
        <!-- main page-->


        <!--footer-->
<!--        --><?php //include('footer.php')?>
        <!--footer-->
    </div>
</div>

<!--script-->
<?php include('footer_script.php')?>
<!--script-->

</body>

</html>
