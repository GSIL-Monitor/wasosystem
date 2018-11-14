<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//软硬一体化分类FormRequest
class IntegrationCategoryRequest extends Request
{


   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                       'name' => 'required|unique:integration_categories,name',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'name' => 'required|unique:integration_categories,name,'.$this->route('integration_category')->id,
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
               'name.required' => '分类名称不能为空！',
               'name.unique' => '分类名称已存在！',

           ];
       }
}