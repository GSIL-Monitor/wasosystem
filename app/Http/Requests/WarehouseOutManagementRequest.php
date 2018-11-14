<?php

namespace App\Http\Requests;

use App\Models\Code;
use Illuminate\Foundation\Http\FormRequest;

//出库管理Request
class WarehouseOutManagementRequest extends Request
{
    public function attributes()
    {
        return [

        ];
    }

    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST': {
                return [

                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH': {
                return [
                    // 'serial_number'=>'unique:warehouse_out_managements',
                    'code' => [
                        function ($attribute, $value, $fail) {
                            $arr = [];
                            if ($this->input('out_number') == $this->input('finish_out_number')) {
                                foreach ($this->route('warehouse_out_management')->codes as $key => $item) {
                                    if ($item->inventory->new === 0) {
                                        $arr[$key] = "<span class='redWord'>" . $item->inventory->product_good->name . " 没有库存</span>";
                                    } else {
                                        if ($item->inventory->new < $item->product_good_num) {
                                            $arr[$key] = "<span class='redWord'>" . $item->inventory->product_good->name . " 库存不足</span>";
                                        }
                                    }
                                }
                            }
                            if (!empty($arr)) {
                                $fail(implode(PHP_EOL, $arr));
                            }
                            return;
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

}