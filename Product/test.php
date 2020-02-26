<?php
$rs = $product->get();
foreach ($rs as $r):
    $id = $r['product_id'];
    $cate = $r['category_id'];
    $brand = $r['brnad_id'];


    if ($r['product_status'] === 'Active') {
        $sat = "<span class=\"badge badge-success\">Active</span>";
        $btn = "<a href='#' onclick='deleteBrandModal$id)' title='delete' class='btn-sm btn btn-danger'> 
                                     <i class=\"fa fa-trash\" aria-hidden=\"true\"></i> </a>";
    } else {
        $sat = "<span class=\"badge badge-danger\">Inactive</span>";
        $btn = "<a href='#' onclick='reactiveBrandModal($id)' title='reactive' class='btn-sm btn btn-success'> 
                                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> </a>";
    }
    ?>

    <tr>
        <td class="text-center" id="td"><?= htmlspecialchars($id) ?></td>
        <td class="text-center"><?= htmlspecialchars($r['product_name']) ?></td>
        <td class="text-center"><?= htmlspecialchars($cate) ?></td>
        <td class="text-center"> <?= htmlspecialchars($brand) ?></td>
        <td class="text-center" id="td"><?= htmlspecialchars($r['product_description']) ?></td>

        <td class="text-center"> <?= htmlspecialchars($r['product_qyt']) ?></td>
        <td class="text-center"> <?= htmlspecialchars($r['product_base_price']) ?></td>
        <td class="text-center"> <?= htmlspecialchars($r['product_mrp']) ?></td>
        <td class="text-center"> <?= htmlspecialchars($r['location']) ?></td>


        <td class="text-center"><?= $sat ?></td>
        <td class="text-center"><a href="#"
                                   onclick="editBrandModal(<?= htmlspecialchars($id) ?>)"
                                   id="" class="btn-sm btn btn-warning" title="Edit"> <i class="fa fa-wrench" aria-hidden="true"></i> </a></td>
        <td class="text-center"><?= $btn ?>
        </td>

    </tr>
<? endforeach ?>

<?php
/*<!--INSERT INTO `product`(`product_id`, `category_id`, `brnad_id`, `product_name`, `product_description`,
`product_unit`, `product_qyt`, `product_base_price`, `product_tax`,
`product_mrp`, `product_mini_order`, `product_enter_by`, `product_status`, `date`)-->*/
$rs = $product->get();
foreach ($rs as $r):
$id = $r['product_id'];
$cate = $r['category_id'];
$product_name = $r['product_name'];
$product_description = $r['product_description'];
$product_unit = $r['product_unit'];
$product_qyt = $r['product_qyt'];
$product_base_price = $r['product_base_price'];
$product_mrp= $r['product_mrp'];
$product_status = $r['product_status'];
$location = $r['location'];
if ($product_status === 'Active') {
    $sat = "<span class=\"badge badge-success\">Active</span>";
    $btn = "<a href='#' onclick='deleteBrandModal($id)' title='delete' class='btn-sm btn btn-danger'> 
                                     <i class=\"fa fa-trash\" aria-hidden=\"true\"></i> </a>";
} else {
    $sat = "<span class=\"badge badge-danger\">Inactive</span>";
    $btn = "<a href='#' onclick='reactiveBrandModal($id)' title='reactive' class='btn-sm btn btn-success'> 
                                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> </a>";
}

?>
    <?php
    $rs = $product->get();
    foreach ($rs as $r){

        $id = $r['product_id'];
        $cate = $r['category_id'];
        $brnd= $r['brnad_id'];
        $product_name = $r['product_name'];
        $product_description = $r['product_description'];
        $product_unit = $r['product_unit'];
        $product_qyt = $r['product_qyt'];
        $product_base_price = $r['product_base_price'];
        $product_mrp= $r['product_mrp'];
        $product_status = $r['product_status'];
        $location = $r['location'];
        if ($product_status === 'Active') {
            $sat = "<span class=\"badge badge-success\">Active</span>";
            $btn = "<a href='#' onclick='deleteBrandModal($id)' title='delete' class='btn-sm btn btn-danger'> 
                                     <i class=\"fa fa-trash\" aria-hidden=\"true\"></i> </a>";
        }
        else {
            $sat = "<span class=\"badge badge-danger\">Inactive</span>";
            $btn = "<a href='#' onclick='reactiveBrandModal($id)' title='reactive' class='btn-sm btn btn-success'> 
                                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> </a>";
        }
        echo "<tr>
                                   <td class='text-center'>$id</td>
                                   <td class='text-center'>$product_name</td>
                                   <td class='text-center'>$cate</td>
                                   <td class='text-center'>$brnd</td>
                                   <td class='text-center'>$product_description</td>
                                   <td class='text-center'>$product_qyt</td>
                                   <td class='text-center'>$product_base_price</td>
                                   <td class='text-center'>$product_mrp</td>
                                   <td class='text-center'>$location</td>
                                   <td class='text-center'>$sat</td>
                                   <td class='text-center'><a href='#' onclick='editBrandModal($id)'
                                   id=\"\" class='btn-sm btn btn-warning' title=\"Edit\"> <i class='fa fa-wrench' aria-hidden='true'></i> </a>
                                   </td>
                                   <td class='text-center'>$btn</td>
                                   </tr>";
    }
    ?>