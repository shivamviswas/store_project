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
        session_start();
        $r=$this->checkUser($mobile, $password)->fetch();
        $_SESSION['name']=$r['name'];
        $_SESSION['mobile']=$r['mobile'];
        return 'success';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return true;
    }
}