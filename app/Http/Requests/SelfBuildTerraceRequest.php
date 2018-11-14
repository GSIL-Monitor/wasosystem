<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfBuildTerraceRequest extends Request
{


   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                       'jiagou_id' => 'sometimes|required',
                       'xilie_id' =>'sometimes|required',
                       'name' =>'sometimes|required|unique:product_goods',
                       'jiancheng' =>'sometimes|required',
                       'jianma' => 'sometimes|required',
                       'price.cost_price' =>'sometimes|required',
                       'price.taobao_price' =>'sometimes|required',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'jiagou_id' => 'sometimes|required',
                       'xilie_id' =>'sometimes|required',
                       'name' =>"sometimes|required|unique:product_goods,name,".$this->route('self_build_terrace')->id,  //排除自己的唯一
                       'jiancheng' =>'sometimes|required',
                       'jianma' => 'sometimes|required',
                       'price.cost_price' =>'sometimes|required',
                       'price.taobao_price' =>'sometimes|required',
                   ];
               }
               case 'GET':
               case 'DELETE':
               default:
               {
                   return [];
               };
           }

       }
    public function attributes()
    {
        return [
            'jiagou_id' => '架构类型',
            'xilie_id' =>'产品系列',
            'name' =>'产品名称',
            'jiancheng' =>'产品简称',
            'jianma' => '产品简码',
            'price.cost_price' =>'成本价格',
            'price.taobao_price' =>'淘宝价格',
        ];
    }
       public function messages()
       {
           return [
               'jiagou_id' => '架构类型必须选择',
               'xilie_id' =>'产品系列必须选择',
               'name' =>'产品名称不能为空',
               'jiancheng' =>'产品简称不能为空',
               'jianma' => '产品简码不能为空',
               'price.cost_price' =>'成本价格不能为空',
               'price.taobao_price' =>'淘宝价格不能为空',

           ];
       }
}