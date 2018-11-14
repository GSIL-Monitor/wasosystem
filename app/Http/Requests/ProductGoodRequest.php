<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductGoodRequest extends Request
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'jiagou_id' => 'required',
                    'xilie_id' =>'required',
                    'name' =>'required|unique:product_goods',
                    'jiancheng' =>'required',
                    'jianma' => 'required',
                    'price.cost_price' =>'required',
                    'price.taobao_price' =>'required',
                    'quality_time' =>'required',

                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'jiagou_id' => 'required',
                    'xilie_id' =>'required',
                    'name' =>"required|unique:product_goods,name,".$this->route('product_good')->id,  //排除自己的唯一
                    'jiancheng' =>'required',
                    'jianma' => 'required',
                    'price.cost_price' =>'required',
                    'price.taobao_price' =>'required',
                    'quality_time' =>'required',

                ];
            }
            // DELETE
            case 'GET':
            case 'DELETE':
            {
                return [


                ];
            }
        }
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
            'quality_time' =>'质保时间不能为空',
        ];
    }
}
