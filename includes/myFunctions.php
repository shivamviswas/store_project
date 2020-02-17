
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


