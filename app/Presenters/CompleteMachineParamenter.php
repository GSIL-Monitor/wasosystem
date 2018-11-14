<?php

namespace App\Presenters;

use App\Exports\BaseSheetExport;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Services\CompleteMachineServices;

class CompleteMachineParamenter
{
    public function material_details($complete_machines)
    {
        $arr=[];
        foreach ($complete_machines as $complete_machine){
          $arr=$this->material_detail($complete_machine,'all',$arr);
        }
        return $arr;

    }
    public function material_detail($complete_machine,$flag='all',$arr=[])
    {

            $complete_machine_details=BaseSheetExport::complete_machine_details($complete_machine,$flag)['complete_machine_detailed'];
            foreach ($complete_machine_details as $key=>$item){
                $arr[$key][$complete_machine->id]=$item;
            }
        return $arr;
    }
    public function complete_machine($complete_machine)
    {
        $filtered = $complete_machine->filter(function ($item, $key) {
            return !str_contains(implode(' ', $item->jiagou), ['存储服务器', 'ND8000系列', 'ND9000系列', 'ND7000系列', '办公电脑系列', '图形工作站']);
        });
        $result = $filtered->groupBy([
            function ($item) {
                return $item['jiagou'];
            },
        ], $preserveKeys = true);
        return $result->sortKeys();
    }

    public function storage($complete_machine)
    {

        $filtered = $complete_machine->filter(function ($item, $key) {
            return str_contains(implode(' ', $item->jiagou), ['存储服务器']);
        });
        $result = $filtered->groupBy([
            function ($item) {
                return $item['additional_arguments']['mm'];
            },
        ], $preserveKeys = true);
        return $result->sortKeys();
    }

    public function graphic_workstation_designer_computer($complete_machine)
    {
        $filtered = $complete_machine->filter(function ($item, $key) {
            return str_contains(implode(' ', $item->jiagou), ['ND8000系列', 'ND9000系列', 'ND7000系列', '办公电脑系列', '图形工作站']);
        });
        $result = $filtered->groupBy([
            function ($item) {
                return $item['jiagou'];
            },
        ], $preserveKeys = true);

        return $result->sortKeys();
    }

    public function drives()
    {
        
    }

    public function complete_machine_category()
    {
        return CompleteMachineFrameworks::whereCategory('framework')->whereNotNull('parent_id')->pluck('id', 'name')->toArray();
    }

    public function server_filter($servers)
    {
        $filter['类型'] = $this->server_type($servers);
        $filter['价格'] = $this->server_price($servers);
        $filter['处理器'] = $this->server_filters($servers,'product_id','12','series_name');
        $filter['内存类型'] = $this->server_filters($servers,'product_id','14',['details','lei_xing']);
        $filter['内存容量'] = $this->server_filters($servers,'product_id','14',['details','rong_liang']);
        $filter['硬盘容量'] = $this->server_filters($servers,'product_id','15',['details','rong_liang']);
        return $filter;
    }
    public function designer_filter($servers)
    {
        $filter['价格'] = $this->server_price($servers);
        $filter['处理器'] = $this->server_filters($servers,'product_id','12','series_name');
        $filter['内存类型'] = $this->server_filters($servers,'product_id','14',['details','lei_xing']);
        $filter['内存容量'] = $this->server_filters($servers,'product_id','14',['details','rong_liang']);
        $filter['硬盘容量'] = $this->server_filters($servers,'product_id','15',['details','rong_liang']);
        return $filter;
    }

    public function server_filters($servers,$conditionKey,$conditionVal,$order_name)

    {
        $filter = collect([]);
        foreach ($servers as $server) {
            $cpu = $server->complete_machine_product_goods->firstWhere($conditionKey,$conditionVal);
            if ($cpu) {
                $filter->push($cpu);
            }
        }
        $result = $filter->groupBy([
            function ($item) use($order_name) {
               if(is_array($order_name)){
                   return $item[$order_name[0]][$order_name[1]];
               }else{
                   return $item[$order_name];
               }
            },
        ], $preserveKeys = true);
        return $result->sortKeys();
    }


    public function server_type($servers)
    {
        $result = $servers->groupBy([
            function ($item) {
                return $item['application'];
            },
        ], $preserveKeys = true);
        return $result->sortKeys();
    }

    //整机价格
    public function server_price($servers)
    {
        foreach ($servers as $server) {
            $server_price = $server->price[user()->grades->identifying ?? 'retail_price'];
            if ($server_price >= 1 && $server_price <= 5999) {
                $price[1] = "5999以下";
            }
            if ($server_price >= 6000 && $server_price <= 9999) {
                $price[2] = "6000元-9999元";
            }
            if ($server_price >= 10000 && $server_price <= 19999) {
                $price[3] = "10000元-19999元";
            }
            if ($server_price >= 20000 && $server_price <= 39999) {
                $price[4] = "20000元-39999元";
            }
            if ($server_price >= 40000 && $server_price <= 999999) {
                $price[5] = "40000元以上";
            }
        }

        ksort($price);
        return $price;
    }
}