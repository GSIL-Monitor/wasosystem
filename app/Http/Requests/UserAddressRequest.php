<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//会员物流地址管理Request
class UserAddressRequest extends Request
{


    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST': {
                return [
                    'info.number'=>[
                        'sometimes',
                        function ($attribute, $value, $fail) {
                            $number=$this->input('info')['number'];
                            $id=$this->input('info')['id'] ?? '';
                            $first=user()->user_address->filter(function ($item) use($id){
                                return $id ? $item['id'] !=$id : true;
                            })->firstWhere('number',$number);
                            if ($first) {
                                $fail('序号重复了！');
                            }
                        }
                    ]
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH': {
                return [
                    'info.number'=>[
                        'sometimes',
                        function ($attribute, $value, $fail) {
                            $number=$this->input('info')['number'];
                            $id=$this->input('info')['id'];
                            $first=user()->user_address->filter(function ($item) use($id){
                              return $item['id'] !=$id;
                             })->firstWhere('number',$number);
                            if ($first) {
                                $fail('序号重复了！');
                            }
                        }
                    ]
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


        ];
    }

    public function attributes()
    {
        return [


        ];
    }
}