
<?php

    function duplicateBack($msg){
       return $msg="<script> alert('$msg'); window.history.back(); </script>";
    }
    function alert($msg){
       return $msg="<script> alert('$msg')</script>";
    }
    function reload(){
       return $msg="<script> location.reload();</script>";
    }

    function location($location){
       return $location="<script>location.href='$location'</script>";
    }

    function location_replace($location){
       return $location="<script> location.replace('$location') </script>";
    }


function randomCode($length)
{
    $alphabet = "1234567890";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string

}

function setOrderId($id){

}