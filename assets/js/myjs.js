$(document).ready( function () {
    var user = $('#userPage').val();

    if (user>0)
    {
        $('.nav-item').attr('class','nav-item');

        switch (user) {
            case '1':
                $('#act1').attr('class','nav-item active');
            break;

            case '2': $('#act2').attr('class','nav-item active');
            break;

            case '3': $('#act3').attr('class','nav-item active');
            break;

            case '4': $('#act4').attr('class','nav-item active');
            break;

            case '5': $('#act5').attr('class','nav-item active');
            break;

            case '6': $('#act6').attr('class','nav-item active');
            break;

            case '7': $('#act7').attr('class','nav-item active');
            break;


        }

    }

    /***********************************/

   /* $('#addNewUser').click(function(e){
        e.preventDefault();
        $('#addNewHtml').load('../Users/newUserFrom.php');
    });*/

/*    $('#addNewCategory').click(function(e){
        e.preventDefault();
        $('#addNewHtml').load('../Category/newCategory.php');
    });*/

    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });



});

$(document).ready(function() {
        var table = $('#dataTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
        } );
} );

function showNotification(from, align, message,color) {
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
            var obj=JSON.parse(data);
            $('#user_id').val(obj.user_id);
            $('#name').val(obj.name);
            $('#code').val(obj.code);
            $('#mobile').val(obj.mobile);
            $('#editUser').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This user can\'t be edit','2');
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}
$(document).ready(function(){
    $('#addNewUser').click(function (e) {
        e.preventDefault();
        $('#addUser').modal('show');
    })
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
            var obj=JSON.parse(data);
            $('#id').val(obj.category_id);
            $('#name').val(obj.category_name);
            $('#des').val(obj.category_des);
            $('#editCate').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This Category can\'t be edit','2');
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}
$(document).ready(function(){
    $('#addNewCategory').click(function (e) {
        e.preventDefault();
        $('#addCate').modal('show');
    })
});
/****************** end Category Functions ***************************************/


/****************** Brand Functions ***************************************/
$(document).ready(function(){
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
            var obj=JSON.parse(data);
            $('#id').val(obj.brand_id);
            $('#name').val(obj.brand_name);
            $('#des').val(obj.brand_des);
            $('#editBrand').modal("show");
        },
        error: function (result) {
            showNotification('top', 'right', 'This Category can\'t be edit','2');
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
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
                $( "#inactive" ).load(window.location.href + " #inactive" );
                $( "#dataTable" ).load(window.location.href + " #dataTable" );
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}
/****************** end Brand Functions ***************************************/


