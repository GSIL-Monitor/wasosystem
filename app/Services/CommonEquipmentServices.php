<?php

namespace App\Services;

use App\Events\OrderSend;
use App\Models\Admin;
use App\Models\DemandManagement;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductGood;

class CommonEquipmentServices
{
    //获取订单物料所需参数
    public function GetOrderMaterialParameters($good, $grade)
    {
        $goods = [];
        foreach ($good as $item) {
            $goods[$item->id] = ['product_good_num' => $item->pivot->product_good_num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid, 'type' => 'common_equipments'];//将物料产品打包到二维数组
        }
        return $goods;
    }

    //初始化数据
    public function initial_data($order)
    {
        $product_goods = collect($this->initial_order_aterial_data($order->order_product_goods, $order->user->grades->identifying, $order->num));//获取初始化订单物料
        $total_prices = $product_goods['price'];//获取总价格
        $data['product_goods'] = $product_goods;
        $data['user_id'] = $order->user_id;
        $data['serial_number'] = 'SN' . date('YmdHis', time());
        $data['machine_model'] = $order->machine_model;
        $data['code'] = $order->code;
        $data['unit_price'] = $total_prices;
        $data['total_prices'] = $total_prices;
        $data['price_spread'] = $order->price_spread;
        $data['num'] = 1;
        $data['order_type'] = $order->order_type;
        $data['order_status'] = 'intention_to_order';
        $data['message_status'] = 'intention_to_order';
        $data['payment_status'] = 'pay_first';
        $data['service_status'] = 0;
        $data['invoice_type'] = 'vat_special_invoice';
        $data['parcel_count'] = 1;
        $data['urgent'] = false;
        $data['flow_pic'] = false;
        $data['in_common_use'] = $order->in_common_use;
        $data['market'] = $order->market;
        $data['pic'] = [];
        return collect($data);
    }

    //初始化订饭物料数据
    public function initial_order_aterial_data($good, $grade, $order_num)
    {
        $goods = [];
        $num = 0;
        $price = 0;
        foreach ($good as $item) {
            $num = $item->pivot->product_good_num / $order_num;
            $goods[$item->id] = ['product_good_num' => $num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid];//将物料产品打包到二维数组
            $price += $num * $item->price[$grade];
        }
        $goods['price'] = $price;
        return $goods;
    }

    //获取订单物料所需参数
    public function GetTemporaryMaterialParameters($good, $grade, $order_num)
    {
        $goods = [];
        foreach ($good as $item) {
            $num = $item->pivot->product_good_num * $order_num;
            $goods[$item->id] = ['product_good_num' => $num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid];//将物料产品打包到二维数组
        }
        return $goods;
    }

    //获取临时物料全部ids
    public function TemporaryProductGoodAllRelatedIds()
    {
        return auth('admin')->user()->temporary_product_goods()->whereType('common_equipments')->allRelatedIds()->toArray();//输出关联的 产品id 数组
    }

    //添加物料到临时表
    public function AddTemporaryProductGood($ids)
    {
        if (auth('admin')->user()->temporary_product_goods->isEmpty()) { //判断是否为空
            return auth('admin')->user()->temporary_product_goods()->sync($ids, false);
        }
    }

    //获取产品
    public function get_product_good($request, $order)
    {

        $arr = $request->get('arr');
        $product_good = ProductGood::findOrFail($arr['product_good_id']);
        if ($product_good) {
            $data[$product_good->id] = [
                "product_good_num" => $arr['product_good_num'],
                "product_number" => $arr['product_good_number'] ?? $product_good->product->bianhao,
                "product_good_raid" => $arr['product_good_raid'] ?? '',
                "product_good_price" => $product_good->price[$order->user->grades->identifying],
                "type" => 'common_equipments',
            ];
            if ($product_good->product_id == 12) { //如果提交过来是cpu  那么就修改 内存和散热器的数量跟cpu 的数量一致
                $product_goods = auth('admin')->user()->temporary_product_goods;
                foreach ($product_goods as $item) {
                    if (str_contains($item->product_id, [14, 22])) {
                        auth('admin')->user()->temporary_product_goods()->updateExistingPivot($item->id, ['product_good_num' => $arr['product_good_num']]);
                    }
                }
            }
            $this->deleteTemporaryProductGoods(array_wrap($request->get('old_id')));
            $this->addTemporaryProductGoods($data);
        }
    }

    //获取临时物料
    public function getTemporaryProductGoods()
    {
        return auth('admin')->user()->temporary_product_goods()->whereType('common_equipments')->oldest('product_number')->get();//获取临时表中的产品
    }

    //添加临时物料
    public function addTemporaryProductGoods($data)
    {
//        $good_id = $request->get('product_good_id');
//        $good_num = $request->get('product_good_num');
//        $good = ProductGood::findOrFail($good_id);//如果没有配件 则添加 如果选择了相同的配件  则以当前添加的数量为准  添加到配件临时表
        auth('admin')->user()->temporary_product_goods()->sync($data, false);
    }

    //删除临时物料
    public function deleteTemporaryProductGoods($goodIds)
    {
        auth('admin')->user()->temporary_product_goods()->whereType('common_equipments')->detach($goodIds);//删除临时表中的产品
    }

    //临时物料添加到订单物料
    public function temporary_material_add_to_order_material($request, $order)
    {
        $temporary_material = $this->getTemporaryProductGoods();//获取临时物料
        $data = $this->GetTemporaryMaterialParameters($temporary_material, $order->user->grades->identifying, $order->num);//转换为二位数组参数
        $order->common_equipment_product_goods()->sync($data);//添加到订单库
        $this->deleteTemporaryProductGoods($this->TemporaryProductGoodAllRelatedIds());//删除临时表对应的数据
        $order_data = ['total_prices' => $request->get('total_prices'),
            'unit_price' => $request->get('total_prices'),
            'invoice_type' => 'vat_special_invoice',
            'machine_model' => $request->get('machine_model')
        ];
        $order->update($order_data);
    }

    //批量更新物料
    public function update_prices($common_equipments)
    {

        foreach ($common_equipments as $item) {
            $price = $this->initial_order_aterial_data($item->common_equipment_product_goods, $item->user->grade, $item->num)['price'];
            $data = ['unit_prices' => $price, 'total_prices' => $price, 'old_prices' => $item->total_prices];
            $item->update($data);
        }
    }

    public function remove_user_product()
    {
        $ids = $this->get_user_product()->pluck('id');
        user()->user_product()->detach($ids);
    }

    public function add_user_product($common_equipment)
    {
        $grade=$common_equipment->user->grades->identifying;
        if(user()){
            $this->remove_user_product();
            $grade=user()->grades->identifying;
        }

        $good = $this->initial_order_aterial_data($common_equipment->common_equipment_product_goods,$grade , 1);
        $goods = [];
        foreach ($good as $key => $item) {
            if (is_array($item)) {
                $item['type'] = 'common_equipment';
                $goods[$key] = $item;
            }
        }
        if(user()){
            user()->user_product()->attach($goods);
        }
        return $good;
    }

    public function get_user_product()
    {
        return user()->user_product()->whereType('common_equipment')->oldest('product_number')->get();
    }

    //初始化数据
    public function common_equipment_to_place_an_order($common_equipment)
    {
        $product_goods = collect($this->add_user_product($common_equipment));//获取初始化订单物料
        $total_prices = $product_goods['price'];//获取总价格
        $data['product_goods'] = $product_goods;
        $data['user_id'] = $common_equipment->user_id;
        $data['serial_number'] = 'SN' . date('YmdHis', time());
        $data['machine_model'] = $common_equipment->machine_model;
        $data['code'] = $common_equipment->code;
        $data['unit_price'] = $total_prices;
        $data['total_prices'] = $total_prices;
        $data['num'] = 1;
        $data['order_type'] = $common_equipment->order_type;
        $data['order_status'] = 'intention_to_order';
        $data['message_status'] = 'intention_to_order';
        $data['payment_status'] = 'pay_first';
        $data['service_status'] = 0;
        $data['invoice_type'] = 'vat_special_invoice';
        $data['parcel_count'] = 1;
        $data['urgent'] = false;
        $data['flow_pic'] = false;
        $data['in_common_use'] = true;
        $data['market'] = $common_equipment->market;
        $data['pic'] = [];
        return collect($data);
    }

    //初始化需求数据
    public static function initial_demand_data($common_equipment='')
    {
        $demand['user_id'] = user()->id ?? $common_equipment->user->id;
        $demand['demand_number'] = 'XQ' . date('YmdHis', time());
        $demand['visitor_details_id'] = user()->visitor_details->id ?? $common_equipment->user->visitor_details->id;
        $demand['demand_status'] = 'demand_consult';
        $demand['customer_status'] = 'initial_contact';
        $demand['admin'] = user()->administrator ?? $common_equipment->user->administrator;
        $demand['analog_data'] = false;
        $demand['send'] = false;
        return $demand;
    }

    //下单
    public function place_an_order($common_equipment)
    {
        \DB::transaction(function () use ($common_equipment) {
            $product_goods = $this->common_equipment_to_place_an_order($common_equipment)->get('product_goods');
            $data = $this->common_equipment_to_place_an_order($common_equipment);
            $product_goods->pull('price');
            $data->pull('product_goods');
            $data_arr = $data->all();
      //      dump($data_arr,$product_goods,self::initial_demand_data($common_equipment));
            $demand = DemandManagement::create(self::initial_demand_data($common_equipment));
            $order = Order::create($data_arr);
            $order->order_product_goods()->attach($product_goods);
            $demand->demand_management_order()->attach($order->id);
            if(user()){
                $this->remove_user_product();
                event(new OrderSend($order)); //发送钉钉前台下单
            }
        });
    }

    //获取 主板 机箱 电源 参数
    public function get_the_main_board_cabinet_power_parameters($good, $ping_tai_lei_xing)
    {

        $data = [];
        foreach ($good as $v) {
            if ($v['product_id'] == 13) {  //主板

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
            if ($v['product_id'] == 20) { //机箱
                $data['details']['dan_jie_dian_biao_zhun_ying_pan_shu'] = $v['details']['nei_zhi_3_5_cun_ying_pan_wei'];
                $data['details']['dan_jie_dian_2_5_cun_ying_pan_shu'] = $v['details']['nei_zhi_2_5_cun_ying_pan_wei'];
                $data['details']['3_5_cun_re_cha_ba_pan_wei'] = $v['details']['3_5_cun_re_cha_ba_pan_wei'];
                $data['details']['2_5_cun_re_cha_ba_pan_wei'] = $v['details']['2_5_cun_re_cha_ba_pan_wei'];
                $data['details']['biao_zhun_guang_qu_wei'] = $v['details']['biao_zhun_guang_qu_wei'];
                $data['details']['chao_bao_guang_qu_wei'] = $v['details']['chao_bao_guang_qu_wei'];
                $data['details']['ji_xiang_shi_fou_dai_men'] = $v['details']['ji_xiang_shi_fou_dai_men'];
                $data['details']['mian_ban_jie_kou'] = $v['details']['mian_ban_jie_kou'];
                $data['details']['wai_xing_chi_cun'] = $v['details']['wai_xing_chi_cun'];
                if (!empty($v['details']['kun_bang_dian_yuan'])) { //捆绑电源
                    $power = $v->find($v['details']['kun_bang_dian_yuan']);
                    $data['details']['biao_pei_dian_yuan_lei_xing'] = $power['details']['dian_yuan_mo_shi'];
                    $data['details']['biao_pei_dian_yuan_gong_lv'] = $power['details']['dian_yuan_gong_lv'];
                }
            }
            if ($v['product_id'] == 21) { //电源
                $data['details']['biao_pei_dian_yuan_lei_xing'] = $v['details']['dian_yuan_mo_shi'];
                $data['details']['biao_pei_dian_yuan_gong_lv'] = $v['details']['dian_yuan_gong_lv'];
            }
            $data['details']['dao_gui'] = 0;
            $data['details']['cd_rom'] = 0;
            $data['details']['jian_pan_shu_biao_tao_jian'] = 0;
            if ($v['product_id'] == 24) {  //其他
                $data['details']['dao_gui'] = $v['xilie_id'] == 384 ? 1 : 0;
                $data['details']['cd_rom'] = $v['xilie_id'] == 136 ? 1 : 0;
                $data['details']['jian_pan_shu_biao_tao_jian'] = $v['xilie_id'] == 134 ? 1 : 0;
            }
        }
        $data['details']['ping_tai_lei_xing'] = $ping_tai_lei_xing['ping_tai_lei_xing'];

        $data['status'] = ["show" => 1, 'hide' => 0, "hot" => 0, "recommend" => 0, "main_current" => 0, "halt_production" => 0];
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
        if (!empty($v['details']['kun_bang_dian_yuan'])) {
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

    //获取参数
    public function getParameters($parts = '')
    {
        $arr['admins'] = Admin::pluck('name', 'account')->toArray();
        $status = MemberStatus::all();
        $i = 1;
        foreach ($status as $item) {
            $arr[$item->type][$item->identifying] = $item->name;
            if ($item->type == 'order_type') {
                $arr['order_type_code'][$item->identifying] = $i++;
            }
        }
        $admin = admin() ?? user();
        $product = Product::orderBy('bianhao', 'asc')->pluck('title', 'id')->toArray(); //获取产品
        if (!$admin->can('super edit') && $parts == '') {
            $product = array_only($product, [15, 16, 17, 18, 19, 24]);
        }
        $arr['product'] = $product;
        return $arr;
    }
}

?>