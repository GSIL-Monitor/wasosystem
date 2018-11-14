<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//会员公告管理Request
class NotificationRequest extends Request
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
                          'to_user.*'=>[
                              function ($attribute, $value, $fail) {
                                  $grades=$this->input('to_user');
                                  $user=$this->input('user');
                                  if (empty(array_filter($grades)) && empty($user)) {
                                      $fail('发送组必须选择至少一项');
                                  }
                              }
                          ],
                          'content'=>'required',
                          'title'=>'required'
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'grades.*'=>[
                           function ($attribute, $value, $fail) {
                               $grades=$this->input('to_user');
                               $user=$this->input('user');
                               if (empty(array_filter($grades)) && empty($user)) {
                                   $fail('发送组必须选择至少一项');
                               }
                           }
                       ],
                       'content'=>'required',
                       'title'=>'required'
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