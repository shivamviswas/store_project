<?php
include_once('../controller/UserController.php');
$users = new UserController();
?>
<nav aria-label="breadcrumb">
    <input type="hidden" id="userPage" value="6">
    <ol class="breadcrumb secondary-color">
        <li class="breadcrumb-item"><a href="http://localhost/store_project/main_page/dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Users Card</li>
    </ol>
</nav>

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
                        <h3 class="card-title"><?= $users->userCount() ?>

                        </h3>
                    </div>
                    <div class="card-footer">
                        <a href="#" onclick="addNewUser();" id="addNewUser">
                            <div class="stats">
                                <i class="material-icons">supervisor_account</i> Add New
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
                        <p class="card-category">Total Sales</p>
                        <h3 class="card-title">101,222</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">monetization_on</i> Sell Now
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" >
                <div class="card card-stats" >
                    <div   class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Inactive Users</p>
                        <h3 class="card-title"  id="inactive" ><?= $rs = $users->inUserCount('status','Inactive')->rowCount();
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
                            <i class="material-icons">credit_card</i>
                        </div>
                        <p class="card-category">User Card Value</p>
                        <h3 class="card-title">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Check
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
                        <h4 class="card-title">All Users Table</h4>
                        <p class="card-category">All users (customers) are in this table.</p>
                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-bordered dataTable" id="dataTable">
                            <thead class="text-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                            </thead>

                            <tbody>
                            <?php $rs = $users->fetchAll();
                            foreach ($rs as $r):
                                $id = $r['user_id'];
                                if ($r['status'] === 'Active') {
                                    $sat = "<span class=\"badge badge-success\">Active</span>";
                                    $btn = "<a href='#' onclick='deleteUserModal($id)' class='btn-sm btn btn-danger'> Delete </a>";
                                } else {
                                    $sat = "<span class=\"badge badge-danger\">Inactive</span>";
                                    $btn = "<a href='#' onclick='reactiveUserModal($id)' class='btn-sm btn btn-success'> Reactive </a>";
                                }
                                ?>
                                <tr>
                                <td class="text-center" id="td"><?= htmlspecialchars($r['user_id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($r['name']) ?></td>
                                <td class="text-center"> <?= htmlspecialchars($r['mobile']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($r['code']) ?></td>
                                <td class="text-center"><?= $sat ?></td>
                                    <td class="text-center"><a href="#"
                                                               onclick="editUserModal(<?= htmlspecialchars($r['user_id']) ?>)"
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


<!-- Modal -->
<div id="editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Add User</h4>
                        <p class="card-category">Please Fill All Details</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="../Users/userApi.php" enctype="multipart/form-data">

                            <div class="">
                                <div class="row ">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="">Code</label>
                                            <input type="text" id="code" readonly class="form-control" name="code">
                                            <input type="hidden" value="0" id="user_id" name="user_id">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" required value="0" id="name" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto d-block">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Mobile</label>
                                            <input type="number" value="0" id="mobile" required class="form-control" name="mobile">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="update" class="btn btn-warning pull-right">Submit</button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- Modal -->
<div id="addUser" class="modal fade" role="dialog">
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
                        <form method="post" action="../Users/userApi.php" enctype="multipart/form-data">

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
                            <button type="submit" name="addNewUser" class="btn btn-warning pull-right">Submit</button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>