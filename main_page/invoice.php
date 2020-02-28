<?php
$order_id = $_GET['order_id'];
$sub = $_GET['sub'];
$tax = $_GET['tax'];
include_once '../controller/OrderController.php';
include_once '../controller/CartController.php';
$or = new OrderController();
$ors = new CartController();
$r = $or->getOrderById($order_id)->fetch();
$rs = $ors->getCartItemById($order_id)->fetchAll();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }

        @media print {

            .btn {
                display: none;
            }
        }
        @media print {

           @page  {
              margin-top: 0;
               margin-bottom: 0;
           }
        body{
             padding-top: 72px;
             padding-bottom: 72px;
           }
        }
    </style>
</head>
<body>


<div class=" border print col-6 mx-auto d-block">
    <div class="row ">
        <div class="col-xs-12 ">
            <div class="invoice-title">
                <h2>Apna Store</h2>
                <h3 class="pull-right">Invoice</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        Name: <?= $r['user_name']; ?> <br>
                        User Code: <?= $r['user_code']; ?> <br>
                        Mobile: <?= $r['user_mobile']; ?> <br>

                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Id:</strong><br>
                        <?= $r['order_id']; ?> <br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        <?= $r['payment_method']; ?>
                        <br>

                    </address>
                </div>

                <div class="col-xs-6 text-right">
                    <address>

                        <strong>Date & Time:</strong><br>
                        <?= $r['dateTime']; ?>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
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
                    <tbody>
                    <!-- `cart`(`id`, `order_id`, `product_name`, `qyt`, `price`, `amount`) -->
                    <? $a = 1;
                    foreach ($rs as $rss) {
                        echo ' <tr >
                        <td>' . $a . '</td>
                        <td>' . $rss['product_name'] . '</td>
                         <td>' . $rss['price'] . '</td>
                        <td>' . $rss['qyt'] . '</td>
                        <td class="text-right">' . $rss['amount'] . '</td>
                    </tr>';
                        $a++;
                    } ?>


                    <tr>
                        <td class="thick-line" colspan="3"></td>

                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                        <td class="thick-line text-right"><?= $sub; ?></td>
                    </tr>
                    <tr>
                        <td class="no-line" colspan="3"></td>
                        <td class="no-line text-center"><strong>Discount</strong></td>
                        <td class="no-line text-right"><?= $r['discount']; ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="no-line" colspan="3"></td>
                        <td class="no-line text-center"><strong>Tax</strong></td>
                        <td class="no-line text-right"><?= $tax; ?></td>
                    </tr>
                    <tr>
                        <td class="no-line" colspan="3"></td>
                        <td class="no-line text-center"><h4>Total</h4></td>
                        <td class="no-line text-right"><h4><?= $r['total_amount']; ?> INR</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    myFunction();
    function myFunction() {
        window.print();
    }

    function closePrintView() {
        window.location.href='dashboard.php'
    }

    window.onafterprint=function (e) {
        closePrintView();
    }

</script>

</body>
</html>