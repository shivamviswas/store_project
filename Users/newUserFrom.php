<div class="row">
    <div class="col-md-8 mx-auto d-block">
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