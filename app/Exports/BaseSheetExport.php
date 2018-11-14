<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BaseSheetExport
{
    static  $pcis=['pci'=>'PCI','pci_x'=>'PCI-X','pci_e_x1'=>'PCI-E X1','pci_e_x4'=>'PCI-E X4','pci_e_x8'=>'PCI-E X8','pci_e_x16'=>'PCI-E X16'];
    static  $raid_types=['ban_zai_ying_pan_lei_xing_1','ban_zai_ying_pan_lei_xing_2','ban_zai_ying_pan_lei_xing_3'];
    static  $raids=['zhi_chi_raid_mo_shi_1','zhi_chi_raid_mo_shi_2','zhi_chi_raid_mo_shi_3'];

    static  $disk_position=['3_5_cun_re_cha_ba_pan_wei'=>'个3.5寸热插拔位','2_5_cun_re_cha_ba_pan_wei'=>'个2.5寸热插拔位','nei_zhi_3_5_cun_ying_pan_wei'=>'个3.5寸硬盘位','nei_zhi_2_5_cun_ying_pan_wei'=>'个2.5寸硬盘位'];
    static  $terrace_disk_position=['dan_jie_dian_biao_zhun_ying_pan_shu'=>'个单节点标准硬盘位','dan_jie_dian_2_5_cun_ying_pan_shu'=>'个单节点2.5寸硬盘位','3_5_cun_re_cha_ba_pan_wei'=>'个3.5寸热插拔盘位','2_5_cun_re_cha_ba_pan_wei'=>'个2.5寸热插拔盘位'];
    static  $terrace_raid_types=['jie_dian_ying_pan_lei_xing_1','jie_dian_ying_pan_lei_xing_2','jie_dian_ying_pan_lei_xing_3'];
    static $terrace_pcis=['jie_dian_pci'=>'PCI','jie_dian_pci_x'=>'PCI-X','jie_dian_pci_e_x1'=>'PCI-E X1','jie_dian_pci_e_x4'=>'PCI-E X4','jie_dian_pci_e_x8'=>'PCI-E X8','jie_dian_pci_e_x16'=>'PCI-E X16'];
    //公用的一些信息
    public static function commInfo($order)
    {
        $arr['invoice'] =$order->invoice_type == 'no_invoice' ? '不含发票' : '含16%增值税发票';
        $arr['invoice_name'] =$order->invoice_type == 'no_invoice' ? '未税' : '含税';
        $default_company=$order->user->user_company()->whereDefault(1)->first();
        $arr['company']=!empty($order->invoice_info) ? $order->company->name  : $default_company->name ?? $order->user->unit;
        return collect($arr);
    }
    //设置图片
    public static function setImages($sheet,$path,$coordinate,$OffsetX,$OffsetY)
    {
        //插入图片
        $image=new Drawing();
        $image->setPath($path);
        $image->setCoordinates($coordinate);
        $image->setOffsetX($OffsetX);
        $image->setOffsetY($OffsetY);
//        $image->setRotation(5);
        $image->getShadow()->setVisible(true);
        $image->getShadow()->setDirection(50);
        $image->setWorksheet($sheet);
    }
    //设置二维码
    public static function QrCode($sheet,$order,$coordinate,$OffsetX,$OffsetY)
    {
        $path=public_path('/storage/QrCode/'.$order->serial_number.'.png');
        QrCode::format('png')->errorCorrection('H')->size(100)->generate($order->code,$path);//生成二维码
        self::setImages($sheet,$path,$coordinate,$OffsetX,$OffsetY);
    }

    //整机物料详情
    public static function complete_machine_details($complete_machine,$flag='all')
    {

        $order_product_goods=$complete_machine->complete_machine_product_goods;
        $arr=[];$hard_disk=[];$display_cards=[];$raids=[];$network_cards=[];$personality_card=[];$audio_card=[];$others=[];$other=[];
        $terrace=false;
        foreach ($order_product_goods as $item){
            if($item->product_id == 23){
                $arr['terrace']=self::terrace($item);
                $terrace=true;
            }
            if($item->product_id == 12){
                $arr['cpu']=self::cpu($item);
            }
            if($item->product_id == 13){
                $arr['mainboard']=self::mainboard($item);
            }
            if($item->product_id == 14){
                $arr['memory']=self::memory($item);
            }
            if($item->product_id == 15){
                $arr['hard_disk']=self::hard_disk($item);
                $hard_disk[]=$arr['hard_disk']->str_name;
                $arr['hard_disk']['str_name']=$hard_disk;
            }
            if($item->product_id == 16){
                $arr['display_card']=self::display_card($item);
                $display_cards[]=$arr['display_card']->str_name;
                $arr['display_card']['str_name']=$display_cards;
            }
            if($item->product_id == 17){
                $arr['raid']=self::raid($item);
                $raids[]=$arr['raid']->str_name;
                $arr['raid']['str_name']=$raids;
            }
            if($item->product_id == 18){
                $arr['network_card']=self::network_card($item);
                $network_cards[]=$arr['network_card']->str_name;
                $arr['network_card']['str_name']=$network_cards;
            }
            if($item->product_id == 19){
                $arr['personality_card']=self::personality_card($item);
                $personality_card[]=$arr['personality_card']->personality;
                $audio_card[]=$arr['personality_card']->audio_card;
                $arr['network_card']['str_name']=$personality_card;

            }
            if($item->product_id == 20){
                $arr['crate']=self::crate($item);
                if($item->details['kun_bang_dian_yuan']){
                    $arr['power']=$item->find($item->details['kun_bang_dian_yuan']);
                }
            }
            if($item->product_id == 21){
                $arr['power']=self::power($item);
            }
            if($item->product_id == 22){
                $arr['radiator']=self::radiator($item);
            }
            if($item->product_id == 24){

                $arr['other']=self::other($item);
                if($item->xilie_id == 134){
                    $other['CD-ROM']=$arr['other']->str_name;
                }else if($item->xilie_id == 136){
                    $other['键盘鼠标']=$arr['other']->str_name;
                }else if($item->xilie_id == 384){
                    $other['导轨']=$arr['other']->str_name;
                }else{
                    $others[]=$arr['other']->str_name;
                }
                $arr['other']['str_name']=$others;
            }

        }



        if($terrace){
            //平台整机明细表
            $str['complete_machine_detailed']=self::terrace_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other,$flag);
            $str['signature_form']=self::terrace_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
        }else{
            $str['signature_form']=self::mainboard_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
            //主板整机明细表
            $str['complete_machine_detailed']=self::mainboard_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other,$flag);
        }




        return $str;
    }
    //物料详情
    public static function material_details($order)
    {
        $order_product_goods=$order->order_product_goods ?? $order->common_equipment_product_goods;
        $arr=[];$hard_disk=[];$display_cards=[];$raids=[];$network_cards=[];$personality_card=[];$audio_card=[];$others=[];$other=[];
        $terrace=false;
       foreach ($order_product_goods as $item){
             $item->pivot->product_good_num=$item->pivot->product_good_num / $order->num;
           if($item->product_id == 23){
               $arr['terrace']=self::terrace($item);
               $terrace=true;
           }
            if($item->product_id == 12){
                $arr['cpu']=self::cpu($item);
            }
           if($item->product_id == 13){
               $arr['mainboard']=self::mainboard($item);
           }
           if($item->product_id == 14){
               $arr['memory']=self::memory($item);
           }
           if($item->product_id == 15){
               $arr['hard_disk']=self::hard_disk($item);
               $hard_disk[]=$arr['hard_disk']->str_name;
               $arr['hard_disk']['str_name']=$hard_disk;
           }
           if($item->product_id == 16){
               $arr['display_card']=self::display_card($item);
               $display_cards[]=$arr['display_card']->str_name;
               $arr['display_card']['str_name']=$display_cards;
           }
           if($item->product_id == 17){
               $arr['raid']=self::raid($item);
               $raids[]=$arr['raid']->str_name;
               $arr['raid']['str_name']=$raids;
           }
           if($item->product_id == 18){
               $arr['network_card']=self::network_card($item);
               $network_cards[]=$arr['network_card']->str_name;
               $arr['network_card']['str_name']=$network_cards;
           }
           if($item->product_id == 19){
               $arr['personality_card']=self::personality_card($item);
               $personality_card[]=$arr['personality_card']->personality;
               $audio_card[]=$arr['personality_card']->audio_card;
               $arr['network_card']['str_name']=$personality_card;

           }
           if($item->product_id == 20){
               $arr['crate']=self::crate($item);
               if($item->details['kun_bang_dian_yuan']){
                   $arr['power']=$item->find($item->details['kun_bang_dian_yuan']);
               }
           }
           if($item->product_id == 21){
               $arr['power']=self::power($item);
           }
           if($item->product_id == 22){
               $arr['radiator']=self::radiator($item);
           }
           if($item->product_id == 24){

               $arr['other']=self::other($item);
               if($item->xilie_id == 134){
                   $other['CD-ROM']=$arr['other']->str_name;
               }else if($item->xilie_id == 136){
                   $other['键盘鼠标']=$arr['other']->str_name;
               }else if($item->xilie_id == 384){
                   $other['导轨']=$arr['other']->str_name;
               }else{
                   $others[]=$arr['other']->str_name;
               }
               $arr['other']['str_name']=$others;
           }

       }



    if($terrace){
        //平台整机明细表
        $str['complete_machine_detailed']=self::terrace_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
        $str['signature_form']=self::terrace_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
    }else{
        $str['signature_form']=self::mainboard_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
        //主板整机明细表
        $str['complete_machine_detailed']=self::mainboard_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other);
    }




        return $str;
    }
    //平台整机明细表
    public static  function  terrace_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other,$falg=null)
    {

        $str['处理器']= '标配'. $arr['cpu']->pivot->product_good_num.'颗'.$arr['cpu']->jiancheng.'处理器，最大支持'.($arr['terrace']->details['jie_dian_shu_liang'] * $arr['terrace']->details['jie_dian_cpu_bing_cun_shu']).'颗Socket  LGA'.implode('/',$arr['terrace']->details['jie_dian_cpu_cha_cao']).' '.$arr['cpu']->framework_name.' '. $arr['terrace']->zhi_chi_cpu_xi_lie.'处理器，'. '最高QPI '.$arr['terrace']->details['jie_dian_qpi_fan_wei'].' GT/s，支持功耗'.$arr['terrace']->details['zui_gao_zhi_chi_cpu_gong_lv'].'W';
        $str['芯片组'] = '配置采用'.$arr['terrace']->details['jie_dian_xin_pian_zu'];
        $str['内存'] = $arr['terrace']->details['jie_dian_nei_cun_cha_cao_shu'].'个内存插槽（'.$arr['terrace']->dimm.'-DIMM/每个CPU）适用'.$arr['terrace']->nei_cun_lei_xing.' '.$arr['memory']->details['gong_zuo_dian_ya'].'V， '.$arr['terrace']->nei_cun_pin_lv_fan_wei.'范围， 单条最大'.$arr['terrace']->details['dan_nei_cun_zhi_chi_zui_da'].'G，'.'最高'.$arr['terrace']->capacity.'GB，'.$arr['memory']->str_name;
        $str['硬盘'] = '支持'.$arr['terrace']->disk_position.'，标配'.implode('，',$hard_disk).'支持'.$arr['terrace']->types.' 硬盘类型';
        $raid=!empty($raids)?implode('，',$raids).'，SATA/SAS/SSD可混用，支持'.implode(',',$arr['raid']->details['raid_mo_shi']).'阵列功能':'可选硬Raid卡带缓存';
        $str['阵列功能'] = '支持'.$arr['terrace']->types.$arr['terrace']->raids.'，'.$raid;
        $str['图形显示'] = !empty($display_cards) ? implode('，',$display_cards) : $arr['terrace']->details['ji_cheng_xian_ka_xing_hao'].'；'.implode('，',$arr['terrace']->details['xian_shi_shu_chu_jie_kou']).' 外部接口';
        $str['声音输出'] = !empty(array_filter($audio_card))?implode('，',$audio_card):optional($arr['terrace']->details)['ji_cheng_sheng_ka_xing_hao'] ?? '';
        $str['网络'] =!empty($network_cards) ? implode('，',$network_cards).'板载'.$arr['terrace']->details['ji_cheng_wang_ka_xing_hao'] : '板载'.$arr['terrace']->details['ji_cheng_wang_ka_xing_hao'] ;
        $str['功能'] =!empty($personality_card)?implode('；',$personality_card):'';
        $str['扩展插槽'] = $arr['terrace']->pcis;
        $str['I/O接口'] = $arr['terrace']->details['jie_dian_qi_ta_jie_kou'];
        $str['电源供应'] = $arr['terrace']->details['biao_pei_dian_yuan_lei_xing']. $arr['terrace']->details['biao_pei_dian_yuan_gong_lv'].'W'.'，80Plus 金牌高效电源 110-220V ，50-60Hz';
        if(!empty($other)){
            foreach ($other as $key => $value){
                $str[$key] =$value;
            }
        }
        $str['加配']=!empty($others) ? implode('；',$others) : '' ;
        $str['外形尺寸'] ='外形尺寸：'.$arr['terrace']->details['wai_xing_chi_cun'];
        $str['支持OS'] = '支持操作系统：Windows®  2008/2012/win7/win10; Linux;Unix';
        $str['操作环境'] = '适用工作温度及相对湿度：5°C - 35°C，8% - 90%（非凝结）；储存温度及相对湿度：-40°C - 70°C，5% - 95%（非凝结）';
        return $falg ? $str : array_filter($str);
    }
    //平台签收单整机导出明细
    public static  function terrace_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other)
    {
        $str['处理器']=$arr['cpu']->str_name;
        $str['芯片组']=$arr['terrace']->details['jie_dian_xin_pian_zu'];
        $str['内存']=$arr['memory']->pivot->product_good_num.'* '.$arr['memory']->jiancheng;
        $str['硬盘']=implode(',',$hard_disk);
        $str['阵列卡']=implode(',',$raids);
        $str['图形显示']=!empty($display_cards) ? implode('，',$display_cards) : $arr['terrace']->details['ji_cheng_xian_ka_xing_hao'].'；'.implode('，',$arr['terrace']->details['xian_shi_shu_chu_jie_kou']).' 外部接口';
        $str['声音输出']=!empty($audio_card)?implode('，',$audio_card):$arr['terrace']->details['ji_cheng_sheng_ka_xing_hao'] ?? '';
        $str['网络']=!empty($network_cards) ? implode('，',$network_cards) .'板载'.$arr['terrace']->details['ji_cheng_wang_ka_xing_hao']:'板载'.$arr['terrace']->details['ji_cheng_wang_ka_xing_hao'];
        $str['功能']=!empty($personality_card) ? implode('，',$personality_card) :'';
        if($arr['terrace']){
            $str['电源供应']=optional($arr['terrace'])->details['biao_pei_dian_yuan_lei_xing'].optional($arr['terrace'])->details['biao_pei_dian_yuan_gong_lv'].'W';
        }
        if(!empty($other)){
            foreach ($other as $key => $value){
                $str[$key] =$value;
            }
        }
        $str['加配']=!empty($others) ? implode('，',$others) :'';

        return array_filter($str);
    }
    //主板整机明细表
    public static  function  mainboard_complete_machine_detailed($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other,$flag=null)
    {

        $str['处理器']= '标配'. $arr['cpu']->pivot->product_good_num.'颗'.$arr['cpu']->jiancheng.'处理器，最大支持'.($arr['mainboard']->details['cpu_cha_cao_shu'] * $arr['mainboard']->pivot->product_good_num).'颗Socket  LGA'.$arr['cpu']->details['cha_cao_lei_xing'].' '.$arr['cpu']->framework_name.' '. $arr['mainboard']->zhi_chi_cpu_xi_lie.'处理器，'. '最高QPI '.$arr['mainboard']->details['zhi_chi_qpi_fan_wei'].' GT/s，支持功耗'.$arr['mainboard']->details['zui_gao_zhi_chi_cpu_gong_lv'].'W';
        $str['芯片组'] = '配置采用'.$arr['mainboard']->framework_name;
        $str['内存'] = $arr['mainboard']->details['nei_cun_cha_cao_shu'].'个内存插槽（'.$arr['mainboard']->dimm.'-DIMM/每个CPU）适用'.$arr['mainboard']->nei_cun_lei_xing.' '.$arr['memory']->details['gong_zuo_dian_ya'].'V， '.$arr['mainboard']->nei_cun_pin_lv_fan_wei.'范围， 单条最大'.$arr['mainboard']->details['nei_cun_dan_tiao_zui_da'].'G，'.'最高'.$arr['mainboard']->capacity.'GB，'.$arr['memory']->str_name;
        $str['硬盘'] = '支持'.$arr['crate']->disk_position.'，标配'.implode('，',$hard_disk).'支持'.$arr['mainboard']->types.' 硬盘类型';
        $raid=!empty($raids)?implode('，',$raids).'，SATA/SAS/SSD可混用，支持'.implode(',',$arr['raid']->details['raid_mo_shi']).'阵列功能':'可选硬Raid卡带缓存';
        $str['阵列功能'] = '支持'.$arr['mainboard']->types.$arr['mainboard']->raids.'，'.$raid;
        $str['图形显示'] = !empty($display_cards) ? implode('，',$display_cards) : $arr['mainboard']->details['ji_cheng_xian_ka_xing_hao'].'；'.implode('，',$arr['mainboard']->details['xian_shi_shu_chu_jie_kou']).' 外部接口';
        $str['声音输出'] = !empty(array_filter($audio_card))?implode('，',$audio_card):optional($arr['mainboard']->details)['ji_cheng_sheng_ka_xing_hao'] ?? '';
        $str['网络'] =!empty($network_cards) ? implode('，',$network_cards).'板载'.optional($arr['mainboard']->network_card)[0] .'+'.optional($arr['mainboard']->network_card)[1] : '' ;
        $str['功能'] =!empty($personality_card)?implode('；',$personality_card):'';
        $str['扩展插槽'] = $arr['mainboard']->pcis;
        $str['I/O接口'] = $arr['mainboard']->details['qi_ta_jie_kou'];
        if(!empty($arr['power'])){
            $dian_yuan_mo_shi=optional($arr['power'])->details['dian_yuan_mo_shi'] ?? '';
            $dian_yuan_gong_lv=optional($arr['power'])->details['dian_yuan_gong_lv'] ?? '';
           $str['电源供应'] =$dian_yuan_mo_shi.$dian_yuan_gong_lv.'W'.'，80Plus 金牌高效电源 110-220V ，50-60Hz';
        }
        if(!empty($other)){
            foreach ($other as $key => $value){
                $str[$key] =$value;
            }
        }
        $str['加配']=!empty($others) ? implode('；',$others) : '' ;
        $str['外形尺寸'] ='外形尺寸：'.$arr['crate']->details['wai_xing_chi_cun'];
        $str['支持OS'] = '支持操作系统：Windows®  2008/2012/win7/win10; Linux;Unix';
        $str['操作环境'] = '适用工作温度及相对湿度：5°C - 35°C，8% - 90%（非凝结）；储存温度及相对湿度：-40°C - 70°C，5% - 95%（非凝结）';

        return $flag=='all' ? $str : array_filter($str);
    }
    //主板签收单整机导出明细
    public static  function mainboard_signature_form($arr,$hard_disk,$display_cards,$raids,$network_cards,$personality_card,$audio_card,$others,$other)
    {
        $str['处理器']=$arr['cpu']->str_name;
        $str['芯片组']=$arr['mainboard']->framework_name;
        $str['内存']=$arr['memory']->pivot->product_good_num.'* '.$arr['memory']->jiancheng;
        $str['硬盘']=implode(',',$hard_disk);
        $str['阵列卡']=implode(',',$raids);
        $str['图形显示']=!empty($display_cards) ? implode('，',$display_cards) : $arr['mainboard']->details['ji_cheng_xian_ka_xing_hao'].'；'.implode('，',$arr['mainboard']->details['xian_shi_shu_chu_jie_kou']).' 外部接口';
        $str['声音输出']=!empty($audio_card)?implode('，',$audio_card):$arr['mainboard']->details['ji_cheng_sheng_ka_xing_hao'] ?? '';
        $str['网络']=!empty($network_cards) ? implode('，',$network_cards) :'';
        $str['功能']=!empty($personality_card) ? implode('，',$personality_card) :'';
        if(!empty($arr['power'])){
           $dian_yuan_mo_shi=optional($arr['power'])->details['dian_yuan_mo_shi'] ?? '';
            $dian_yuan_gong_lv=optional($arr['power'])->details['dian_yuan_gong_lv'] ?? '';
            $str['电源供应']=$dian_yuan_mo_shi.$dian_yuan_gong_lv.'W';
        }
        if(!empty($other)){
            foreach ($other as $key => $value){
                $str[$key] =$value;
            }
        }
        $str['加配']=!empty($others) ? implode('，',$others) :'';

        return array_filter($str);
    }


    public static function terrace($product_good)
    {
        $product_good->zhi_chi_cpu_xi_lie=implode('&',$product_good->details['jie_dian_cpu_xi_lie']);
        $product_good->capacity=$product_good->details['jie_dian_nei_cun_cha_cao_shu'] * $product_good->details['dan_nei_cun_zhi_chi_zui_da'];
        $product_good->nei_cun_pin_lv_fan_wei=min($product_good->details['nei_cun_pin_lv_fan_wei']).'~'.max($product_good->details['nei_cun_pin_lv_fan_wei']).'MHz';
        $product_good->dimm=$product_good->details['nei_cun_shi_fou_jian_ban'] == 1 ? $product_good->details['jie_dian_nei_cun_cha_cao_shu'] / 2 :$product_good->details['jie_dian_nei_cun_cha_cao_shu'];
        $product_good->nei_cun_lei_xing=implode('/',$product_good->details['jie_dian_nei_cun_lei_xing']);
        $product_good->framework_name=$product_good->jiagou_id == 238 ? $product_good->series_name :  $product_good->framework_name;
        $rds=[];$pcis=[];$raid_types=[];
        foreach (self::$terrace_pcis as $key=>$item){
            if($product_good->details[$key]){
                $pci=explode(',',$product_good->details[$key]);
                $pcis[]=$pci[0].' * '.$item.','.$pci[1];
            }
        }
        foreach (self::$terrace_raid_types as $item){
            if(!empty(array_filter($product_good->details[$item]))){
                $types=implode(';',$product_good->details[$item]);
                $raid_types[]=$types;
            }
        }
        foreach (self::$raids as $item){
            if(!empty(array_filter($product_good->details[$item]))){
                $raids=implode(';',$product_good->details[$item]);
                $rds[]=$raids;
            }
        }
        foreach (self::$terrace_disk_position as $k=>$v){
            if($product_good->details[$k]){
                $disk_position[]=$product_good->details[$k].$v;
            }
        }
        $product_good->disk_position=implode(' ',array_filter($disk_position));
        $product_good->raids=implode(';',array_filter($rds));
        $product_good->types=implode(';',array_filter($raid_types));
        $product_good->pcis=implode(';',array_filter($pcis));
        return $product_good;
    }
    public static function cpu($product_good)
    {
        $product_good->thread=explode('/',$product_good->details['he_xin_xian_cheng']);
        $product_good->jiancheng=$product_good->jiancheng.'/'.$product_good->thread[1];
        $product_good->str_name=$product_good->pivot->product_good_num.'* '.$product_good->jiancheng;
        return $product_good;
    }
    public static function mainboard($product_good)
    {
        $product_good->zhi_chi_cpu_xi_lie=implode('&',$product_good->details['zhi_chi_cpu_xi_lie']);
        $product_good->capacity=$product_good->details['nei_cun_cha_cao_shu'] * $product_good->details['nei_cun_dan_tiao_zui_da'];
        $product_good->nei_cun_pin_lv_fan_wei=min($product_good->details['nei_cun_pin_lv_fan_wei']).'~'.max($product_good->details['nei_cun_pin_lv_fan_wei']).'MHz';
        $product_good->dimm=$product_good->details['nei_cun_shi_fou_jian_ban'] == 1 ? $product_good->details['nei_cun_cha_cao_shu'] / 2 :$product_good->details['nei_cun_cha_cao_shu'];
        $product_good->nei_cun_lei_xing=implode('/',$product_good->details['nei_cun_lei_xing']);
        $product_good->network_card=explode('+',$product_good->details['ji_cheng_wang_ka_xing_hao']);
        $product_good->framework_name=$product_good->jiagou_id == 238 ? $product_good->series_name :  $product_good->framework_name;
        $rds=[];$pcis=[];$raid_types=[];
        foreach (self::$pcis as $key=>$item){
            if($product_good->details[$key]){
                $pci=explode(',',$product_good->details[$key]);
                $pcis[]=$pci[0].' * '.$item.','.$pci[1];
            }
        }
        foreach (self::$raid_types as $item){
            if(!empty(array_filter($product_good->details[$item]))){
                $types=implode(';',$product_good->details[$item]);
                $raid_types[]=$types;
            }
        }
        foreach (self::$raids as $item){
            if(!empty(array_filter($product_good->details[$item]))){
                $raids=implode(';',$product_good->details[$item]);
                $rds[]=$raids;
            }
        }
        $product_good->raids=implode(';',array_filter($rds));
        $product_good->types=implode(';',array_filter($raid_types));
        $product_good->pcis=implode(';',array_filter($pcis));
        return $product_good;
    }
    public static function memory($product_good)
    {
        $product_good->str_name='标配 '.($product_good->pivot->product_good_num * $product_good->details['rong_liang']).'G '.$product_good->details['lei_xing'].' '.$product_good->details['gong_zuo_pin_lv'].'内存';
        return $product_good;
    }
    public static function hard_disk($product_good)
    {
        $product_good_raid=$product_good->pivot->product_good_raid ? $product_good->pivot->product_good_raid.'阵列模式' : '';
        $product_good->str_name=$product_good->pivot->product_good_num.'块 '.$product_good->jiancheng.' 硬盘 '.$product_good_raid;
        return $product_good;
    }
    public static function display_card($product_good)
    {
        $product_good->str_name=$product_good->pivot->product_good_num.' * '.$product_good->jiancheng.' 显卡 ';
        return $product_good;
    }
    public static function raid($product_good)
    {
        $product_good->str_name=$product_good->pivot->product_good_num.' * '.$product_good->jiancheng.' 阵列卡 ';
        return $product_good;
    }
    public static function network_card($product_good)
    {
        $product_good->str_name=$product_good->pivot->product_good_num.' * '.$product_good->jiancheng.' 网卡 ';
        return $product_good;
    }
    public static function personality_card($product_good)
    {
        $product_good->personality=$product_good->pivot->product_good_num.' * '.$product_good->jiancheng.' 专用卡 ';
        $product_good->audio_card=$product_good->jiagou_id == 389 ? $product_good->pivot->product_good_num.' * '.$product_good->jiancheng.' 声卡 ' : '' ;
        return $product_good;
    }
    public static function crate($product_good)
    {
        //,'re_cha_ba_ying_pan_lei_xing','dian_yuan_mo_shi'
        foreach (self::$disk_position as $k=>$v){
            if($product_good->details[$k]){
                $disk_position[]=$product_good->details[$k].$v;
            }
        }
        $product_good->re_cha_ba_ying_pan_lei_xing=implode('或',$product_good->details['re_cha_ba_ying_pan_lei_xing']);
        $product_good->dian_yuan_mo_shi=implode('/',$product_good->details['dian_yuan_mo_shi']);

        $product_good->disk_position=implode(' ',$disk_position);
        return $product_good;
    }
    public static function power($product_good)
    {
        return $product_good;
    }
    public static function radiator($product_good)
    {
        return $product_good;
    }
    public static function other($product_good)
    {
        $product_good->str_name=$product_good->pivot->product_good_num.' * '.$product_good->jiancheng;
        return $product_good;
    }
}