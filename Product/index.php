<?php
include_once('../controller/BrandsController.php');
include_once('../controller/CategoryController.php');
include_once('../controller/ProductController.php');
$cate= new CategoryController();
$users = new BrandsController();
$product = new ProductController();
?>
<nav aria-label="breadcrumb">
    <input type="hidden" id="userPage" value="4">
    <ol class="breadcrumb secondary-color">
        <li class="breadcrumb-item"><a href="http://localhost/store_project/main_page/dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Products</li>
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
                        <h4 class="card-title">All Product Table</h4>
                        <p class="card-category">All products are in this table.</p>
                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-bordered dataTable" id="dataTable">
                            <thead class="text-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Qyt</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">MRP</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Status</th>
                            <th class="text-center"><i class="fa fa-wrench" aria-hidden="true"></i></th>
                            <th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
                            </thead>

                            <tbody>
                            <?php $rs = $product->get();

                            /*<!--INSERT INTO `product`(`product_id`, `category_id`, `brnad_id`, `product_name`, `product_description`,
                            `product_unit`, `product_qyt`, `product_base_price`, `product_tax`,
                           `product_mrp`, `product_mini_order`, `product_enter_by`, `product_status`, `date`)-->*/
                            foreach ($rs as $r):

                                $id = $r['product_id'];
                                if ($r['product_status'] === 'Active') {
                                    $sat = "<span class=\"badge badge-success\">Active</span>";
                                    $btn = "<a href='#' title='delete' onclick='deleteProductModal($id)' class='btn-sm btn btn-danger'> <i class=\"fa fa-trash\" aria-hidden=\"true\"></i> </a>";
                                } else {
                                    $sat = "<span class=\"badge badge-danger\">Inactive</span>";
                                    $btn = "<a href='#' title='reactive' onclick='reactiveProductModal($id)' class='btn-sm btn btn-success'><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i> </a>";
                                }
                                ?>
                                <tr>
                                    <td class="text-center" ><?= htmlspecialchars($r['product_id']) ?></td>
                                    <td class="text-center" ><?= htmlspecialchars($r['product_name']) ?></td>
                                    <td class="text-center" ><?= htmlspecialchars($r['category_id']) ?></td>
                                    <td class="text-center" ><?= htmlspecialchars($r['brnad_id']) ?></td>
                                    <td class="text-center" ><?= htmlspecialchars($r['product_description']) ?></td>
                                    <td class="text-center" ><?= htmlspecialchars($r['product_qyt']) ?></td>
                                    <td class="text-center" ><i class="fa fa-inr"></i><?= htmlspecialchars($r['product_base_price']) ?></td>
                                    <td class="text-center" ><i class="fa fa-inr"></i><?= htmlspecialchars($r['product_mrp']) ?></td>
                                    <td class="text-center" > <?= htmlspecialchars($r['location']) ?></td>

                                    <td class="text-center"><?= $sat ?></td>
                                    <td class="text-center"><a href="#" title="edit"
                                                               onclick="editProductModal(<?= htmlspecialchars($r['product_id']) ?>)"
                                                               id="" class="btn-sm btn btn-warning"> <i class="fa fa-wrench" aria-hidden="true"> </a></td>
                                    <td class="text-center"><?= $btn ?>
                                    </td>

                                </tr>
                            <? endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal edit Modal-->
<div id="editBrand" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content card">
            <div class="card-header card-header-info">
                <h4 class="card-title">Edit Product</h4>
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
                                            <label for="cate" class="bmd-label">Category</label>
                                            <input id="cate" required class="form-control" name="cate">


                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="brand" class="bmd-label">Brand</label>
                                            <input id="brand" required class="form-control" name="brand">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label for='name' class="bmd-label-floating">Product Name</label>
                                            <input type="text" value="0" id="name" class="form-control" name="name">
                                            <input type="hidden" id="id" name="id">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label for="des" class="bmd-label-floating">Description</label>
                                            <input type="text" value="0" id="des" class="form-control" name="des">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Unit</label>
                                            <input type="text" value="0" id="unit" class="form-control" name="unit">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Quantity</label>
                                            <input type="number" value="0" id="qyt" class="form-control" name="qyt">
                                        </div>
                                    </div><div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Base Price</label>
                                            <input type="number" value="0" id="base_price" class="form-control" name="base_price">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">MRP</label>
                                            <input type="number" value="0"  id="mrp" class="form-control" name="mrp">
                                        </div>
                                    </div>
                                    <div class="col mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Location</label>
                                            <input type="text" value="0" id="location" class="form-control" name="location">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="update" class="btn btn-info pull-right">Update</button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
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