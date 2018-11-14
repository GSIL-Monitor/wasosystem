<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//会员状态管理FormRequest
class MemberStatusRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'name' => 'required|unique:member_statuses,name',
                    'identifying' => 'required|unique:member_statuses,identifying',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:member_statuses,name,'.$this->route('member_status')->id,
                    'identifying' => 'required|unique:member_statuses,identifying,'.$this->route('member_status')->id,
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

            'name.required' => '级别名称不能为空！',
            'name.unique' => '级别名称已存在！',
            'identifying.required' => '级别标识不能为空！',
            'identifying.unique' => '级别标识已存在！',
        ];
    }
}