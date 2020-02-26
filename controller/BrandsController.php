<?php
include_once '../model/Brands.php';

class BrandsController extends Brands
{

    public function create($name, $des, $status)
    {
        return $this->setBrand($name,$des,$status);
    }

    public function get()
    {
        return $this->getAllBrands();
    }

    public function update($id, $name, $des)
    {
    return $this->updateBrand($id,$name,$des);
    }

    public function delete($id)
    {
        $status='Inactive';
        return $this->updateBrandStatus($id,$status);
    }

    public function reactive($id)
    {
        $status='Active';
        return $this->updateBrandStatus($id,$status);
    }

    public function getBrandForUpdate($id){
        $r= $this->getAllBrands();
        foreach ($r as $ar){
            if($ar['brand_id']==$id AND $ar['brand_status']=='Active' ){
                return $ar;
            }

        }
        return http_response_code(500);
    }

    public function brandCount()
    {
        return $this->getAllBrands()->rowCount();
    }

    public function inBrandCount($row, $cond)
    {
        return $this->countElement($row, $cond);
    }

    public function getBrandName($check,$condition){

        $r=$this->countElement($check,$condition)->fetch();
        return $r['brand_name'];
    }
}
