<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//需求管理筛选Request
class DemandFiltrateRequest extends Request
{

   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [

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