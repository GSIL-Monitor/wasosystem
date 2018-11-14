<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//软硬一体化FormRequest
class IntegrationRequest extends Request
{

   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                       'name' => 'required|unique:integrations,name',
                       'parent_id' => 'required',
                       'description' => 'required',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'name' => 'required|unique:integrations,name,'.$this->route('integration')->id,
                       'parent_id' => 'required',
                       'description' => 'required',
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
               'name.required' => '方案名称不能为空！',
               'name.unique' => '方案名称已存在！',
               'parent_id.required' => '方案分类不能为空！',
               'description.required' => '方案描述不能为空！',
           ];
       }
}