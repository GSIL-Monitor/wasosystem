<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//建议反馈Request
class FeedBackRequest extends Request
{
    public function attributes()
    {
        return [
            "name" =>'称呼',
            "title" =>'标题',
            "email" =>'邮箱',
            "phone" =>'电话',
            "content" =>'内容',
            "captcha" =>'验证码',
        ];
    }

    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST': {
                return [
                    "name" =>'required',
                    "title" =>'required|min:5|max:255',
                    "email" =>'required|email',
                    "content" =>'required|min:15|max:1000',
                    "captcha" =>'required|alpha_num|min:3|max:3|captcha',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH': {
                return [

                ];
            }
            case 'GET':
            case 'DELETE':
            default: {
                return [];
            };
        }

    }

    public function messages()
    {
        return [
            "name.required" =>'称呼必填！',
            "title.required" =>'标题必填！',
            "title.min" =>'标题至少5个字！',
            "title.max" =>'标题最多255个字！',
            "email.required" =>'邮箱必填！',
            "email.email" =>'邮箱格式不正确！',
            "content.required" =>'内容必填！',
            "content.min" =>'内容至少15个字！',
            "content.max" =>'内容最多1000个字！',
            "captcha.required" =>'验证码必填！',
            "captcha.alpha_num" =>'验证码只能包含字母数字字符！',
            "captcha.min" =>'验证码至少3位数！',
            "captcha.max" =>'验证码最多3位数！',
            "captcha.captcha" =>'验证码错误！',

        ];
    }

}