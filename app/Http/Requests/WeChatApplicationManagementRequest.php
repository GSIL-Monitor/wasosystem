<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//微信应用管理Request
class WeChatApplicationManagementRequest extends Request
{
  public function attributes()
    {
        return [
            'agentId' => '应用ID',
            'name' => '应用名',
            'secret' => 'Secret',
            'identifying' => '应用标识',
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
                       'agentId'=>'required|unique:we_chat_application_managements',
                       'name'=>'required|unique:we_chat_application_managements',
                       'secret' => 'required|unique:we_chat_application_managements',
                       'identifying' => 'required|alpha|unique:we_chat_application_managements',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [
                       'agentId'=>'required|unique:we_chat_application_managements,agentId,'.$this->route('we_chat_application_management')->id,
                       'name'=>'required|unique:we_chat_application_managements,name,'.$this->route('we_chat_application_management')->id,
                       'secret' => 'required|unique:we_chat_application_managements,secret,'.$this->route('we_chat_application_management')->id,
                       'identifying' => 'required|alpha|unique:we_chat_application_managements,identifying,'.$this->route('we_chat_application_management')->id,
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