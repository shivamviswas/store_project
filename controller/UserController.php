<?php

include_once '../model/User.php';
include_once '../includes/myFunctions.php';
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

        return $this->countElement($check,$condition);

    }
    public function fetchAll(){

        return $this->allUsersData();

    }

    public function deleteUser($user_id,$status){

        return $this->updateUserStatus($user_id,$status);

    }
    public function getUserForId($name){

        $qry= $this->getNameId($name);
        if ($qry->rowCount() > 0) {
            $r=$qry->fetchAll();
            $result = array();
            foreach ($r as $row) {
                if($row['status']=='Active'){
                $response = array("value" => $row['mobile'], "code" => $row['code'],
                    "label" => $row['name'],
                    "id" => $row['user_id'],
                    "bal" => $row['card_balance']);
                array_push($result, $response);
                }
            }
            return $result;
        }else{
            return $result=array('success'=>0,'message'=>'failed');
        }


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

    public function updateBalance($user_code,$balance){

       $r= $this->countElement('code',$user_code)->fetch();

       $this->updateUserBalance($user_code,($r['card_balance']+$balance));

    }

    public function updateSubBalance($user_code,$balance){

       $r= $this->countElement('code',$user_code)->fetch();

       $this->updateUserBalance($user_code,($r['card_balance']-$balance));

    }



}