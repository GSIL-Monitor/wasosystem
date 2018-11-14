<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends Request
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
                    'bianhao' => 'required|max:1|unique:products',
                    'title' =>'required|unique:products',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'bianhao' => 'required|max:1|unique:products,bianhao,'.$this->route('product')->id,
                    'title' =>'required|unique:products,title,'.$this->route('product')->id,
                ];
            }
            // DELETE
            case 'GET':
            case 'DELETE':
            {
                return [


                ];
            }
        }
    }
    public function messages()
    {
        return [
            'bianhao.max' => '配件编号最多一个字母！',
            'bianhao.required' => '配件编号不能为空！',
            'bianhao.unique' => '配件编号不能重复！',
            'title.required' => '配件名称不能为空！',
            'title.unique' => '配件名称不能重复！',
        ];
    }
}
