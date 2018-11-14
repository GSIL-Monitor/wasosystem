<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class MenusRequest extends Request
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
                    'cats' => 'required',
                    'name' => 'required|unique:menus,name',
                    'slug' => 'required|unique:menus,slug',
                    'url' => 'required|unique:menus,url',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'cats' => 'required',
                    'name' => 'required|unique:menus,name,'.$this->route('menu')->id,
                    'slug' => 'required|unique:menus,slug,'.$this->route('menu')->id,
                    'url' => 'required|unique:menus,url,'.$this->route('menu')->id,
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
            'cats.required' => '栏目不能为空！',
            'name.required' => '菜单名称不能为空！',
            'name.unique' => '菜单名称已存在！',
            'slug.required' => '菜单简称不能为空！',
            'slug.unique' => '菜单简称已存在！',
            'url.required' => '菜单链接不能为空！',
            'url.unique' => '菜单链接已存在！',
        ];
    }
}
