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
                        'name'=>'sometimes|required',
                        'info.number'=>[
                           'sometimes',
                           function ($attribute, $value, $fail) {
                               $number=$this->input('info')['number'];
                               $id=$this->input('info')['id'] ?? '';
                               $first=user()->user_company->filter(function ($item) use($id){
                                   return $id ? $item['id'] !=$id : true;
                               })->firstWhere('number',$number);
                               if ($first) {
                                   $fail('序号重复了！');
                               }
                           }
                        ]
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