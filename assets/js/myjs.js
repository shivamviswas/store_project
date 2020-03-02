$(document).ready(function () {
    var user = $('#userPage').val();

    if (user > 0) {
        $('.nav-item').attr('class', 'nav-item');

        switch (user) {
            case '1':
                $('#act1').attr('class', 'nav-item active');
                break;

            case '2':
                $('#act2').attr('class', 'nav-item active');
                break;

            case '3':
                $('#act3').attr('class', 'nav-item active');
                break;

            case '4':
                $('#act4').attr('class', 'nav-item active');
                break;

            case '5':
                $('#act5').attr('class', 'nav-item active');
                break;

            case '6':
                $('#act6').attr('class', 'nav-item active');
                break;
                case '7':
                $('#act7').attr('class', 'nav-item active');
                break;

            case '8':
                $('#act8').attr('class', 'nav-item active');
                break;


        }

    }


    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });


});

$(document).ready(function () {
    var table = $('#dataTable').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});

function showNotification(from, align, message, color) {
    type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    col = Math.floor((Math.random() * 6) + 1);

    $.notify({
        icon: "highlight_off",
        message: message

    }, {
        type: type[color],
        timer: 3000,
        placement: {
            from: from,
            align: align
        }
    });
}

/****************** User Functions ***************************************/
function editUserModal(id) {
    $.ajax({
        url: '../Users/userApi.php', // url where to submit the request
        type: "POST", // type of action POST || GET
        data: {getUpdate: id}, // post data || get data
        success: function (data) {
            console.log(data);
            var obj = JSON.parse(data);
            $('#user_id').val(obj.user_id);
            $('#name').val(obj.name);
            $('#code').val(obj.code);
            $('#mobile').val(obj.mobile);
            $('#editUser').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This user can\'t be edit', '2');
            console.log(result);

        }
    });
}

function deleteUserModal(id) {

    var r = confirm("Are Your Sure, you want to delete");
    if (r == true) {

        $.ajax({
            url: '../Users/userApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {delete: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
                console.log(data);
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

function reactiveUserModal(id) {

    var r = confirm("Are Your Sure, you want to reactive");
    if (r == true) {

        $.ajax({
            url: '../Users/userApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {reactive: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

$(document).ready(function () {
    $('#addNewUser').click(function (e) {
        e.preventDefault();
        $('#addUser').modal('show');
    });
    $("#auto").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '../Users/userApi.php',
                type: 'post',
                dataType: "json",
                data: {
                    getUser: request.term
                },
                success: function (data) {
                    console.log('success' + JSON.stringify(data));
                    response(data);
                },
                error: function (data) {

                    console.log('failed' + JSON.stringify(data));
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#username').val(ui.item.label); // display the selected text
            $('#name_view').html(ui.item.label); // display the selected text
            $('#usermobile').val(ui.item.value); // save selected id to input
            $('#userid').val(ui.item.id); // save selected id to input
            $('#auto').val(ui.item.code);// save selected id to input
            $('#code_view').html(ui.item.code);// save selected id to input
            $('#id_view').val(ui.item.id);// save selected id to input
            $('#balance').val(Math.round(ui.item.bal));// save selected id to input
            if(ui.item.bal>1){
                addDiscount(Math.round(ui.item.bal));
            }
            return false;
        }
    });
});

/****************** end User Functions ***************************************/


/****************** Category Functions ***************************************/
function editCategoryModal(id) {
    $.ajax({
        url: '../Category/categoryApi.php', // url where to submit the request
        type: "POST", // type of action POST || GET
        data: {getUpdate: id}, // post data || get data
        success: function (data) {
            console.log(data);
            var obj = JSON.parse(data);
            $('#id').val(obj.category_id);
            $('#name').val(obj.category_name);
            $('#des').val(obj.category_des);
            $('#editCate').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This Category can\'t be edit', '2');
            console.log(result);

        }
    });
}

function deleteCategoryModal(id) {

    var r = confirm("Are Your Sure, you want to delete");
    if (r == true) {

        $.ajax({
            url: '../Category/categoryApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {delete: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
                console.log(data);
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

function reactiveCategoryModal(id) {

    var r = confirm("Are Your Sure, you want to reactive");
    if (r == true) {

        $.ajax({
            url: '../Category/categoryApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {reactive: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

var isClick = true;

function addCategory() {
    var mForm = $('#category_add_form');
    if (mForm.valid()) {


        if (isClick) {
            $('#addBrand').modal('hide');
            $.ajax({
                url: '../Category/categoryApi.php', // url where to submit the request
                type: "POST", // type of action POST || GET
                data: mForm.serialize(), // post data || get data
                dataType: "JSON", // type of action POST || GET
                success: function (data) {

                    $.alert({
                        title: 'Alert!',
                        content: 'Successfully Added',
                        type: 'GREEN',
                        boxWidth: '400px',
                        useBootstrap: false,
                        autoClose: "Ok|2000"
                    });
                    // $("#load_fun").load(window.location.href + " #load_fun");
                    location.reload();

                },
                error: function (result) {
                    console.log(result);
                    alert('e' + result);
                }
            });
        }
    } else {
        alert('false')
    }
}

/****************** end Category Functions ***************************************/


/****************** Brand Functions ***************************************/
$(document).ready(function () {
    $('#addNewBrand').click(function (e) {
        e.preventDefault();
        $('#addBrand').modal('show');
    })
});


function editBrandModal(id) {
    $.ajax({
        url: '../Brand/brandApi.php', // url where to submit the request
        type: "POST", // type of action POST || GET
        data: {getDataForUpdate: id}, // post data || get data
        success: function (data) {
            console.log(data);
            var obj = JSON.parse(data);
            $('#id').val(obj.brand_id);
            $('#name').val(obj.brand_name);
            $('#des').val(obj.brand_des);
            $('#editBrand').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This Category can\'t be edit', '2');
            console.log(result);

        }
    });
}

function deleteBrandModal(id) {

    var r = confirm("Are Your Sure, you want to delete");
    if (r == true) {

        $.ajax({
            url: '../Brand/brandApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {delete: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
                console.log(data);
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

function reactiveBrandModal(id) {

    var r = confirm("Are Your Sure, you want to reactive");
    if (r == true) {

        $.ajax({
            url: '../Brand/brandApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {reactive: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}


/****************** end Brand Functions ***************************************/

/****************** Product Functions ***************************************/
function editProductModal(id) {
    $.ajax({
        url: '../Product/productApi.php', // url where to submit the request
        type: "POST", // type of action POST || GET
        data: {getDataForUpdate: id}, // post data || get data
        success: function (data) {
            console.log(data);
            /*<!--INSERT INTO `product`(`product_id`, `category_id`, `brnad_id`, `product_name`, `product_description`,
                                 `product_unit`, `product_qyt`, `product_base_price`, `product_tax`,
                                `product_mrp`, `product_mini_order`, `product_enter_by`, `product_status`, `date`)-->*/
            var obj = JSON.parse(data);
            $('#id').val(obj.product_id);
            $('#name').val(obj.product_name);
            $('#des').val(obj.product_description);
            $('#brand').val(obj.brnad_id);
            $('#cate').val(obj.category_id);
            $('#base_price').val(obj.product_base_price);
            $('#qyt').val(obj.product_qyt);
            $('#mrp').val(obj.product_mrp);
            $('#unit').val(obj.product_unit);
            $('#location').val(obj.location);
            $('#editBrand').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This Category can\'t be edit', '2');
            console.log(result);

        }
    });
}

function deleteProductModal(id) {

    var r = confirm("Are Your Sure, you want to delete this product");
    if (r == true) {

        $.ajax({
            url: '../Product/productApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {delete: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
                console.log(data);
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

function reactiveProductModal(id) {

    var r = confirm("Are Your Sure, you want to reactive");
    if (r == true) {

        $.ajax({
            url: '../Product/productApi.php', // url where to submit the request
            type: "POST", // type of action POST || GET
            data: {reactive: id}, // post data || get data
            success: function (data) {
                $("#inactive").load(window.location.href + " #inactive");
                $("#dataTable").load(window.location.href + " #dataTable");
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

/****************** end Product Functions ***************************************/


/****************** Cart Functions ***************************************/

$(document).ready(function () {
    var currentStock;
    $('#itemTable').hide();


    /******************  Product Auto Complete ***************************************/
    $("#pro_code").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '../Product/productApi.php',
                type: 'post',
                dataType: "json",
                data: {
                    getproduct: request.term
                },
                success: function (data) {
                    console.log('success' + JSON.stringify(data));
                    response(data);
                },
                error: function (data) {

                    console.log('failed' + JSON.stringify(data));
                }
            });
        },
        select: function (event, ui) {
            $('#pro_code').val(ui.item.value);
            $('#pro_name').val(ui.item.label);
            $('#pro_qyt').focus();
            $('#pro_qyt').val('');
            currentStock = (ui.item.total_qyt);
            $('#pro_price').val(ui.item.price);
            $('#pro_amount').val(ui.item.price);

            return false;
        }
    });
    /******************  end Product Auto Complete ***************************************/

    /******************  Set Quantity ***************************************/
    $('#pro_price,#pro_qyt').on('keydown keyup click', function () {
        if ($(this).val() != '' && $('#pro_code').val() != '' && $('#pro_price').val() != '') {
            if (currentStock > Number($(this).val())) {
                var sum = (Number($(this).val()) * Number($('#pro_price').val()));
                $('#pro_amount').val(sum);
            }
            else {
                $.alert({
                    title: 'Alert!',
                    content: 'Not Enough Product',
                    type: 'red',
                    autoClose: "ok|2000",
                    buttons: {
                        ok: {
                            text: 'Ok',
                            action: function () {
                                $('#pro_qyt').val('');
                                $('#pro_amount').val('');
                            }
                        }
                    }
                });
            }
        }
    });
    /******************  end Set Quantity***************************************/

    /******************  Add item  ***************************************/
    $('#addProductItem').click(function () {
        if ( $('#pro_code').val() != '' &&
            $('#pro_amount').val() != '' &&
            $('#pro_name').val() != '' &&
            $('#pro_qyt').val() != '' &&
            $('#pro_price').val() != '')
        {
        var product={
            pro_code:$('#pro_code').val(),
            pro_amount:$('#pro_amount').val(),
            pro_qyt:$('#pro_qyt').val(),
            pro_price:$('#pro_price').val(),
            pro_name:$('#pro_name').val(),
        };
            addRow(product);
        } 
        else {
                $.alert({
                    title: 'Alert!',
                    content: 'Please Fill All details',
                    type: 'red',
                    autoClose: "ok|2000",
                    buttons: {
                        ok: {
                            text: 'Ok',
                            action: function () {

                            }
                        }
                    }
                });
            }


    });
   /******************  end Add Item ***************************************/

});
var gl_total=0;
var item_cost=0;
var total=0;
var isRowAdded=false;
/******************  all Cart functions ***************************************/
function addRow(product) {
    $('#itemTable').show();
    var isrun=true;
    $('#itemTable tbody tr').each( function (row,tr) {
        var product_name=$(tr).find('td:eq(0)').text();
        var qyt=$(tr).find('td:eq(2)').text();
        if(product_name == product.pro_name && qyt==product.pro_qyt){
            isrun=false
        }
        else {
            isrun=true;
        }
    } );

   if(isrun){
       var tableB=$('#itemTable tbody');
       var row=$(
           "<tr>" +
           "<td>"+product.pro_code +"</td>"+
           "<td>"+product.pro_name +"</td>"+
           "<td>"+product.pro_price +"</td>"+
           "<td>"+product.pro_qyt +"</td>"+
           "<td><span>"+product.pro_amount +"</span></td>"+
           "<td> <button onclick='deleteItem(this)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>"+
           " </tr>"
       );

       row.data('pro_name',product.pro_name);
       row.data('pro_price',product.pro_price);
       row.data('pro_qyt',product.pro_qyt);
       row.data('pro_amount',product.pro_amount);
       tableB.append(row);
       $('#product_add_table')[0].reset();
       total+=Number(product.pro_amount);
       isRowAdded=true;

       gl_total=total;
       totalCart(total);
   }
   else {
       $.alert({
           title: 'Alert!',
           content: 'Already added this item',
           type: 'red',
           autoClose: "ok|5000",
           buttons: {
               ok: {
                   text: 'Ok',
                   action: function () {

                   }
               }
           }
       });
   }


}
function totalCart(total) {

  //  var sub = $('#sub').val(total);
     var tax = 4*total/100;
    $('#sub_v').html('<i class="fa fa-inr"></i>'+total);
    $('#sub').val(total);
    $('#tax_v').html('<i class="fa fa-inr"></i>'+tax);
    $('#dis_v').html('<i class="fa fa-inr"></i>'+$('#dis').val());
    $('#tax').val(tax);
    $('#net_total_v').html('<i class="fa fa-inr"></i>'+(Math.round(tax+total- $('#dis').val())));
    $('#net_total').val((Math.round(tax+total- $('#dis').val())));
}
function deleteItem(row) {
item_cost=$(row).parent().parent().find('td:eq(3)').text();
total-=item_cost;
totalCart(total);
$(row).parent().parent().remove();
}

function mReset(){
}


function checkOut() {
    if($('#cart_user').valid()){

        if(isRowAdded){

            var itemArray=[];

            $('#itemTable tbody tr').each( function (row,tr) {
                 sub_arry={
                    'name':$(tr).find('td:eq(1)').text(),
                    'price':$(tr).find('td:eq(2)').text(),
                    'qyt':$(tr).find('td:eq(3)').text(),
                    'amount':$(tr).find('td:eq(4)').text(),
                    'code':$(tr).find('td:eq(0)').text(),
                };
                itemArray.push(sub_arry);
            });

            var user_name,user_mobile,user_code,total_amount,no_item,discount,payment_method;
            user_name=$('#username').val();
            user_code=$('.code').val();
            user_mobile=$('#usermobile').val();
            total_amount=$('#net_total').val();
            no_item=itemArray.length;
            discount=$('#dis').val();
            payment_method='cash';
            console.log('data => '+ JSON.stringify(itemArray));
        $.ajax({
                url: '../Orders/orderApi.php',
                type: 'post',
                dataType: 'json',
                data: {
                    setOrder:'1',
                    user_code:user_code,
                    user_name:user_name,
                    user_mobile:user_mobile,

                    total_amount:total_amount,
                    discount:discount,
                    payment_method:payment_method,
                    no_item:no_item,
                    itemArray:itemArray
                },
                success: function (data) {
                    console.log('data => '+ JSON.stringify(data));
                    if(Number(data)>0){
                        $.alert({
                            title: 'Alert!',
                            content: 'You Ordered Successfully',
                            type: 'green',
                            autoClose: "ok|2000",
                            buttons: {
                                ok: {
                                    text: 'Ok',
                                    action: function () {
                                    window.location='../main_page/invoice.php?order_id='+data+'&tax='+ $('#tax').val()+'&sub='+ $('#sub').val();
                                    }
                                }
                            }
                        });
                    }
                    else {
                        $.alert({
                            title: 'Alert!',
                            content: 'Not Submitted',
                            type: 'red',
                            autoClose: "ok|2000",
                            buttons: {
                                ok: {
                                    text: 'Ok',
                                    action: function () {

                                    }
                                }
                            }
                        });
                    }
                },
                error: function (data) {
                    console.log('e data => '+ JSON.stringify(data));
                    $.alert({
                        title: 'Alert!',
                        content: 'Some Error',
                        type: 'red',
                        autoClose: "ok|2000",
                        buttons: {
                            ok: {
                                text: 'Ok',
                                action: function () {

                                }
                            }
                        }
                    });

                }
            });


        }
        else {
            $.alert({
                title: 'Alert!',
                content: 'Please Add Any item to cart',
                type: 'red',
                autoClose: "ok|2000",
                buttons: {
                    ok: {
                        text: 'Ok',
                        action: function () {

                        }
                    }
                }
            });
        }


    }
    else {
        $.alert({
            title: 'Alert!',
            content: 'Please Fill User Details',
            type: 'red',
            autoClose: "ok|2000",
            buttons: {
                ok: {
                    text: 'Ok',
                    action: function () {

                    }
                }
            }
        });
    }
}

function addUserFromDash() {

    var form=$('#userFormDash');
    if(form.valid()){
        $('#addBrand').modal('hide');
        $.ajax({
            url: '../Users/userApi.php',
            type: 'post',
            dataType: 'json',
            data: form.serialize() ,
            success: function (data) {
                if(data=='1')
                {
                    $.alert({
                    title: 'Alert!',
                    content: 'Added Successfully',
                    type: 'green',
                    autoClose: "ok|2000",
                    buttons: {
                        ok: {
                            text: 'Ok',
                            action: function () {

                            }
                        }
                    }
                });
                }

            },
            error: function (data) {
                console.log('e data => '+ JSON.stringify(data));


            }
        });

        console.log(form)
    }else {

        showNotification('bottom', 'right', 'Please Fill All Details', '2');
    }
}
function addDiscount(bal) {
var disInput=$('#dis');
    disInput.attr( { type:"number", value:bal });
    disInput.on('change',function (e) {
        if(disInput.val()>bal){
            $.alert({
                title: 'Alert!',
                content: 'you can not enter above balance',
                type: 'red',
                autoClose: "ok|2000",
                buttons: {
                    ok: {
                        text: 'Ok',
                        action: function () {
                            disInput.val(0);
                            totalCart(gl_total);
                        }
                    }
                }
            });
            return false;
        }
        else {

            if($('#net_total').val()>0 && $('#dis').val()>0){

                var dis=$('#dis').val();
                var total=$('#net_total').val();
                console.log(''+total-dis);
                $('#net_total_v').html('<i class="fa fa-inr"></i>'+(Math.round(total-dis)));
                $('#net_total').val((Math.round(total-dis)));

            }

        }
    })


}

/******************  End all Cart functions ***************************************/
/******************END Cart Functions ***************************************/



/******************Orders Functions ***************************************/

function viewOrder(or_id) {
    $.ajax({
        url: '../Orders/invoice.php?order_id='+or_id, // url where to submit the request
        type: "GET", // type of action POST || GET
        success: function (data) {

            $("#mViewOrder").html(data);
            $('#viewOrder').modal('show');

        },
        error: function (result) {
            console.log(result);
        }
    });


}

function deleteOrder(or_id) {

  $.ajax({
        url: '../Orders/orderApi.php',
        type: "Post", // type of action POST || GET
        data: {delete:or_id}, // type of action POST || GET
        success: function (data) {
            if(data==1) {
                $("#dataTable").load(window.location.href + " #dataTable");

            }
        },
        error: function (result) {
            console.log(result);
        }
    });


}

/******************Endorders Functions ***************************************/