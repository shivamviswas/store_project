<?php

include_once '../model/Category.php';

class CategoryController extends Category
{

    public function createCategory($name, $dec,$status){

        return $this->setCategory($name, $dec, $status);

    }

    public function editCategory($id,$name,$des){

        return $this->updateCategory($id,$name,$des);

    }

    public function categoryCount(){

        return $this->totalCategory();

    }
    public function inCategoryCount($check,$condition){

        return $this->countElement($check,$condition)->rowCount();

    }

    public function fetchAll(){

        return $this->allCategoryData();

    }

    public function deleteCategory($cate_id,$status){

        return $this->updateCategoryStatus($cate_id,$status);

    }

    public function getCategoryFor($id){
       $r= $this->allCategoryData();
       foreach ($r as $ar){
           if($ar['category_id']==$id AND $ar['category_status']=='Active' ){
               return $ar;
           }

       }
        return http_response_code(500);
    }



}