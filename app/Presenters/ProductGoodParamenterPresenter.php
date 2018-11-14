<?php

namespace App\Presenters;

use App\Models\OldGood;
use App\Models\OldOrder;
use App\Models\OldYingpan;
use App\Models\ProductGood;
use DB;
class ProductGoodParamenterPresenter
{

    public function raids(){
        $raid['raid1'] = array('R0' => 'R0', 'R1' => 'R1');
        $raid['raid2'] = array('R0' => 'R0', 'R5' => 'R5', 'R6' => 'R6');
        $raid['raid3']= array('R0' => 'R0', 'R5' => 'R5', 'R6' => 'R6', 'R10' => 'R10');
        $raid['raid4'] = array('R0' => 'R0', 'R5' => 'R5', 'R6' => 'R6', 'R10' => 'R10', 'R50' => 'R50', 'R60' => 'R60');
        return $raid;
    }
    public static function product_good($order_product_goods)
    {
        $arr=[];
        foreach ($order_product_goods as $key=>$product_good){

            $arr[$key]=$product_good->product_good ?? [];
            $arr[$key]=$product_good;
        }
        return collect($arr);
    }

    public static function get_good_parameter($good,$cpu_num=0)
    {

        $data=[];
        $data['title']=$good->product->title;
        $data['bianhao']=$good->product->bianhao;
        $data['num']=$good->pivot->product_good_num;
        $data['cpu_num']=$cpu_num;
        $data['user_product_id']=$good->pivot->id;
        $data['product_good_price']=$good->pivot->product_good_price;
        $data['product_good_id']=$good->id;
        $data['product_good_raid']=$good->pivot->product_good_raid;
        $data['name']=$good->jiancheng;
        $data['jianma']=$good->jianma;
        $data['framework']=$good->framework_name;
        $data['product_id']=$good->product_id;
       $data['list']=$good->product->good->pluck('jiancheng','id')->toArray();
//        dump($data);
        return $data;
    }
    //获取旧订单物料
    public function get_goods($order_product_goods)
    {
        $product_goods=self::product_good($order_product_goods);

        $TerraceOrMainboard=$this->CheckTerraceOrMainboard($product_goods);//平台或者主板

        $crate=$product_goods->firstWhere('product_id','=',20) ?? $product_goods->firstWhere('product_id','=',23);//机箱
        //判断有无阵列卡
        $raid=$product_goods->firstWhere('product_id','=',17) ?? '';
        $cpu=$product_goods->firstWhere('product_id','=',12) ?? '';
        $cpu_num=$cpu->pivot->product_good_num;
        //判断有平台或者
        $terraceNum=0;
        $arr=[];

        foreach ($product_goods as $key=>$product_good){
            $other=$this->checkProduct($product_good,$TerraceOrMainboard,$terraceNum);

            $pgd=array_merge(self::get_good_parameter($product_good,$cpu_num),$other);

            if($product_good->product_id == 23 ){//平台
                $arr[$key]=$pgd;
                $terraceNum=$product_good->pivot->product_good_num;//参数
            }else{ //主板
                $arr[$key]=$pgd;
                if($product_good->product_id == 12){
                    $arr[$key]=array_merge($arr[$key],$this->cpu($TerraceOrMainboard));
                    $cpu_num=$product_good->pivot->product_good_num;//参数
                    $c_hs = explode('/', $product_good->details['c_h']);
                    $c_h = (str_before($c_hs[0],'C') * $cpu_num)  . 'C/' . (str_before($c_hs[1],'H') * $cpu_num) . 'H';
                    $arr[$key]['parameter']="主频：" . $product_good->details['zhu_pin'] . "GHz；核心/线程：" . $c_h;
                    $node_number=$arr[$key]['jie_dian_shu_liang'];
                }
                if($product_good->product_id == 14){
                  $arr[$key]=array_merge($arr[$key],$this->memory($TerraceOrMainboard,$cpu_num,$node_number));//参数
                   $rong_liang= $product_good->details['rong_liang'];
                  $arr[$key]['parameter']="单条：" . $rong_liang . "G；总容量：" . ($rong_liang * $product_good->pivot->product_good_num) . "G";
                }
                if($product_good->product_id == 15){
                    $arr[$key]=array_merge($arr[$key],$this->hard_disk($TerraceOrMainboard,$raid,$crate));//参数
                    $arr[$key]['parameter']=$this->hard_disk_parameter($product_good);
                }
                if($product_good->product_id == 24){
                    $arr[$key]=array_merge($arr[$key],$this->other($TerraceOrMainboard,$raid));//参数
                }
            }
        }

        $a= collect($arr)->map(function ($item, $key) {
            return array_except($item,['product_good']);
        });
       return $a->toJson();
    }

    public function hard_disk_parameter($hard_disk)
    {
        $rl = $hard_disk->details['rong_liang'];
        $num= $hard_disk->pivot->product_good_num;
        $rong_liang = $rl * $hard_disk->pivot->product_good_num;
        $raid=$hard_disk->pivot->product_raid;
        if(str_contains($raid,['R1','R10'])){
            $available_capacity=$rl * ($num / 2);
        }else if(str_contains($raid,['R5'])){
            $available_capacity= $rl * ($num - 1);
        }else if(str_contains($raid,['R6','R50'])){
            $available_capacity=  $rl * ($num - 2);
        }else if(str_contains($raid,['R60'])){
            $available_capacity=  $rl * ($num - 4);
        }else{
            $available_capacity=$rong_liang;
        }

        if ($rong_liang >= 1000 || $available_capacity >= 1000) {
            $rong_liang = ($rong_liang / 1000) . 'T';
            $available_capacity= ($available_capacity / 1000) . 'T';
        } else {
            $rong_liang = $rong_liang . 'G';
            $available_capacity = $available_capacity . 'G';
        }
        return "容量：" . $rong_liang . "；可用容量：" . $available_capacity;
    }
//    public function get_goods1($order_product_goods,$order)
//    {
//
//        $product_goods=self::product_good($order_product_goods);
//        $TerraceOrMainboard=$this->CheckTerraceOrMainboard($product_goods);//平台或者主板
//        $crate=$product_goods->firstWhere('product_id','=',20) ?? '';//机箱
//        //判断有无阵列卡
//        $raid=$product_goods->firstWhere('product_id','=',17) ?? '';
//
//        //判断有平台或者
//        $terraceNum=0;
//        $arr=[];
//        foreach ($product_goods as $key=>$product_good){
//            if($product_good->product_id == 23 ){//平台
//                $arr[$key]['good']=$product_good;
//                $arr[$key]['good']['addiator']=$this->checkAdiator($product_good,$order);
//                $terraceNum=$product_good->pivot->product_good_num;//参数
//            }else{ //主板
//                $arr[$key]['good']=$product_good;
//                if($product_good->product_id == 12){
//                    $arr[$key]['good']['parameters']=$this->cpu($TerraceOrMainboard);//参数
//                    $cpu_num=$product_good->pivot->product_good_num;//参数
//                    $node_number=$arr[$key]['good']['parameters']['jie_dian_shu_liang'];
//                }
//                if($product_good->product_id == 14){
//                    $arr[$key]['good']['parameters']=$this->memory($TerraceOrMainboard,$cpu_num,$node_number);//参数
//                }
//                if($product_good->product_id == 15){
//                    $arr[$key]['good']['parameters']=$this->hard_disk($TerraceOrMainboard,$raid,$crate);//参数
//                }
//                if($product_good->product_id == 24){
//                    $arr[$key]['good']['parameters']=$this->other($TerraceOrMainboard,$raid);//参数
//                }
//            }
//            $arr[$key]['good']['checkProduct']=$this->checkProduct($product_good,$TerraceOrMainboard,$terraceNum);
//        }
//        dump($arr);
//        return $arr;
//    }
    //散热器 平台
    public function checkAdiator($product_good,$order)
    {
        $goods=$product_good->product_goods_self_build_terrace;//获取物料 散热器
        $PlatformRadiator['adiator']='';
        $PlatformRadiator['terrace_price']=$product_good->price[$order->user->grade] ?? 0; //平台价格
        if($goods) {
            foreach ($goods as $item) {
                if ($item['product_id'] == 22) {
                    $PlatformRadiator['adiator']='<input type="hidden" class="PlatformRadiator" value="'.$item->price[$order->user->grade].'">' ?? '';//散热器价格
                }
            }
        }
        return $PlatformRadiator;
    }
    public function checkProduct($product_good,$TerraceOrMainboard,$terraceNum){
        if(!str_contains($product_good->product_id, [15, 12,14])){ //排除 内存 cpu 硬盘
            $arr['max_num']=$this->pci($TerraceOrMainboard);
        }

        if(str_contains($product_good->product_id, [13,20,21,23]) || $product_good->product_id == 22 && $terraceNum== 0){

            $arr['del_class']='A_delNumn';
            $arr['add_class']='A_addNumn';
            $arr['add_symbol']='';
            $arr['del_symbol']='';
            $arr['del_button']=false;
            $arr['id']=$product_good->id;
            $arr['readonly']=false;
        }else{
            $arr['del_class']='A_delNum';
            $arr['add_class']='A_addNum';
            $arr['add_symbol']='+';
            $arr['del_symbol']='-';
            $arr['del_button']=true;
            $arr['id']=$product_good->id;
            $arr['readonly']=false;
        }
        if(str_contains($product_good->product_id, [12,13,14,20,21,23]) || $product_good->product_id == 22 && $terraceNum== 0){
            $arr['del_button']=false;
            $arr['readonly']=true;
        }else{
//            if($product_good->product_id ==15 && $product_good->pivot->product_good_num ==1){ //如果硬盘只有一个 不显示删除按钮
//            $arr['del_button']=false;
//           }else{
//                $arr['del_button']=true;
//            }
            $arr['readonly']='';
        }
       return $arr;
    }
    public function pci($TerraceOrMainboard)
    {
        $pci['pci']=$TerraceOrMainboard->details['pci'] ?? $TerraceOrMainboard->details['jie_dian_pci'] ?? 0;
        $pci['pci_x']=$TerraceOrMainboard->details['pci_x'] ?? $TerraceOrMainboard->details['jie_dian_pci_x'] ?? 0;
        $pci['pci_e_x1']=$TerraceOrMainboard->details['pci_e_x1'] ?? $TerraceOrMainboard->details['jie_dian_pci_e_x1'] ?? 0;
        $pci['pci_e_x4']=$TerraceOrMainboard->details['pci_e_x4'] ?? $TerraceOrMainboard->details['jie_dian_pci_e_x4'] ?? 0;
        $pci['pci_e_x8']=$TerraceOrMainboard->details['pci_e_x8'] ?? $TerraceOrMainboard->details['jie_dian_pci_e_x8'] ?? 0;
        $pci['pci_e_x16']=$TerraceOrMainboard->details['pci_e_x16'] ?? $TerraceOrMainboard->details['jie_dian_pci_e_x16'] ?? 0;
        $pcis=array_filter($pci);
        $sum=0;
        if($pcis){
            foreach ($pcis as $item){
                $sum+=explode(',',$item)[0]; //截取字符串的第一位数相加
            }
        }
       return $sum;

    }
    public function crate($crate)
    {
        $crates['3_5_cun_re_cha_ba_pan_wei']=$crate->details['3_5_cun_re_cha_ba_pan_wei'] ?? 0;
        $crates['2_5_cun_re_cha_ba_pan_wei']=$crate->details['2_5_cun_re_cha_ba_pan_wei'] ?? 0;
        $crates['nei_zhi_3_5_cun_ying_pan_wei']=$crate->details['nei_zhi_3_5_cun_ying_pan_wei'] ?? 0;
        $crates['nei_zhi_2_5_cun_ying_pan_wei']=$crate->details['nei_zhi_2_5_cun_ying_pan_wei'] ??  0;
        $crates['biao_zhun_guang_qu_wei']=$crate->details['biao_zhun_guang_qu_wei'] ??  0;
        $crates['chao_bao_guang_qu_wei']=$crate->details['chao_bao_guang_qu_wei'] ??  0;
        $crates_arr=array_filter($crates);
        $crates_sum=array_sum($crates_arr);
        return $crates_sum;

    }
    //判断是平台还是主板
    public function CheckTerraceOrMainboard($order_product_goods)
    {
        return $order_product_goods->first(function ($item, $key) {
            return $item->product_id == 23 || $item->product_id == 13;
        });
    }
    //CPU
    public function cpu($product_good){
         $jie_dian_shu_liang=$product_good->details['jie_dian_shu_liang'] ?? 1;
         $cpu_cha_cao_shu=$product_good->details['jie_dian_cpu_bing_cun_shu'] ?? $product_good->details['cpu_cha_cao_shu'];
//         $cpu['num']=$product_good->pivot->product_good_num;
         $cpu['max_num']=$jie_dian_shu_liang * $cpu_cha_cao_shu;

        $cpu['jie_dian_shu_liang']=$jie_dian_shu_liang;
        $where=[
          ['status->halt_production','=',0],
          ['status->show','=',1],
          ['product_id','=',12],
        ];
        $series_name=$product_good->details['zhi_chi_cpu_xi_lie'] ?? $product_good->details['jie_dian_cpu_xi_lie'];
        $cha_cao_lei_xing=$product_good->details['jie_dian_cpu_cha_cao'] ?? $product_good->details['cpu_cha_cao_lei_xing'];
        $gong_lv=$product_good->details['zui_gao_zhi_chi_cpu_gong_lv'] ?? $product_good->details['zui_gao_zhi_chi_cpu_gong_lv'];
        $list=$product_good
            ->where($where)
            ->SearchJson($cha_cao_lei_xing,'details->cha_cao_lei_xing')
            ->whereIn('series_name',$series_name)
            ->oldest('name')
            ->get();
        $filtered=json_filter($list,'zong_xian_su_du', '<=', $product_good->details['zhi_chi_qpi_fan_wei'] ?? $product_good->details['jie_dian_qpi_fan_wei']);
        $filtered=json_filter($filtered,'gong_lv', '<=',$gong_lv);
        $filtered=json_filter($filtered,'zui_da_pei_zhi', '>=', $product_good->details['cpu_cha_cao_shu'] ?? $product_good->details['jie_dian_cpu_bing_cun_shu'])->pluck('jiancheng','id')->toArray();


        $cpu['list']=!empty($filtered) ? $filtered :null ;

        return $cpu;
    }
    //内存
    public function memory($product_good,$cpu_num,$node_number){
                $jie_dian_nei_cun_cha_cao_shu=$product_good->details['jie_dian_nei_cun_cha_cao_shu'] ?? $product_good->details['nei_cun_cha_cao_shu'];
                $jie_dian_cpu_bing_cun_shu=$product_good->details['jie_dian_cpu_bing_cun_shu'] ?? $product_good->details['cpu_cha_cao_shu'];
                $nei_cun_shi_fou_jian_ban=$product_good->details['nei_cun_shi_fou_jian_ban'];

            if($nei_cun_shi_fou_jian_ban == 1){ //如果内存减半
                $memory['max_num']=(($jie_dian_nei_cun_cha_cao_shu/$jie_dian_cpu_bing_cun_shu)*$cpu_num)*$node_number;
            }else{//如果内存不减半
                $memory['max_num']=$jie_dian_nei_cun_cha_cao_shu * $node_number;
            }

        $memory['html_hidden']="<input type='hidden' data-jie_dian_nei_cun_cha_cao_shu='".$jie_dian_nei_cun_cha_cao_shu."'
                                data-jie_dian_cpu_bing_cun_shu='".$jie_dian_cpu_bing_cun_shu."'
                                data-nei_cun_shi_fou_jian_ban='".$nei_cun_shi_fou_jian_ban."'
                                value='".$node_number."' class='memory'/>";

        $rong_liang=$product_good->details['nei_cun_dan_tiao_zui_da'] ?? $product_good->details['dan_nei_cun_zhi_chi_zui_da'];//容量
        $nei_cun_lei_xing=$product_good->details['nei_cun_lei_xing'] ?? $product_good->details['jie_dian_nei_cun_lei_xing'];//内存类型
        $where=[
           ['status->halt_production',0],['product_id',14],
        ];
        $list=$product_good
           ->where($where)
            ->SearchJson($nei_cun_lei_xing,'details->lei_xing')
            ->SearchJson($product_good->details['nei_cun_pin_lv_fan_wei'],'details->gong_zuo_pin_lv')
            ->oldest('name')
            ->get();
        $filtered=json_filter($list,'rong_liang', '<=', $rong_liang)->pluck('jiancheng','id')->toArray();
        //筛选
      $memory['list']=!empty( $filtered) ? $filtered :null ;
      return  $memory;
    }
    //硬盘
    public function hard_disk($product_good,$raid,$crate){


       $hard_disk['max_num']=$this->crate($crate);

        $raidIds=$raid ? $raid->id : '';
        $self_build_terrace_raid='';
        $raidListRaid=[];
        if($product_good->product_id == 23){
            $goods=$product_good->product_goods_self_build_terrace;
            if($goods){
             foreach ($goods as $item)   {
                 if($item['product_id'] == 17){
                     $self_build_terrace_raid[$item->id]=$item->id;
                 }
             }
            }
            if($self_build_terrace_raid){
                $raidIds=$raidIds.','.$self_build_terrace_raid ?? '';
            }
        }
        if($raidIds){
          $raidList=ProductGood::whereIn('id',array_wrap($raidIds))->pluck('details','id');
          foreach ($raidList as $key=>$item){
              $raidListRaid[$key]=$item['zhi_chi_ying_pan_lei_xing'];
          }
        }
        $raidListRaid['ban_zai_ying_pan_lei_xing_1']=array_filter($product_good->details['ban_zai_ying_pan_lei_xing_1'] ?? $product_good->details['jie_dian_ying_pan_lei_xing_1'] ?? []);
        $raidListRaid['ban_zai_ying_pan_lei_xing_2']=array_filter($product_good->details['ban_zai_ying_pan_lei_xing_2'] ?? $product_good->details['jie_dian_ying_pan_lei_xing_2'] ?? []);
        $raidListRaid['ban_zai_ying_pan_lei_xing_3']=array_filter($product_good->details['ban_zai_ying_pan_lei_xing_3'] ?? $product_good->details['jie_dian_ying_pan_lei_xing_3'] ?? []) ;
       $hard_disk_type=array_unique(array_collapse($raidListRaid));
        $where=[
            ['status->halt_production','=',0],['product_id','=',15],
        ];
        $list=$product_good
            ->where($where)
            ->SearchJson($hard_disk_type,'details->jie_kou_lei_xing')
            ->oldest('name')
            ->pluck('jiancheng','id')->toArray();

//        //筛选
        $hard_disk['list']=!empty( $list) ? $list :null ;
        return  $hard_disk;
    }
    //其他
    public function other($product_good){

        $where=[
            ['status->halt_production','=',0],['product_id','=',24],
        ];
        $list=$product_good
            ->where($where)
            ->oldest('name')
            ->pluck('jiancheng','id')->toArray();
        //筛选
        $memory['list']=!empty( $list) ? $list :null ;
        return  $memory;
    }
    //判断价格浮动
    public function check_peice_float($new_price,$old_price)
    {
//        dump($new_price.'=>'.$old_price);
        if($new_price > $old_price){
            return 'UP';
        }elseif ($new_price < $old_price){
            return 'DOWN';
        }else{
            return 'HOLD';
        }
    }

}