<?php
include_once('../controller/BrandsController.php');
include_once('../controller/CategoryController.php');
include_once('../controller/ProductController.php');
include_once('../controller/OrderController.php');
$cate= new CategoryController();
$users = new BrandsController();
$product = new ProductController();
$order= new OrderController();
?>
<nav aria-label="breadcrumb">
    <input type="hidden" id="userPage" value="5">
    <ol class="breadcrumb secondary-color">
        <li class="breadcrumb-item"><a href="http://localhost/store_project/main_page/dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Orders</li>
    </ol>
</nav>

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">art_track</i>
                        </div>
                        <p class="card-category">Products</p>
                        <h3 class="card-title"><?= $product->productCount(); ?>

                        </h3>
                    </div>
                    <div class="card-footer">
                        <a href="#" id="addNewBrand">
                            <div class="stats">
                                <i class="material-icons">art_track</i> Add New
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <p class="card-category">Categories</p>
                        <h3 class="card-title"><?= $cate->categoryCount(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <a href="../main_page/dashboard.php?page=../Category/index">  <div class="stats">
                                <i class="material-icons">library_books</i> View
                            </div></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" >
                <div class="card card-stats" >
                    <div   class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Inactive</p>
                        <h3 class="card-title"  id="inactive" ><?= $rs = $product->inactiveProducts('product_status','Inactive')->rowCount();
                            ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">info_outline</i> Reactive
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <p class="card-category">Brands</p>
                        <h3 class="card-title"><?= $users->brandCount()?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">content_paste</i> Check
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">All Orders Table</h4>
                        <p class="card-category">All Orders are in this table.</p>
                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-bordered dataTable" id="dataTable">
                            <thead class="text-primary">
                            <th class="text-center">Order Id</th>
                            <th class="text-center">User Name</th>
                            <th class="text-center">No Of Item</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Pay Method</th>
                            <th class="text-center">Pay Status</th>
                            <th class="text-center">Timestamp</th>
                            <th class="text-center"><i class="fa fa-search" aria-hidden="true"></i></th>

                            <th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
                            </thead>

                      <tbody>
                      <? $rs=$order->getOrders();
                      foreach ($rs as $r){
                          /*`no_item`, `user_name`, `user_code`, `user_mobile`, `discount`, `total_amount`,
                          `payment_method`,`order_id`, `status`*/
                          $or=$r['order_id'];
                          echo '<tr>
                            <td>'.$r['order_id'].'</td>
                            <td>'.$r['user_name'].'</td>
                            <td>'.$r['no_item'].'</td>
                            <td>'.$r['total_amount'].'</td>
                            <td>'.$r['payment_method'].'</td>
                            <td><span class="badge badge-success">'.$r['status'].'</span></td>
                            <td>'.$r['dateTime'].'</td>'."
                            <td><a class='btn btn-sm btn-info' title='view' href='#' onclick='viewOrder($or)' ><i class=\"fa fa-search\" aria-hidden=\"true\"></a></td>
                       
                            <td><a class='btn btn-sm btn-danger' title='view' href='#' onclick='deleteOrder($or)' ><i class=\"fa fa-trash\" aria-hidden=\"true\"></a></td>
                           
                            </tr>";


                      }


                      ?>
                      </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal edit Modal-->

<div id="" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">

        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="mViewOrder" class="col-md-12">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add Modal-->
<div id="addBrand" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content card">
            <div class="card-header card-header-info">
                <h4 class="card-title">Add Product</h4>
                <p class="card-category">Please Fill All Details</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="">

                    <div class="card-body">
                        <form method="post" action="../Product/productApi.php" enctype="multipart/form-data">
                            <div class="">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cate" class="bmd-label-floating">Category</label>
                                            <Select id="cate" required class="form-control" name="cate">
                                                <option value="">Select</option>
                                                <? $rs=$cate -> fetchAll();
                                                foreach ($rs as $r){
                                                    echo "<option value='".$r['category_name']."'>".$r['category_name']."</option>";
                                                }
                                                ?>


                                            </Select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="brand" class="bmd-label-floating">Brand</label>
                                            <Select id="brand" required class="form-control" name="brand">
                                                <option value="">Select</option>
                                                <? $rs=$users -> get();
                                                foreach ($rs as $r){
                                                    echo "<option value='".$r['brand_name']."'>".$r['brand_name']."</option>";
                                                }
                                                ?>
                                            </Select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label for='name' class="bmd-label-floating">Product Name</label>
                                            <input type="text"  id="name" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label for="des" class="bmd-label-floating">Description</label>
                                            <input type="text" id="des" class="form-control" name="des">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Unit</label>
                                            <input type="text" id="unit" class="form-control" name="unit">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Quantity</label>
                                            <input type="number" id="qyt" class="form-control" name="qyt">
                                        </div>
                                    </div><div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Base Price</label>
                                            <input type="number" id="des" class="form-control" name="base_price">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">MRP</label>
                                            <input type="number" id="des" class="form-control" name="mrp">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Location</label>
                                            <input type="text" id="des" class="form-control" name="location">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="addNewProduct" class="btn btn-info pull-right">Add</button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
