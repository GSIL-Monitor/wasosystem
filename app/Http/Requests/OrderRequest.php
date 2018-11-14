<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//订单管理Request
class OrderRequest extends Request
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
                       'order_status'=>'required',
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