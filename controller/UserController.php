<?php

include_once '../model/User.php';
class UserController extends User
{

    public function createUser($name, $mobile,  $code, $date, $status){

        return $this->setUser($name, $mobile, $code, $date, $status);

    }
    public function editUser($id,$name,$code,$mobile){

        return $this->updateUser($id,$name,$code,$mobile);

    }

    public function userCount(){

        return $this->totalUsers();

    }
    public function inUserCount($check,$condition){

        return $this->countElement($check,$condition)->rowCount();

    }
    public function fetchAll(){

        return $this->allUsersData();

    }

    public function deleteUser($user_id,$status){

        return $this->updateUserStatus($user_id,$status);

    }

    public function getUserFor($id){
       $r= $this->allUsersData();
       foreach ($r as $ar){
           if($ar['user_id']==$id AND $ar['status']=='Active' ){
               return $ar;
           }

       }
        return http_response_code(500);
    }



}