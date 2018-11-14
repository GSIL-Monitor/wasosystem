<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//会员管理FormRequest
class UserRequest extends Request
{

    public function attributes()
    {
        return [
            'username' => '账号',
            'email' => '邮箱',
            'phone' => '账号',
            'password' => '邮箱',
            'nickname' => '姓名',
            'unit' => '单位简称',
            'grade' => '账户级别',
            'administrator' => '管理员',
            'tax_rate' => '会员税率',
            'message_type' => '信息接收',

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
                       'username' => 'required|unique:users,username',
                       'email' => 'required|email|unique:users,email',
                       'phone' => 'required|unique:users,phone',
                       'password' => 'required',
                       'nickname' => 'required',
                       'unit' => 'required',
                       'grade' => 'required',
                       'administrator' => 'required',
                       'tax_rate' => 'required',
                       'message_type' => 'required',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'username' => 'required|unique:users,username,'.$this->route('user')->id,
                       'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
                       'phone' => 'required|unique:users,phone,'.$this->route('user')->id,
                       'nickname' => 'required',
                       'unit' => 'required',
                       'grade' => 'required',
                       'administrator' => 'required',
                       'tax_rate' => 'required',
                       'message_type' => 'required',
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