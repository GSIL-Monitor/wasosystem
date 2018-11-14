<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//客情管理Request
class VisitorDetailRequest extends Request
{

    public function attributes()
    {
        return [
            'resoure' => '来源',
            'email' => '邮箱',
            'phone' => '手机',
            'nickname' => '姓名',
            'qq' => 'QQ',
            'phone' => '手机',
            'wechat' => '微信',
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
                    'nickname'=>'required',
                    'source'=>'required',
                    'qq' => 'nullable|unique:users',
                    'email' => 'nullable|email|unique:users',
                    'phone' => 'nullable|unique:users',
                    'wechat' => 'nullable|unique:users',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nickname'=>'required',
                    'source'=>'required',
                    'qq' => 'nullable|unique:users,qq,'.$this->route('visitor_detail')->user_id,
                    'email' => 'nullable|email|unique:users,email,'.$this->route('visitor_detail')->user_id,
                    'phone' => 'nullable|unique:users,phone,'.$this->route('visitor_detail')->user_id,
                    'wechat' => 'nullable|unique:users,wechat,'.$this->route('visitor_detail')->user_id,
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