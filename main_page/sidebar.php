




<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

    <div class="logo">
        <a  class="simple-text logo-normal">
        <?=$_SESSION['name'];?>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="../main_page/dashboard.php">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item" id="act1">
                <a class="nav-link" href="dashboard.php?page=../Users/index">
                    <i class="material-icons">supervisor_account</i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item " id="act2">
                <a class="nav-link " href="dashboard.php?page=../Brand/index">
                    <i class="material-icons">content_paste</i>
                    <p>Brands</p>
                </a>
            </li>
            <li class="nav-item " id="act3">
                <a class="nav-link" href="dashboard.php?page=../Category/index">
                    <i class="material-icons">library_books</i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item" id="act4">
                <a class="nav-link" href="dashboard.php?page=../Product/index">
                    <i class="material-icons">art_track</i>
                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item" id="act5">
                <a class="nav-link" href="dashboard.php?page=../Orders/index">
                    <i class="material-icons">shopping_cart</i>
                    <p>Orders</p>
                </a>
            </li>
            <li class="nav-item" id="act6">
                <a class="nav-link" href="dashboard.php?page=../UsersCard/index">
                    <i class="fa fa-credit-card"></i>
                    <p>Users Card</p>
                </a>
            </li>

            <li class="nav-item" id="act7">
                <a class="nav-link" href="dashboard.php?page=../Sales/index">
                    <i class="material-icons">trending_up</i>
                    <p>Sales Report</p>
                </a>
            </li>
            <li class="nav-item" id="act8">
                <a class="nav-link" href="dashboard.php?page=../Profile/index">
                    <i class="material-icons">person</i>
                    <p>Profile Settings</p>
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="">
                    <i class="material-icons">trending_up</i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>

    </div>
</div>