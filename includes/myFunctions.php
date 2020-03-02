
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
function msg_to_member($mobile,$CB,$TP)
{
    if ( strlen($mobile)>9)
    {$msg="Congratulations, Apna Store has gave Rs.$CB towards 50% cash back of Rs.$TP of profit for Apna Profit 50-50 Program.";
    $ht = "http://api.msg91.com/api/sendhttp.php?country=91&sender=APNAST&route=4&mobiles=".$mobile."&authkey=292400AaEdEcV55d6e5748&message=$msg";
    $tt = file_get_contents($ht);
    }
}