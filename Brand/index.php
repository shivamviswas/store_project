<?php
include_once('../controller/BrandsController.php');
include_once('../controller/CategoryController.php');
$cate= new CategoryController();
$users = new BrandsController();
?>
<nav aria-label="breadcrumb">
    <input type="hidden" id="userPage" value="2">
    <ol class="breadcrumb secondary-color">
        <li class="breadcrumb-item"><a href="http://localhost/store_project/main_page/dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Brands</li>
    </ol>
</nav>

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <p class="card-category">Brands</p>
                        <h3 class="card-title"><?= $users->brandCount(); ?>

                        </h3>
                    </div>
                    <div class="card-footer">
                        <a href="#" id="addNewBrand">
                            <div class="stats">
                                <i class="material-icons">content_paste</i> Add New
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
                        <h3 class="card-title"  id="inactive" ><?= $rs = $users->inBrandCount('brand_status','Inactive')->rowCount();
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
                            <i class="material-icons">art_track</i>
                        </div>
                        <p class="card-category">Products</p>
                        <h3 class="card-title">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">art_track</i> Check
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span id="addNewHtml">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">All Brands Table</h4>
                        <p class="card-category">All brands are in this table.</p>
                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-bordered dataTable" id="dataTable">
                            <thead class="text-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Brand Name</th>
                            <th class="text-center">Brand Description</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                            </thead>

                            <tbody>
                            <?php $rs = $users->get();
                            foreach ($rs as $r):
                                $id = $r['brand_id'];
                                if ($r['brand_status'] === 'Active') {
                                    $sat = "<span class=\"badge badge-success\">Active</span>";
                                    $btn = "<a href='#' onclick='deleteBrandModal($id)' class='btn-sm btn btn-danger'> Delete </a>";
                                } else {
                                    $sat = "<span class=\"badge badge-danger\">Inactive</span>";
                                    $btn = "<a href='#' onclick='reactiveBrandModal($id)' class='btn-sm btn btn-success'> Reactive </a>";
                                }
                                ?>
                                <tr>
                                <td class="text-center" id="td"><?= htmlspecialchars($r['brand_id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($r['brand_name']) ?></td>
                                <td class="text-center"> <?= htmlspecialchars($r['brand_des']) ?></td>

                                <td class="text-center"><?= $sat ?></td>
                                    <td class="text-center"><a href="#"
                                                               onclick="editBrandModal(<?= htmlspecialchars($r['brand_id']) ?>)"
                                                               id="" class="btn-sm btn btn-warning"> Edit </a></td>
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
            </span>
    </div>
</div>


<!-- Modal edit Modal-->
<div id="editBrand" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Edit Brand</h4>
                <p class="card-category">Please Fill All Details</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>



            <div class="modal-body">
                <div class="">

                    <div class="card-body">
                        <form method="post" action="../Brand/brandApi.php" enctype="multipart/form-data">

                            <div class="">
                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" id="name" value="0" required class="form-control" name="name">
                                            <input type="hidden" id="id"  name="id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Description</label>
                                            <input type="text" id="des" value="0" required class="form-control" name="description">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="update" class="btn btn-success pull-right">Update</button>

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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Edit Brand</h4>
                <p class="card-category">Please Fill All Details</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="">

                    <div class="card-body">
                        <form method="post" action="../Brand/brandApi.php" enctype="multipart/form-data">

                            <div class="">
                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" id="name" required class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Description</label>
                                            <input type="text" id="des" class="form-control" name="description">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="addNewBrand" class="btn btn-warning pull-right">Add</button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>