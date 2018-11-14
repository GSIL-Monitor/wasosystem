<?php

namespace App\Services;


use App\Models\ProductGood;
use App\Models\SupplierManagement;

class ProductGoodServices
{
    public static function pic($pics)
    {

        $arr=[];
        foreach ($pics as $key=>$pic){
            foreach ($pic as $key2=>$item2){
                if($key2=='url_name'){
                    $arr['url'][$key]=str_replace('files_images','copy/files_images',$item2);
                }elseif ($key2=='name'){
                    $arr['name'][$key]=$item2;
                }
            }
        }

        return $arr;

    }
    public static function copy($product_good)
    {
        $old_product_good=$product_good->toArray();
        $init_data=array_except($old_product_good,['id','created_at','updated_at','deleted_at','oldid']);
        $init_data['name']=$product_good->name.'-------副本';
        $init_data['jiancheng']=$product_good->name.'-------副本';
        $pics=json_decode($product_good->pic,true);
        if(!empty($pics) && str_contains($product_good->product_id ,[20,23] )){
            $init_data['pic']=self::pic($pics);
            FileServices::copy($pics);
            $product_good->create($init_data);
    }

}
}

?>