<?php
include_once('../controller/ProductController.php');
$product = new ProductController();
?>
<div class="row">
    <div class="col table-bordered text-center">
        <select data-size="10" class=" selectpicker" data-live-search="true">
            <option value="">Select</option>
            <?php $rs = $product->get();
            foreach ($rs as $r) {
                echo "<option value='" . $r['product_id'] . "'>" . $r['product_name'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col text-center table-bordered">
        <select class="form-control">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
            <option value="">5</option>
        </select>
    </div>
    <div class="col text-center table-bordered">
        Kg
    </div>
    <div class="col text-center table-bordered">
        <a href="#"><span class="badge-pill badge-danger">-</span></a>
    </div>
</div>