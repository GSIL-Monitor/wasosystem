<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ProductParamenterRequest extends Request
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
                    'name' => 'required',
                    'type' =>'sometimes|required',
                    'child_pid' =>'sometimes|required',
                    'child_id' =>'sometimes|required',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'type' =>'sometimes|required',
                    'child_pid' =>'sometimes|required',
                    'child_id' =>'sometimes|required',
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
            'name.required' => '名称不能为空！',
            'type.required' => '显示类型必须选择！',
            'child_pid.required' => '产品必须选择！',
            'child_id.required' => '产品专有项必须选择！',
        ];
    }
}
