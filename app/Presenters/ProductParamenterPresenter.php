<?php

namespace App\Presenters;

use App\Models\ProductParamenter;
use App\Models\Product;
use App\Models\ProductFramework;
use Overtrue\Pinyin\Pinyin;
class ProductParamenterPresenter
{
    //显示参数
    public function showCanShu($ProductParamenter)
    {
        $Canshu=[];
        if($ProductParamenter->parameter_id){

            switch ($ProductParamenter->show_type){
                case 'framework':
                   $Canshu = $ProductParamenter->frameWorks_series()->whereParentId(0)->orderBy('name', 'asc')->pluck('name', "name as id");
                    break;
                case 'series':
                    $Canshu = $ProductParamenter->frameWorks_series()->whereNotNull('parent_id')->orderBy('name', 'asc')->pluck('name', "name as id");
                    break;
                case 'goods':
                    $Canshu = $ProductParamenter->goods()->orderBy('name', 'desc')->pluck('name', "id as id");

                    break;
                case 'paramenters':
                 $Canshu = $ProductParamenter->paramenters()->orderBy('name', 'asc')->pluck('name', "name as id");
                   break;
            }
        }else{
            $Canshu = $ProductParamenter->Childrens->sortBy('name')->pluck('name', "name");
        }
        return $Canshu;
    }
   //显示参数名
    public function showCanShuName($ProductParamenter,$products)
    {


        return 11;
    }
    //显示参数名
    public function showDetails($id,$details)
    {
        if(!empty($details)){
            return $details[$id];
        }else{
            return null;
        }
    }
    //显示参数名
    public function showPinyin()
    {
       return new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
    }
}