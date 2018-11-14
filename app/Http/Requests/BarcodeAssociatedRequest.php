<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//条码关联Request
class BarcodeAssociatedRequest extends Request
{
  public function attributes()
    {
        return [

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

}