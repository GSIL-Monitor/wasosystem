<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteMachineRequest extends Request
{


   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                        'name'=>'sometimes|required|unique:complete_machines,name'
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'name'=>'sometimes|required|unique:complete_machines,name,'.$this->route('complete_machine')->id
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

                'name.required'=>'型号不能为空',
                'name.unique'=>'型号已存在'
           ];
       }
}