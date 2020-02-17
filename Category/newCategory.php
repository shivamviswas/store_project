<div class="row">
    <div class="col-md-8 mx-auto d-block">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Add Category</h4>
                <p class="card-category">Please Fill All Details</p>
            </div>
            <div class="card-body">
                <form method="post" action="../Category/categoryApi.php" enctype="multipart/form-data">

                    <div class="">
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
                                        <label class="bmd-label-floating">Description</label>
                                        <input type="text" required class="form-control" name="description">
                                    </div>
                                </div>
                        </div>

                    </div>
                    <button type="submit" name="addNewCategory" class="btn btn-success pull-right">Submit</button>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>