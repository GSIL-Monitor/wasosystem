<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class RoleRequest extends Request
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
                    'name'=>'required|unique:roles|max:100',
                    'title'=>'required|unique:roles',
                    'permissions' =>'required',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'=>'required|max:100|unique:roles,name,'.$this->route('role')->id,
                    'title'=>'required|unique:roles,title,'.$this->route('role')->id,
                    'permissions' =>'required',
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
            'name.required' => '角色不能为空！',
            'name.unique' => '角色已存在！',
            'name.max' => '角色最多100个字符！',
            'title.required' => '角色名不能为空！',
            'title.unique' => '角色名已存在！',
            'permissions.required' => '权限必须选择！',
        ];
    }
}
