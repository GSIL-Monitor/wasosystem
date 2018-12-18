<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AdminsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'roles.*'=>[
                        function($attribute, $value, $fail){
                            if(empty(array_filter(request('roles')))){
                                return    $fail('角色必须选择');
                            }
                            return ;
                        }
                    ],
                    'account' => 'required|numeric|unique:admins,account',
                    'name' => 'required|unique:admins,name',
                    'password' => 'required|min:6',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'roles.*'=>[
                        function($attribute, $value, $fail){
                            if(empty(array_filter(request('roles')))){
                                return    $fail('角色必须选择');
                            }
                            return ;
                        }
                    ],
                    'account' =>"required|unique:admins,account,".$this->route('admin')->id,  //排除自己的唯一
                    'name' =>"required|unique:admins,name,".$this->route('admin')->id,  //排除自己的唯一
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
            'account.required' => '工号不能为空！',
            'account.numeric' => '工号必须是数字！',
            'account.max' => '工号最大三位数',
            'account.min' => '工号最小三位数',
            'account.unique' => '工号已存在',
            'name.required' => '姓名不能为空！',
            'name.unique' => '姓名不能重复！',
            'password.required' => '密码不能为空！',
            'password.min' => '密码最小6位数',

        ];
    }
}
