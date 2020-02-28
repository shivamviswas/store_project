<?php
$order_id = $_GET['order_id'];
include_once '../controller/OrderController.php';
include_once '../controller/CartController.php';
$or = new OrderController();
$ors = new CartController();
$r = $or->getOrderById($order_id)->fetch();
$rs = $ors->getCartItemById($order_id)->fetchAll();


$msg = '<div class="container border">
    <div class="row ">
        <div class="col">
         
            <div class="row">
                <div class="col">
                    <address>
                        <strong>Billed To:</strong><br>
                        Name: ' . $r["user_name"] . ' <br>
                        User Code: ' . $r["user_code"] . ' <br>
                        Mobile: ' . $r["user_mobile"] . ' <br>

                    </address>
                </div>
                <div class="col py-2 text-right">
                    <address>
                        <strong>Order Id:</strong><br>
                        ' . $r["order_id"] . ' <br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <address>
                        <strong>Payment Method:</strong><br>
                        ' . $r["payment_method"] . '
                        <br>

                    </address>
                </div>

                <div class="col text-right py-2">
                    <address>

                        <strong>Date & Time:</strong><br>
                        ' . $r["dateTime"] . '
                    </address>
                </div>
            </div>
        </div>
    </div>';
$msg .= '<div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-shopping">
                    <thead>
                    <tr class="thick-line">
                        <th>Item no</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qyt</th>
                        <th class="text-right">Amount</th>

                    </tr>
                    </thead>
                    <tbody>';

$a = 1;
$msg2='';
foreach ($rs as $rss) {
    $msg2.= ' <tr >
                        <td>' . $a . '</td>
                        <td>' . $rss['product_name'] . '</td>
                         <td>' . $rss['price'] . '</td>
                        <td>' . $rss['qyt'] . '</td>
                        <td class="text-right">' . $rss['amount'] . '</td>
                    </tr>';
    $a++;
}
                    $msg.=$msg2;
$msg.='<tr>
    <td class="no-line" colspan="3"></td>
    <td class="no-line text-center"><strong>Discount</strong></td>
    <td class="no-line text-right">'. $r['discount'].'</td>
</tr>
<tr>
<tr>
    <td class="no-line" colspan="3"></td>
    <td class="no-line text-center"><h4>Total</h4></td>
    <td class="no-line text-right"><h4>'. $r['total_amount'].' INR</h4></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>';
echo $msg;


