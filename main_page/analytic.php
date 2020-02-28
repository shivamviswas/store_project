<?php
include_once('../controller/ProductController.php');
include_once('../controller/CartController.php');
include_once('../controller/CartController.php');
include_once('../includes/myFunctions.php');
$product = new ProductController();
$cart = new CartController();


?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <p class="card-category">Users</p>
                        <h3 class="card-title">49/50

                        </h3>
                    </div>
                    <div class="card-footer">
                        <a href="dashboard.php?page=../Users/index">
                            <div class="stats">
                                <i class="material-icons">supervisor_account</i> View
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-inr"></i>
                        </div>
                        <p class="card-category">Total Revenue</p>
                        <h3 class="card-title">101,222</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">monetization_on</i> View
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Low qyt products</p>
                        <h3 class="card-title"><?= $product->lowQytProducts(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <a href="dashboard.php?page=../Product/index">
                        <div class="stats">
                            <i class="material-icons">info_outline</i> View
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">art_track</i>
                        </div>
                        <p class="card-category">All Products</p>
                        <h3 class="card-title"><?= $product->productCount(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <a href="dashboard.php?page=../Product/index">
                        <div class="stats">
                            <i class="material-icons">update</i> View
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header row card-header-info">

                        <div class="col-2">
                            <h4 class="card-title">Order</h4>
                            <p class="card-category">Please Fill All Details</p>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-10">
                            <form id="cart_user">
                                <div class="row ">
                                    <div class="col">
                                        <div class="form-group">

                                            <label for="auto" class="bmd-label">Code</label>
                                            <input type="text" id="auto" required placeholder="" value="" class=" bg-white form-control code auto" name="code">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="username" class="bmd-label">Name</label>
                                            <input type="text" disabled id="username" placeholder="" required class=" bg-white form-control "
                                                   name="name">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="usermobile" class="bmd-label">Mobile </label>
                                            <input type="number" disabled placeholder="" id="usermobile" required
                                                   class="form-control bg-white "
                                                   name="mobile">
                                            <input type="hidden" disabled id="userid" name="user_id">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="balance" class="bmd-label">Card Balance</label>
                                            <input type="number"  disabled placeholder="" id="balance" required
                                                   class="form-control bg-white"
                                                   name="balance" value="0">
                                        </div>
                                    </div>


                                    <div class="col-2">
                                        <div align="right" class="form-group">
                                            <a  href='#' onclick='' class='btn  btn-sm btn-danger'
                                                id='addNewBrand'>Add New User</a>
                                        </div>
                                    </div>
                                </div></form>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="row">
                            <div class="col-8">
                                <div class="col-12">
                                    <form class="form-horizontal" id="product_add_table">
                                        <table class=" table-shopping  table-bordered">
                                            <thead>
                                            <th width="20%">Product Code</th>
                                            <th>Name</th>
                                            <th width="12%">Price</th>
                                            <th width="12%" >Qyt</th>
                                            <th width="12%">Amount</th>
                                            <th width="12%">Btn</th>
                                            </thead>
                                            <tbody>
                                            <tr>

                                                <td><input type="text" class="form-control" placeholder="Code"
                                                           id="pro_code" name="pro_code"/></td>
                                                <td><input type="text" class="form-control" placeholder="Name" disabled
                                                           id="pro_name" name="pro_name"/></td>
                                                <td><input type="text" class="form-control" placeholder="Price" disabled
                                                           id="pro_price" name="pro_price"/></td>
                                                <td><input type="number" class="form-control" placeholder="Qyt"
                                                           id="pro_qyt" name="pro_qyt"/></td>
                                                <td><input type="text" class="form-control" placeholder="Amount"
                                                           id="pro_amount" name="pro_amount"/></td>
                                                <td><a href='#' onclick='' class='btn btn-sm btn-success'
                                                       id='addProductItem'>Add</a></td>


                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <br>

                                <div class="col-12">
                                    <form class="form-horizontal" id="product_add_table">
                                        <table class="table table-shopping table-bordered table-hover" id="itemTable">
                                            <thead>
                                            <th width="10%">P.Code</th>
                                            <th width="60%">Name</th>
                                            <th width="10%">Price</th>
                                            <th width="10%">Qyt</th>
                                            <th width="10%">Amount</th>
                                            <th width="10%">Delete</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="col-4">
                                <div id="page">
                                    <table id="cart" class=" table table-responsive table-bordered cart">

                                        <tr>
                                            <td class="light text-right">Sub Total</td>
                                            <td class="text-right">
                                                <span id="sub_v"> </span> <input type="hidden" id="sub" value="0"/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="light text-right">Discount</td>
                                            <td class="text-right"><span id="dis_v"></span><input type="hidden" id="dis" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="light text-right">Taxes</td>
                                            <td class="text-right"><span id="tax_v"></span><input type="hidden" id="tax" value="">
                                            </td>
                                        </tr>

                                        <tr class="totalprice">
                                            <td class="light text-right">Total Payable:</td>

                                            <td class="text-right"><span class="thick" id="net_total_v"></span>
                                                <input type="hidden" id="net_total" value="0"></td>
                                        </tr>

                                        <!-- checkout btn -->
                                        <tr class="checkoutrow">
                                            <td class="checkout">
                                                <button class=" btn btn-sm btn-danger" onclick="mReset()">
                                                    Reset
                                                </button>
                                            </td>
                                            <td class="checkout">
                                                <button onclick="checkOut()" class="btn float-right  btn-success">
                                                    Checkout Now!
                                                </button>
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Daily Sales</h4>
                        <p class="card-category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today
                            sales.</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-warning">
                        <div class="ct-chart" id="websiteViewsChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Email Subscriptions</h4>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-danger">
                        <div class="ct-chart" id="completedTasksChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Completed Tasks</h4>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addBrand" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content card">

            <div class="card-header card-header-warning">
                <h4 class="card-title">Add User</h4>
                <p class="card-category">Please Fill All Details</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">
                <div class="">

                    <div class="card-body">
                        <form id="userFormDash">

                            <div class="">
                                <div class="row ">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Code</label>
                                            <input type="text" required class="form-control" name="code">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" required class="form-control" name="name">
                                            <input type="hidden" required class="form-control" name="addUserFromDash">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Mobile</label>
                                            <input type="number" required class="form-control" name="mobile">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="">Join Date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </form>
                        <button type="button" name="addNewUser" onclick="addUserFromDash()" class="btn btn-warning pull-right">Submit</button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>