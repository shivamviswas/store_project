<?php
include_once('../model/Admin.php');

class AdminController extends Admin
{
    public function createUser($name, $mobile, $password, $role, $status)
    {

        return $this->setUser($name, $mobile, $password, $role, $status);
    }

    public function checkLogin($mobile, $password)
    {
        $r=$this->checkUser($mobile, $password);
        if($r!='0')
       { session_start();
        $r=$this->checkUser($mobile, $password)->fetch(PDO::FETCH_ASSOC);
        $_SESSION['name']=$r['name'];
        $_SESSION['mobile']=$r['mobile'];
        return 'success';
       }else{
            return $r;
        }
    }

    public function logout()
    { session_start();
        session_unset();
        session_destroy();
        return true;
    }
}