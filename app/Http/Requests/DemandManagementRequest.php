<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//需求管理Request
class DemandManagementRequest extends Request
{
    public function attributes()
    {
        return [
            'the_next_step_program'=>'下一步计划',
            'resoure' => '来源',
            'email' => '邮箱',
            'phone' => '手机',
            'nickname'=>'姓名',
            'qq' => 'QQ',
            'wechat' => '微信',
            'username' => '账号',
            'grade'=>'级别',
            'administrator'=>'管理员',
        ];
    }
   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                       'nickname'=>'sometimes|required',
                       'source'=>'sometimes|required',
                       'qq' => 'nullable|unique:users',
                       'email' => 'nullable|email|unique:users',
                       'phone' => 'nullable|unique:users',
                       'wechat' => 'nullable|unique:users',
                       'username' => 'nullable|unique:users',
                       'grade'=>'sometimes|required',
                       'administrator'=>'sometimes|required',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'the_next_step_program'=>'required',
                       'filtrate.*'=>[
                           function ($attribute, $value, $fail) {
                               $filtrate=$this->input('filtrate');
                               foreach ($filtrate as $item)
                               if ($item == 0) {
                                   $fail('咨询筛选必须选择');
                               }
                           }
                       ]
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

       public function messages()
       {
           return [
               'the_next_step_program.required'=>'下一步计划必填'

           ];
       }

}