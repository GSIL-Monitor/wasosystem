<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//服务管理Request
class ServiceRequest extends Request
{

   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                            'product_goods.*'=>[
                                function ($attribute, $value, $fail) {
                                    if ($this->input('quality_assurance_model') == 'parts') {
                                    if (empty(array_filter($this->input('product_goods')))) {
                                        $fail('至少选择一个配件');
                                    }
                                    }
                                    return;
                                }
                            ],
                       'error_description'=>'required'
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [

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
            'error_description'=>'故障描述'
        ];
    }
       public function messages()
       {
           return [


           ];
       }

}