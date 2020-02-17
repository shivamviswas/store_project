
$(document).ready(function(){

    $("#send").click(function(e){
        e.preventDefault();
        alert('sss');
        /*
        $.ajax({
            url: '../Users/userApi.php', // url where to submit the request
            type : "POST", // type of action POST || GET
            dataType : 'json', // data type
            data : $("#newUserAddForm").serialize(), // post data || get data
            success : function(result) {
                console.log(result);
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });
*/
    });
});
