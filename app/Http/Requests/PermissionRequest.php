<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PermissionRequest extends Request
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
                    'name'=>'required|unique:permissions|max:100',
                    'title'=>'required|unique:permissions',
                    'roles' =>'required',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'=>'required|max:100|unique:permissions,name,'.$this->route('permission')->id,
                    'title'=>'required|unique:permissions,title,'.$this->route('permission')->id,
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
            'name.required' => '权限不能为空！',
            'name.unique' => '权限已存在！',
            'name.max' => '权限最多100个字符！',
            'title.required' => '权限名不能为空！',
            'title.unique' => '权限名已存在！',
            'roles.required' => '角色必须选择！',
        ];
    }
}
