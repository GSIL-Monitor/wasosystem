<?php

namespace App\Services;


use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\ProductGood;
use function foo\func;
use Overtrue\Pinyin\Pinyin;

class ModelSelectionServices
{
    public function cpu()
    {
        $index = request()->input('order') ?? 'index,desc';
        $order_seach = str_before($index, ',');
        $order= str_after($index, ',');
        $cpu = ProductGood::where([
            ['product_id', 12], ['status->show', 1], ['status->halt_production', 0],
        ])->whereNotIn('jiagou_id', [2, 207, 210, 594, 607])->get();
        $arr = array();
        $max = array();
        foreach ($cpu as $item) {
            $thread = substr(str_before($item->details['c_h'], '/'), 0, -1);//截取线程数
            $zhu_pin=floatval($item->details['zhu_pin']);
            $index = (($zhu_pin * $thread) / $item->price['cost_price']) * 100;
            $item['index'] = $index;
            $item['zhu_pin'] = $zhu_pin;
            $item['thread'] = $thread;
            $max[$item['id']] = $index;
            $arr[] = $item;
        }
        if ($order == 'desc') {
            $cpu_lists = collect($arr)->sortByDesc($order_seach);
        } else {
            $cpu_lists = collect($arr)->sortBy($order_seach);
        }
        return ['cpu_lists' => $cpu_lists, 'top' => iconv('UTF-8', 'GBK', array_search(max($max), $max))];
    }

    public function memory()
    {
        $index = request()->input('order') ?? 'index,desc';
        $order_seach = str_before($index, ',');
        $order= str_after($index, ',');
        $memory = ProductGood::where([
            ['product_id', 14], ['status->show', 1], ['status->halt_production', 0],
        ])->whereNotIn('jiagou_id', [207, 298, 594, 207])->get();
        $arr = array();
        $max = array();
        $recc=0;
        foreach ($memory as $item) {
            if($item->details['shi_fou_ecc_gong_neng'] == 1 && $item->details['shi_fou_reg_gong_neng'] == 1){
                $recc=0.2;
            }
            $type=substr($item->details['lei_xing'],-1,1);
            $index = ((($item->details['rong_liang'] / $item->price['cost_price']) * 200 ) + ($item->details['gong_zuo_pin_lv'] / 10000)) + $recc;
            $item['index'] = $index;
            $item['type'] = $type;
            $item['recc'] = $recc;
            $item['pin_lv'] = $item->details['gong_zuo_pin_lv'];
            $item['rong_liang'] = $item->details['rong_liang'];
            $max[$item['id']] = $index;
            $arr[] = $item;
        }
        if ($order == 'desc') {
            $memory_lists = collect($arr)->sortByDesc($order_seach);
        } else {
            $memory_lists = collect($arr)->sortBy($order_seach);
        }
        return ['memory_lists' => $memory_lists, 'top' => iconv('UTF-8', 'GBK', array_search(max($max), $max))];
    }

    public function hard_disk()
    {
        $index = request()->input('order') ?? 'index,desc';
        $order_seach = str_before($index, ',');
        $order= str_after($index, ',');
        $hard_disk= ProductGood::where([
            ['product_id', 15], ['status->show', 1], ['status->halt_production', 0],
        ])->where(function($ruery){
            $ruery->orWhere('xilie_id',42)
                ->orWhere('xilie_id',43)
                ->orWhere('xilie_id',45)
                ->orWhere('xilie_id',283)
                ->orWhere('xilie_id',285)
                ->orWhere('xilie_id',577)
                ->orWhere('xilie_id',598);
        })->get();
        $arr = array();
        $max = array();
        foreach ($hard_disk as $item) {
            $index =$item->details['rong_liang'] / $item->price['cost_price'];
            $item['index'] = $index;
            $item['jie_kou_su_lv'] = $item->details['jie_kou_su_lv'];
            $item['rong_liang'] = $item->details['rong_liang'];
            $max[$item['id']] = $index;
            $arr[] = $item;
  }
        if ($order == 'desc') {
            $hard_disk_lists = collect($arr)->sortByDesc($order_seach);
        } else {
            $hard_disk_lists = collect($arr)->sortBy($order_seach);
        }
       return ['hard_disk_lists' => $hard_disk_lists, 'top' => iconv('UTF-8', 'GBK', array_search(max($max), $max))];
    }

    public function server_selection($parent_id=1,$product=null)
    {
        if($product){
            return CompleteMachineFrameworks::with('child','good.complete_machine_product_goods')->whereCategory('filtrate')->defaultOrder()->descendantsAndSelf($parent_id)->toTree();
        }else{
            return CompleteMachineFrameworks::with('child')->whereCategory('filtrate')->defaultOrder()->descendantsOf($parent_id)->toTree();
        }

    }
    public function designer_selection($parent_id=2)
    {
        return CompleteMachineFrameworks::with('child')->whereCategory('filtrate')->defaultOrder()->descendantsOf($parent_id)->toTree();
    }

    public function designer_filter()
    {

        $filter=json_decode(request()->input('filters'),true);
        $designer=CompleteMachine::with('complete_machine_product_goods')->where('status->show',1)->whereParentId(2)->get();

        $filters=$designer->filter(function ($item) use($filter){
            $arr=[];
            foreach ($item->application as $value){
                    if(in_array($value,$filter)){
                        $arr[$value]=$value;
                    }
            }
         return count($arr) == count($filter);  //判断是否相同数据
        });
        return $filters;
    }
}

?>