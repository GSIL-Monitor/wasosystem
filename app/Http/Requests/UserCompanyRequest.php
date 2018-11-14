<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//会员单位管理Request
class UserCompanyRequest extends Request
{

   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                        'name'=>'required'
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

       public function messages()
       {
           return [


           ];
       }
        public function attributes()
              {
                  return [


                  ];
              }
}