<?php

namespace App\Presenters;

use App\Models\OldGood;
use App\Models\OldOrder;
use App\Models\OldYingpan;

class OldOrderParamenterPresenter
{
    //获取旧订单物料
    public function get_goods($order_info)
    {
        if ($order_info['mode'] == '选购配件') {
            $list = $order_info->good;
            $wls = array();

            foreach ($list as $v) {
                $wls[$v['product']][] = $v->productid . ',' .$v->num . ',' .$v->assure_time . ',' . $this->oldPicZhuanHuan($v['product']);
            }
        } else {
            $list = $order_info->yingpan;
            $list=$list->toArray();
            $wls = array();
            $num = 1;
            $wls['处理器'] = $order_info['cpuid'] ? $order_info['cpuid'] . ',' . $order_info['cpu_num'] . ',' . $order_info['cpuassure'] . ',' . $this->oldPicZhuanHuan('处理器') : '';
            $wls['主板'] = $order_info['biosid'] ? $order_info['biosid'] . ',1,' . $order_info['biosassure'] . ',' . $this->oldPicZhuanHuan('主机板') : '';
            $wls['内存'] = $order_info['memoryid'] ? $order_info['memoryid'] . ',' . $order_info['memory_num'] . ',' . $order_info['memoryassure'] . ',' . $this->oldPicZhuanHuan('内存') : '';
            foreach ($list as $v) {

                $wls['硬盘'][] = $v['diskid'] . ',' . $v['nums'] . ',' . $v['raid_m'] . ',' /*$v['arrayid']*/ . ',' . $v['diskassure'] . ',' . $this->oldPicZhuanHuan('硬盘');
                if ($v['arrayid'] != '板载') {
                    $wls['阵列卡'][] = $v['arrayid'] . ',' . $num . ',' . $this->oldPicZhuanHuan('阵列卡');
                    $num++;
                }

            }
            $wls['专用卡'] = $order_info['special_card'] ? $order_info['special_card'] . ',1,' . $order_info['special_cardassure'] . ',' . $this->oldPicZhuanHuan('专用卡') : '';
            $wls['显卡'] = $order_info['agpid'] ? $order_info['agpid'] . ',1,' . $order_info['agpassure'] . ',' . $this->oldPicZhuanHuan('显卡') : '';
            $wls['网卡'] = $order_info['net_work'] ? $order_info['net_work'] . ',1,' . $order_info['net_workassure'] . ',' . $this->oldPicZhuanHuan('网卡') : '';
            $wls['机箱'] = $order_info['box'] ? $order_info['box'] . ',1,' . $order_info['boxassure'] . ',' . $this->oldPicZhuanHuan('机箱') : '';
            $wls['电源'] = $order_info['power'] ? $order_info['power'] . ',1,' . $order_info['powerassure'] . ',' . $this->oldPicZhuanHuan('电源') : '';
            $wls['散热器'] = $order_info['rd'] ? $order_info['rd'] . ',' . $order_info['cpu_num'] . ',' . $order_info['rdassure'] . ',' . $this->oldPicZhuanHuan('散热器') : '';
            $wls['光驱'] = $order_info['dvd'] && $order_info['dvd'] != '不添加光驱' ? $order_info['dvd'] . ',1,' . $order_info['dvdassure'] . ',' . $this->oldPicZhuanHuan('其他产品') : '';
            if (!empty($order_info['other1'])) {
                $wls['其他'][] = $order_info['other1'] . ',' . $order_info['other1_num'] . ',' . $order_info['other1_num'] . ',' . $this->oldPicZhuanHuan('其他产品');
            }
            if (!empty($order_info['other2'])) {
                $wls['其他'][] = $order_info['other2'] . ',' . $order_info['other2_num'] . ',' . $order_info['other2_num'] . ',' . $this->oldPicZhuanHuan('其他产品');
            }
            if (!empty($order_info['other3'])) {
                $wls['其他'][] = $order_info['other3'] . ',' . $order_info['other3_num'] . ',' . $order_info['other3_num'] . ',' . $this->oldPicZhuanHuan('其他产品');
            }
            if (!empty($order_info['other4'])) {
                $wls['其他'][] = $order_info['other4'] . ',' . $order_info['other4_num'] . ',' . $order_info['other4_num'] . ',' . $this->oldPicZhuanHuan('其他产品');
            }
            if (!empty($order_info['other5'])) {
                $wls['其他'][] = $order_info['other5'] . ',' . $order_info['other5_num'] . ',' . $order_info['other5_num'] . ',' . $this->oldPicZhuanHuan('其他产品');
            }
        }
        return array_filter($wls);
    }

    public function oldPicZhuanHuan($name)
    {
        if ($name == '处理器') {
            $pic = 'cpu.png';
        }
        if ($name == '主机板') {
            $pic = 'zhuban.png';
        }
        if ($name == '内存') {
            $pic = 'neicun.png';
        }
        if ($name == '硬盘') {
            $pic = 'yingpan.png';
        }
        if ($name == '显卡') {
            $pic = 'xianka.png';
        }
        if ($name == '阵列卡') {
            $pic = 'zhenlie.png';
        }
        if ($name == '网卡') {
            $pic = 'wangka.png';
        }
        if ($name == '专用卡') {
            $pic = 'zhuanyong.png';
        }
        if ($name == '机箱') {
            $pic = 'jixiang.png';
        }
        if ($name == '电源') {
            $pic = 'dianyuan.png';
        }
        if ($name == '散热器') {
            $pic = 'sanre.png';
        }
        if ($name == '平台') {
            $pic = 'pingtai.png';
        }
        if ($name == '其他产品') {
            $pic = 'qita.png';
        }
        return $pic;
    }
}