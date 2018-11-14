<?php
namespace App\Services;
use App\Models\ProductGood;
class SelfBuildTerraceServices{


    
    //获取物料所需参数
    public function TemporaryProductGoodParameters($good){
        $goods=[];
        foreach($good as $item){
            $goods[$item->id]=['product_good_num'=>$item->pivot->product_good_num,'product_number'=>$item->pivot->product_number];//将临时表的产品打包到二维数组
        }
        return $goods;
    }
    //获取临时物料全部ids
    public function TemporaryProductGoodAllRelatedIds(){
        return auth('admin')->user()->temporary_product_goods()->allRelatedIds()->toArray();//输出关联的 产品id 数组
    }
    //获取临时物料
    public function getTemporaryProductGoods(){
        return auth('admin')->user()->temporary_product_goods;//获取临时表中的产品
    }
    //添加临时物料
    public function addTemporaryProductGoods($request){
        $good_id = $request->get('product_good_id');
        $good_num = $request->get('product_good_num');
        $good = ProductGood::findOrFail($good_id);//如果没有配件 则添加 如果选择了相同的配件  则以当前添加的数量为准  添加到配件临时表
        auth('admin')->user()->temporary_product_goods()->sync([$good_id => ['product_good_num' => $good_num, 'product_number' => $good->product->bianhao]], false);
    }
    //删除临时物料
    public function deleteTemporaryProductGoods($goodIds){
        auth('admin')->user()->temporary_product_goods()->detach($goodIds);//删除临时表中的产品

    }
    //获取 主板 机箱 电源 参数
    public function get_the_main_board_cabinet_power_parameters($good,$ping_tai_lei_xing)
    {

        $data=[];
        foreach ($good as $v){
            if($v['product_id'] == 13 ){  //主板

                $data['details']['jie_dian_xin_pian_zu'] = $v->framework->name;
                $data['details']['jie_dian_shu_liang'] = $v->pivot->product_good_num;
                $data['details']['jie_dian_cpu_xi_lie'] = $v['details']['zhi_chi_cpu_xi_lie'];
                $data['details']['jie_dian_cpu_cha_cao'] = $v['details']['cpu_cha_cao_lei_xing'];
                $data['details']['jie_dian_cpu_bing_cun_shu'] = $v['details']['cpu_cha_cao_shu'];
                $data['details']['dan_nei_cun_zhi_chi_zui_da'] = $v['details']['nei_cun_dan_tiao_zui_da'];
                $data['details']['jie_dian_qpi_fan_wei'] = $v['details']['zhi_chi_qpi_fan_wei'];
                $data['details']['jie_dian_nei_cun_lei_xing'] = $v['details']['nei_cun_lei_xing'];
                $data['details']['nei_cun_pin_lv_fan_wei'] = $v['details']['nei_cun_pin_lv_fan_wei'];
                $data['details']['jie_dian_nei_cun_cha_cao_shu'] = $v['details']['nei_cun_cha_cao_shu'];
                $data['details']['jie_dian_pci'] = $v['details']['pci'];
                $data['details']['nei_cun_shi_fou_jian_ban'] = $v['details']['nei_cun_shi_fou_jian_ban'];
                $data['details']['nei_cun_shi_fou_jian_ban'] = $v['details']['nei_cun_shi_fou_jian_ban'];
                $data['details']['jie_dian_pci_x'] = $v['details']['pci_x'];
                $data['details']['jie_dian_pci_e_x1'] = $v['details']['pci_e_x1'];
                $data['details']['jie_dian_pci_e_x4'] = $v['details']['pci_e_x4'];
                $data['details']['jie_dian_pci_e_x8'] = $v['details']['pci_e_x8'];
                $data['details']['jie_dian_pci_e_x16'] = $v['details']['pci_e_x16'];
                $data['details']['bei_yong_can_shu_1'] = $v['details']['bei_yong_can_shu_1'];
                $data['details']['bei_yong_can_shu_2'] = $v['details']['bei_yong_can_shu_2'];
                $data['details']['jie_dian_qi_ta_jie_kou'] = $v['details']['qi_ta_jie_kou'];
                $data['details']['ji_cheng_xian_ka_xing_hao'] = $v['details']['ji_cheng_xian_ka_xing_hao'];
                $data['details']['ji_cheng_sheng_ka_xing_hao'] = $v['details']['ji_cheng_sheng_ka_xing_hao'];
                $data['details']['ji_cheng_wang_ka_xing_hao'] = $v['details']['ji_cheng_wang_ka_xing_hao'];
                $data['details']['jie_dian_ying_pan_lei_xing_1'] = $v['details']['ban_zai_ying_pan_lei_xing_1'];
                $data['details']['ying_pan_shu_liang_1'] = $v['details']['ying_pan_shu_liang_1'];
                $data['details']['zhi_chi_raid_mo_shi_1'] = $v['details']['zhi_chi_raid_mo_shi_1'];
                $data['details']['jie_dian_ying_pan_lei_xing_2'] = $v['details']['ban_zai_ying_pan_lei_xing_2'];
                $data['details']['ying_pan_shu_liang_2'] = $v['details']['ying_pan_shu_liang_2'];
                $data['details']['zhi_chi_raid_mo_shi_2'] = $v['details']['zhi_chi_raid_mo_shi_2'];
                $data['details']['jie_dian_ying_pan_lei_xing_3'] = $v['details']['ban_zai_ying_pan_lei_xing_3'];
                $data['details']['ying_pan_shu_liang_3'] = $v['details']['ying_pan_shu_liang_3'];
                $data['details']['zhi_chi_raid_mo_shi_3'] = $v['details']['zhi_chi_raid_mo_shi_3'];
                $data['details']['zui_gao_zhi_chi_cpu_gong_lv'] = $v['details']['zui_gao_zhi_chi_cpu_gong_lv'];
                $data['details']['xian_shi_shu_chu_jie_kou'] = $v['details']['xian_shi_shu_chu_jie_kou'];
                $data['details']['xian_shi_shu_chu_jie_kou'] = $v['details']['xian_shi_shu_chu_jie_kou'];

            }
            if($v['product_id'] == 20){ //机箱
                $data['details']['dan_jie_dian_biao_zhun_ying_pan_shu'] = $v['details']['nei_zhi_3_5_cun_ying_pan_wei'];
                $data['details']['dan_jie_dian_2_5_cun_ying_pan_shu'] = $v['details']['nei_zhi_2_5_cun_ying_pan_wei'];
                $data['details']['3_5_cun_re_cha_ba_pan_wei'] = $v['details']['3_5_cun_re_cha_ba_pan_wei'];
                $data['details']['2_5_cun_re_cha_ba_pan_wei'] = $v['details']['2_5_cun_re_cha_ba_pan_wei'];
                $data['details']['biao_zhun_guang_qu_wei'] = $v['details']['biao_zhun_guang_qu_wei'];
                $data['details']['chao_bao_guang_qu_wei'] = $v['details']['chao_bao_guang_qu_wei'];
                $data['details']['ji_xiang_shi_fou_dai_men'] = $v['details']['ji_xiang_shi_fou_dai_men'];
                $data['details']['mian_ban_jie_kou'] = $v['details']['mian_ban_jie_kou'];
                $data['details']['wai_xing_chi_cun'] = $v['details']['wai_xing_chi_cun'];
                if(!empty($v['details']['kun_bang_dian_yuan'])) { //捆绑电源
                    $power = $v->find($v['details']['kun_bang_dian_yuan']);
                    $data['details']['biao_pei_dian_yuan_lei_xing'] = $power['details']['dian_yuan_mo_shi'];
                    $data['details']['biao_pei_dian_yuan_gong_lv'] = $power['details']['dian_yuan_gong_lv'];
                }
            }
            if($v['product_id'] == 21){ //电源
                $data['details']['biao_pei_dian_yuan_lei_xing'] = $v['details']['dian_yuan_mo_shi'];
                $data['details']['biao_pei_dian_yuan_gong_lv'] = $v['details']['dian_yuan_gong_lv'];
            }
            $data['details']['dao_gui'] =0;
            $data['details']['cd_rom']=0;
            $data['details']['jian_pan_shu_biao_tao_jian'] = 0;
            if($v['product_id'] == 24) {  //其他
                $data['details']['dao_gui'] =$v['xilie_id'] ==384 ? 1: 0;
                $data['details']['cd_rom'] =$v['xilie_id'] ==136 ? 1: 0;
                $data['details']['jian_pan_shu_biao_tao_jian'] = $v['xilie_id'] ==134 ? 1: 0;
            }
        }
        $data['details']['ping_tai_lei_xing'] = $ping_tai_lei_xing['ping_tai_lei_xing'];

        $data['status']=["show"=>1,'hide'=>0,"hot"=>0,"recommend"=>0,"main_current"=>0,"halt_production"=>0];
        return $data;
    }
    //获取主板参数
    public function get_mainboard($v)
    {
        $data['details']['jie_dian_xin_pian_zu'] = $v['jiagou_id'];
        $data['details']['jie_dian_cpu_xi_lie'] = $v['details']['zhi_chi_cpu_xi_lie'];
        $data['details']['jie_dian_cpu_cha_cao'] = $v['details']['cpu_cha_cao_lei_xing'];
        $data['details']['jie_dian_cpu_bing_cun_shu'] = $v['details']['cpu_cha_cao_shu'];
        $data['details']['dan_nei_cun_zhi_chi_zui_da'] = $v['details']['nei_cun_dan_tiao_zui_da'];
        $data['details']['jie_dian_qpi_fan_wei'] = $v['details']['zhi_chi_qpi_fan_wei'];
        $data['details']['jie_dian_nei_cun_lei_xing'] = $v['details']['nei_cun_lei_xing'];
        $data['details']['nei_cun_pin_lv_fan_wei'] = $v['details']['nei_cun_pin_lv_fan_wei'];
        $data['details']['jie_dian_nei_cun_cha_cao_shu'] = $v['details']['nei_cun_cha_cao_shu'];
        $data['details']['jie_dian_pci'] = $v['details']['pci'];
        $data['details']['nei_cun_shi_fou_jian_ban'] = $v['details']['nei_cun_shi_fou_jian_ban'];
        $data['details']['nei_cun_shi_fou_jian_ban'] = $v['details']['nei_cun_shi_fou_jian_ban'];
        $data['details']['jie_dian_pci_x'] = $v['details']['pci_x'];
        $data['details']['jie_dian_pci_e_x1'] = $v['details']['pci_e_x1'];
        $data['details']['jie_dian_pci_e_x4'] = $v['details']['pci_e_x4'];
        $data['details']['jie_dian_pci_e_x8'] = $v['details']['pci_e_x8'];
        $data['details']['jie_dian_pci_e_x16'] = $v['details']['pci_e_x16'];
        $data['details']['bei_yong_can_shu_1'] = $v['details']['bei_yong_can_shu_1'];
        $data['details']['bei_yong_can_shu_2'] = $v['details']['bei_yong_can_shu_2'];
        $data['details']['jie_dian_qi_ta_jie_kou'] = $v['details']['qi_ta_jie_kou'];
        $data['details']['ji_cheng_xian_ka_xing_hao'] = $v['details']['ji_cheng_xian_ka_xing_hao'];
        $data['details']['ji_cheng_sheng_ka_xing_hao'] = $v['details']['ji_cheng_sheng_ka_xing_hao'];
        $data['details']['ji_cheng_wang_ka_xing_hao'] = $v['details']['ji_cheng_wang_ka_xing_hao'];
        $data['details']['jie_dian_ying_pan_lei_xing_1'] = $v['details']['ban_zai_ying_pan_lei_xing_1'];
        $data['details']['ying_pan_shu_liang_1'] = $v['details']['ying_pan_shu_liang_1'];
        $data['details']['zhi_chi_raid_mo_shi_1'] = $v['details']['zhi_chi_raid_mo_shi_1'];
        $data['details']['jie_dian_ying_pan_lei_xing_2'] = $v['details']['ban_zai_ying_pan_lei_xing_2'];
        $data['details']['ying_pan_shu_liang_2'] = $v['details']['ying_pan_shu_liang_2'];
        $data['details']['zhi_chi_raid_mo_shi_2'] = $v['details']['zhi_chi_raid_mo_shi_2'];
        $data['details']['jie_dian_ying_pan_lei_xing_3'] = $v['details']['ban_zai_ying_pan_lei_xing_3'];
        $data['details']['ying_pan_shu_liang_3'] = $v['details']['ying_pan_shu_liang_3'];
        $data['details']['zhi_chi_raid_mo_shi_3'] = $v['details']['zhi_chi_raid_mo_shi_3'];
        $data['details']['zui_gao_zhi_chi_cpu_gong_lv'] = $v['details']['zui_gao_zhi_chi_cpu_gong_lv'];
        $data['details']['xian_shi_shu_chu_jie_kou'] = $v['details']['xian_shi_shu_chu_jie_kou'];
        $data['details']['xian_shi_shu_chu_jie_kou'] = $v['details']['xian_shi_shu_chu_jie_kou'];
        return $data;
    }
    //获取机箱参数
    public function get_crate($v)
    {
        $data['details']['dan_jie_dian_biao_zhun_ying_pan_shu'] = $v['details']['nei_zhi_3_5_cun_ying_pan_wei'];
        $data['details']['dan_jie_dian_2_5_cun_ying_pan_shu'] = $v['details']['nei_zhi_2_5_cun_ying_pan_wei'];
        $data['details']['3_5_cun_re_cha_ba_pan_wei'] = $v['details']['3_5_cun_re_cha_ba_pan_wei'];
        $data['details']['2_5_cun_re_cha_ba_pan_wei'] = $v['details']['2_5_cun_re_cha_ba_pan_wei'];
        $data['details']['biao_zhun_guang_qu_wei'] = $v['details']['biao_zhun_guang_qu_wei'];
        $data['details']['chao_bao_guang_qu_wei'] = $v['details']['chao_bao_guang_qu_wei'];
        $data['details']['ji_xiang_shi_fou_dai_men'] = $v['details']['ji_xiang_shi_fou_dai_men'];
        $data['details']['mian_ban_jie_kou'] = $v['details']['mian_ban_jie_kou'];
        $data['details']['wai_xing_chi_cun'] = $v['details']['wai_xing_chi_cun'];
        if(!empty($v['details']['kun_bang_dian_yuan'])) {
            $power = $v->find($v['details']['kun_bang_dian_yuan']);
            $data['details']['biao_pei_dian_yuan_lei_xing'] = $power['details']['dian_yuan_mo_shi'];
            $data['details']['biao_pei_dian_yuan_gong_lv'] = $power['details']['dian_yuan_gong_lv'];
        }
        return $data;
    }
    //获取电源参数
    public function get_power($v)
    {
        $data['details']['biao_pei_dian_yuan_lei_xing'] = $v['details']['dian_yuan_mo_shi'];
        $data['details']['biao_pei_dian_yuan_gong_lv'] = $v['details']['dian_yuan_gong_lv'];
        return $data;
    }

}
?>