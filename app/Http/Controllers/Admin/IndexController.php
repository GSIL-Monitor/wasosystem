<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DeliverySheetExport;
use App\Models\BarcodeAssociated;
use App\Models\CommonEquipment;
use App\Models\DemandFiltrate;
use App\Models\DemandManagement;
use App\Models\DemandManagementOrder;
use App\Models\DivisionalManagement;
use App\Models\FundsManagement;
use App\Models\HistoricalTaskManagement;
use App\Models\InventoryManagement;
use App\Models\Member;
use App\Models\MemberGrade;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\OrderMaterial;
use App\Models\ProcurementPlan;
use App\Models\SupplierManagement;
use App\Models\TaskManagement;
use App\Models\UserAddress;
use App\Models\UserCompany;
use App\Models\VisitorDetail;
use App\Models\WarehouseOutManagement;
use Illuminate\Http\Request;
use App\Comdodel;
use App\Models\ProductGood;
use App\Models\Product;
use App\Models\ProductFramework;
use App\Models\ProductParamenter;
use App\Models\User;
use App\Models\Admin;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\Integration;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index()
    {
//        dd('后台首页，当前用户名：'.auth('admin')->user()->name);
        return view('admin.index.index');
    }

    public function home()
    {
        return view('admin.index.home');
    }

    public function tiao()
    {
        return view('admin.index.tiao');
    }
    public function comm(Comdodel $comdodel)
    {
        $pinyin=new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
        $pdo=\DB::connection('mysql2');

        $a=$pdo->table('waso_pingtai')->where('z4', '=', '1')->get();
        dump($a);

        set_time_limit(0);
        // $canshu=$comdodel->get();
//dd($canshu);
//        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
//            foreach ($users as $user) {
//                //
//            }
//        });
        //$canshu=$comdodel->where('z4','=','1')->get();
        // $comdodel->where('name','<>','未添加单位')->chunk(100, function ($canshu) use ($pinyin){
        // $comdodel->where([['status','=',1],['pid','=',118],['yyms','=',1]])->chunk(100, function ($canshu) use ($pinyin){
        //  $comdodel->where('z4', '=', '1')->chunk(100, function ($canshu) use ($pinyin) {
//     $comdodel->latest('xietong')->chunk(100, function ($canshu) use ($pinyin) {
//        $comdodel->chunk(100, function ($canshu) use ($pinyin) {
//        $comdodel->chunk(100, function ($canshu) use ($pinyin) {
//           $canshus = $canshu->each(function ($item, $key) use ($pinyin)
//           {
        //Framework
//               $pcanshu=new ProductFramework;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->product_id=$item->ppid;
//                $pcanshu->parent_id=$item->pid;
//                $pcanshu->save();
        //Product
//                $pcanshu=new Product;
//                $pcanshu->id=$item->id;
//                $pcanshu->title=$item->title;
//                $pcanshu->bianhao=$item->bianhao;
//                $pcanshu->jianma=$item->jianma;
        //  $pcanshu->save();
        //Product_canshu
//                $pcanshu=new ProductParamenter;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->danwei=$item->danwei;
//                $pcanshu->type=$item->tagtype;
//                $pcanshu->order=$item->sort;
//                $pcanshu->qiantai_show=$item->is_show;
//                $pcanshu->admin_show=$item->is_hshow;
//                $pcanshu->product_id=$item->sid;
//                $pcanshu->parent_id=$item->pid;
//                if(!empty($item->red_id)){
//                    $red_id=explode(',',$item->red_id);
//                    $pcanshu->parameter_pid=$red_id[0];
//                    $pcanshu->parameter_id=$red_id[1];
//                    $pcanshu->show_type='paramenters';
//                }
//                if(!empty($item->red_jg_id)){
//                    $pcanshu->parameter_id=$item->red_jg_id;
//                    $pcanshu->show_type='framework';
//                }
//               $pcanshu->save();
        //cpu
//                $pcanshu = new ProductGood;
//                $pcanshu->oldid = $item->id;
//                $pcanshu->product_id = $item->b10;
//                $pcanshu->jiagou_id = $item->b6;
//                $pcanshu->xilie_id = $item->b8;
//                $pcanshu->name = $item->a1;
//                $pcanshu->jiancheng = $item->a2;
//                $pcanshu->jianma = $item->a3;
//                $pcanshu->daima = $item->yuanchangdaima;
//                $pcanshu->price = ['retail_price'=>$item->a6,
//                                    'member_price'=>$item->a7,
//                                    'cooperation_price'=>$item->a8,
//                                    'core_price'=>$item->a9,
//                                    'cost_price'=>$item->a5,
//                                    'taobao_price'=>$item->a21
//                ];
//                $pcanshu->status = ['show'=>$item->a10 == 1 ? 0 : 1,
//                    'main_current'=>$item->a11 == 1 ? 0 : 1,
//                    'recommend'=>$item->a12 == 1 ? 0 : 1,
//                    'halt_production'=>$item->a13 == 1 ? 0 : 1,
//                    'hot'=>$item->a14 == 1 ? 0 : 1,
//                    'hide'=>$item->a15 == 1 ? 0 : 1
//                ];
//                $pcanshu->quality_time = $item->a4;
//                  $pcanshu->series_name=$item->series->name;
        //   $pcanshu->framework_name=$item->framework->name;

//                $pcanshu->pic =explode(';', $item->a18);

//             $a =explode(',','1,2,3,4,8,5,7,10,6,9,11,12');//cpu
//            $a =explode(',','15,13,22,14,19,16,21,18,20,17,24,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,41,43,44,45,46,47,689');//主板
//              $a =explode(',','48,57,49,54,55,52,53,58,50,51,56');//内存
//              $a =explode(',','59,61,62,60,64,65,63,66');//硬盘
//              $a =explode(',','75,77,79,80,76,78,81,82');//显卡
//                $a =explode(',','72,68,67,656,70,71,73,69,74');//阵列卡
//                 $a =explode(',','83,86,85,87,84,88');//网卡
//                $a =explode(',','89,91');//专用卡
//                $a =explode(',','92,93,95,96,97,101,102,99,100,98,104,105,94,103,693');//机箱
//             $a =explode(',','106,107,109,110,108,691,692,738');//电源
//                $a =explode(',','112,113,114,115,680,684,116');//散热器
//             $a = explode(',', '');//其他
//                if (!empty(array_filter($a))) {
//                    foreach ($a as $k => $v) {
//                        $p=new ProductParamenter;
//                        $pn=$p->find($v);
////                        echo $pn->name;
//                        $k++;
//                        $b = 'g' . $k;
//                        $va = explode(',', $item->$b);
//                        if (count($va) >= 1 && $pn->type =='checkbox') {
//                            $c[strtolower($pinyin->permalink($pn->name,'_'))] = $va;
//                        }elseif (count($va) >= 1 && $pn->type =='radio'){
//                            $c[strtolower($pinyin->permalink($pn->name,'_'))] = $item->$b ==2 ? 0 :1;
//                        }else {
//                            if ($item->$b == '') {
//                                $c[strtolower($pinyin->permalink($pn->name,'_'))] = null;
//                            } else {
//                                $c[strtolower($pinyin->permalink($pn->name,'_'))] = $item->$b;
//                            }
//
//                        }
//
//                    }
//                   //dump(json_encode($c,true));
//            //      dump($zh);
//                    $pcanshu->details = $c;
//
//               }
//      $ss= $pcanshu->save();

        //Admin
//                $pcanshu=new Admin;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->account=$item->account;
//                $pcanshu->password=bcrypt(123456);
//                $pcanshu->qq=$item->qq;
//                $pcanshu->email=$item->email;
//                $pcanshu->phone=$item->tel;
//                if($item->ruzhitime != -28800){
//                $pcanshu->entryed_at=date('Y-m-d H:i:s',$item->ruzhitime);
//                $pcanshu->social_securityed_at=date('Y-m-d H:i:s',$item->sbstarttime);;
//                $pcanshu->pacted_at=date('Y-m-d H:i:s',$item->htendtime);
//                }
//                $pcanshu->login_count=$item->login_count;
//                $pcanshu->save();
        /*---------------------- complete_machines ---------------------*/
//                $pcanshu = new CompleteMachine;
//                $pcanshu->id = $item->id;
//                $pcanshu->name = $item->name;
//                $pcanshu->code = $item->peizhi;
//                foreach(explode(',',$item->cat) as $v){
//                    $jiagou[strtolower($pinyin->permalink($v,'_'))]=$v;
//                }
//                $pcanshu->jiagou =$jiagou;
//                if(!empty($item->gnms)){
//                    foreach(explode(',',$item->gnms) as $v){
//                        $application[strtolower($pinyin->permalink($v,'_'))]=$v;
//                    }
//                }else{
//                    foreach(explode(',',$item->sxcs) as $v){
//                        $application[strtolower($pinyin->permalink($v,'_'))]=$v;
//                    }
//                }
//                $pcanshu->application =$application;
//                $pcanshu->price = [ 'retail_price'=>$item->jiage1,
//                                    'member_price'=>$item->jiage2,
//                                    'cooperation_price'=>$item->jiage3,
//                                    'core_price'=>$item->jiage4,
//                                    'cost_price'=>$item->jiage,
//                                    'taobao_price'=>$item->wsjiage
//                ];
//                $pcanshu->additional_arguments = [ 'mm'=>$item->guige,
//                                                    'product_description'=>$item->canshu,
//                                                    'humidity'=>$item->shidu,
//                                                    'system'=>$item->xitong,
//                                                    'page_description'=>$item->miaoshu,
//
//                ];
//                $pcanshu->status = [ 'show'=>$item->is_post==2?1:0,
//                                     'recommend'=>$item->tuijian==2?1:0,
//                ];
//                $pcanshu->weight=is_numeric($item->qita) ? $item->qita:0;
//                if($item->yingxiao==0){
//                    $pcanshu->marketing='none';
//                }elseif ($item->yingxiao==1){
//                    $pcanshu->marketing='new';
//                }elseif ($item->yingxiao==2){
//                    $pcanshu->marketing='hot';
//                }elseif ($item->yingxiao==3){
//                    $pcanshu->marketing='moods';
//                }elseif ($item->yingxiao==4){
//                    $pcanshu->marketing='sale';
//                }
//                $pcanshu->quality_time=$item->zhibao;
//                $pcanshu->details=$item->content;
//                $pcanshu->parent_id=$item->type;
//
//           $pcanshu->save();
//
        /*---------------------- complete_machine_product_goods ---------------------*/
//               $pcanshu = new CompleteMachine;
//                $p=$pcanshu->find($item->zjid);
//                $g=new ProductGood;
//                $pw=$g->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->complete_machine_product_goods()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao]);
//                }
        /*---------------------- sCompleteMachineFrameworks ---------------------*/
//               $pcanshu = new CompleteMachineFrameworks;
//               $pcanshu->name=$item->name;//
//               $pcanshu->order=$item->sort;
//               $pcanshu->select_type=$item->types==1?'radio':'checkbox';
//               $pcanshu->category="filtrate";
//
//              // dump($pcanshu);
//               $pcanshu->save();
        /*---------------------- elf_build_terraces ---------------------*/
//               $pcanshu = new ProductGood();
//               $p=$pcanshu->whereProductId(23)->whereOldid($item->pid)->first();
//                $pw=$pcanshu->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->product_goods_self_build_terrace()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao]);
//                }
        /*---------------------- integrations ---------------------*/
//               $pcanshu = new Integration();
//               $pcanshu->id=$item->id;
//               $pcanshu->name=$item->name;
//               $pcanshu->parent_id=1;
//               $pcanshu->pic=explode(',',$item->pic);
//               $pcanshu->details=$item->content;
//               $pcanshu->description=$item->des;
//               $pcanshu->click=$item->click;
//               $pcanshu->show=$item->post==2?1:0;dump($pcanshu);
        // $pcanshu->save();
        /*---------------------- members ---------------------*/
//               $pcanshu = new User();
//               $pcanshu->id=$item->userid;
//                $pcanshu->oid=$item->oldid ?? 0;
//               $pcanshu->unit=$item->dwjc;
//               $pcanshu->username=$item->username;
//               $pcanshu->nickname=$item->nickname;
//               $pcanshu->password=bcrypt($item->c);
//               $pcanshu->clear_text=encrypt($item->c);
//               $pcanshu->sex=$item->sex==1?'Mr':$item->sex==2?'lady':'privary';
//               $pcanshu->birthday=$item->borthday;
//               $pcanshu->phone=$item->mobile;
//               $pcanshu->telephone=$item->telephone;
//               $pcanshu->email=$item->email;
//               $pcanshu->wechat=$item->weixin;
//               $pcanshu->qq=$item->qq;
//               $pcanshu->industry=$item->hangye;
//               $pcanshu->address=$item->address;
////               $jibie=MemberGrade::pluck('id','identifying');
//                if($item->vip ==12){
//                    $pcanshu->grade='unverified';
//                }//未认证
//                 if($item->vip ==10){
//                    $pcanshu->grade='blocked_account';
//                }//冻结账户
//                 if($item->vip ==1){
//                     $pcanshu->grade='retail_price';
//                 }//零售价格
//                 if($item->vip ==11){
//                     $pcanshu->grade='taobao_price';
//                 }// 淘宝价
//                 if($item->vip ==2 || $item->vip ==6){
//                     $pcanshu->grade='member_price';
//                 }////会员价
//                 if($item->vip ==3 || $item->vip ==7){
//                     $pcanshu->grade='cooperation_price';
//                 }//合作价
//                 if($item->vip ==4 || $item->vip ==8){
//                     $pcanshu->grade='core_price';
//                 }//核心价
//                 if($item->vip ==5 || $item->vip ==9){
//                     $pcanshu->grade='cost_price';
//                 }//成本价
//               if($item->kefu!=null || $item->kefu!=''){
//                   $admin=Admin::whereAccount($item->kefu)->first();
//                   $pcanshu->administrator=$admin->id;
//               }else{
//                   $pcanshu->administrator=0;
//               }
//                 $pcanshu->payment_days=$item->zhangqi;
//                 $pcanshu->tax_rate=$item->shuidian==50?1:10;
//                 if($item->infotype==1){$pcanshu->message_type='phone_receiving';}
//                 if($item->infotype==2){$pcanshu->message_type='email_receiving';}
//                 if($item->infotype==3){$pcanshu->message_type='all_receiving';}
//                 if($item->infotype==4){$pcanshu->message_type='no_receiving';}
//                 $pcanshu->parts_buy=$item->is_peijian==1?0:1;
//                 $pcanshu->register_ip=$item->regip;
//                 $pcanshu->last_login_ip=$item->last_login_ip;
//                 $pcanshu->login_count=$item->loginnum;
//                 $pcanshu->last_login_time=date('Y-m-d H:i:s',$item->lastdate);
//                 $pcanshu->deal=$item->chengjiao ==1?1:0;
//                 $pcanshu->avatar=[];
//                 $pcanshu->parameters=[];
//                 $pcanshu->created_at=date('Y-m-d H:i:s',$item->regdate);
//
//                 $pcanshu->save();
        /*---------------------- user_address ---------------------*/
//               $pcanshu = new UserAddress();
//               $a=User::whereId($item->userid)->first();
//               if($a){
//                   $pcanshu->id=$item->wlid;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->address=$item->address;
//                   $pcanshu->name=$item->shouhuoren;
//                   $pcanshu->phone=$item->tel;
//                   $pcanshu->alternative_phone=$item->bytel;
//                   $pcanshu->logistics=$item->wlzhiding;
//                   $pcanshu->default=$item->status==1?false:true;
//                   $pcanshu->number=$item->bianhao;
//                   $pcanshu->zip=$item->youbian;
//            //   $pcanshu->save();
//               }

        // dump($pcanshu);

        /*---------------------- user_companies ---------------------*/
//               $pcanshu = new UserCompany();
//               $a=User::whereId($item->userid)->first();
//               $invoice=MemberStatus::whereType('invoice')->pluck('identifying','name')->toArray();
//               if($a){
//                   $pcanshu->id=$item->qiyeid;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->address=$item->address;
//                   $pcanshu->name=$item->name;
//                   $pcanshu->unit=$item->dwjc;
//                   $pcanshu->unit_code=$item->dwjm;
//                   $pcanshu->unit_phone=$item->tel;
//                   $pcanshu->fax=$item->ctel;
//                   $pcanshu->zip=$item->youbian;
//                   $pcanshu->url=$item->url;
//                   $pcanshu->tax_mode=$invoice[$item->shuimoshi] ?? 'no_invoice';
//                   $pcanshu->tax_number=$item->shuihao;
//                   $pcanshu->account=$item->zhanghao;
//                   $pcanshu->opening_bank=$item->kaihuhang;
//                   $pcanshu->bank_address=$item->khhaddress;
//                   $pcanshu->bank_phone=$item->khhtel;
//                   $pcanshu->finance=$item->caiwu;
//                   $pcanshu->finance_phone=$item->cwtel;
//                   $pcanshu->logistics=$item->zhiding;
//                   $pcanshu->number=$item->bianhao;
//                   $pcanshu->default=$item->status==1?false:true;
        // $pcanshu->save();

        //   }

//               /*---------------------- visitor_details ---------------------*/
//             $pcanshu = new VisitorDetail();
//               if($item->userid){
//                $user=User::whereId($item->userid)->first();
//               if($user) {
//               $pcanshu->id=$item->id;
//               $pcanshu->user_id=$user->id;
//               $pcanshu->source=$item->laiyuan;
//               $pcanshu->nickname=$item->nickname;
//               $pcanshu->industry=$item->hangye;
//               $pcanshu->address=$item->address;
//               $pcanshu->search=$item->sousuoci;
//               $pcanshu->key=$item->guanjianci;
//               $pcanshu->phone=$item->phone;
//               $pcanshu->email=$item->email;
//               $pcanshu->wechat=$item->wechat;
//               $pcanshu->qq=$item->qq;
//               $pcanshu->admin=$item->admin;
//               $pcanshu->details=$item->des;
//               $pcanshu->contact_count=$item->lianxi==1?'one':'two';
//               $pcanshu->valid=$item->youxiao==1?'no':'yes';
//               $pcanshu->created_at=$item->fwtime;
//                   $user->visitor_details()->update($pcanshu->only(["nickname",
//                       "industry",
//                       "address",
//                       "phone",
//                       "email",
//                       "wechat",
//                       "qq"
//                   ]));
//                   $pcanshu->save();
//                   }
//               }

        /*---------------------- orders ---------------------*/
//               $pcanshu = new Order();
//               $pcanshu->id=$item->orderid;
//               $pcanshu->user_id=$item->userid;
//               if($item->userid){
//                   $user=User::whereId($item->userid)->first();
//                   if($user) {
//                       $pcanshu->serial_number = $item->orderhao;
//                       $pcanshu->machine_model = $item->xinghao;
//                       $pcanshu->code = $item->peizhi;
//                       $pcanshu->unit_price = $item->danjia == null ? 0 : $item->danjia;
//                       $pcanshu->total_prices = $item->price == null ? 0 : $item->price;
//                       $pcanshu->price_spread = $item->chae;
//                       $pcanshu->num = $item->dgshu;
//                       if ($item->orderms == 1) {
//                           $pcanshu->order_type = 'parts';
//                       }
//                       if ($item->orderms == 2) {
//                           $pcanshu->order_type = 'waso_complete_machine';
//                       }
//                       if ($item->orderms == 3) {
//                           $pcanshu->order_type = 'custom_complete_machine';
//                       }
//                       if ($item->orderms == 4) {
//                           $pcanshu->order_type = 'designer_computer';
//                       }
//
//                       if ($item->orderstatus == 0) {
//                           $pcanshu->order_status = 'intention_to_order';
//                       }
//                       if ($item->orderstatus == 1) {
//                           $pcanshu->order_status = 'placing_orders';
//                       }
//                       if ($item->orderstatus == 2) {
//                           $pcanshu->order_status = 'order_acceptance';
//                       }
//                       if ($item->orderstatus == 3) {
//                           $pcanshu->order_status = 'in_transportation';
//                       }
//                       if ($item->orderstatus == 4) {
//                           $pcanshu->order_status = 'arrival _of_goods';
//                       }
//
//                       if ($item->send == 0) {
//                           $pcanshu->message_status = 'intention_to_order';
//                       }
//                       if ($item->send == 1) {
//                           $pcanshu->message_status = 'placing_orders';
//                       }
//                       if ($item->send == 2) {
//                           $pcanshu->message_status = 'order_acceptance';
//                       }
//                       if ($item->send == 3) {
//                           $pcanshu->message_status = 'in_transportation';
//                       }
//
//                       if ($item->kxstatus == 0) {
//                           $pcanshu->payment_status = 'pay_first';
//                       }
//                       if ($item->kxstatus == 1) {
//                           $pcanshu->payment_status = 'pay_on_delivery';
//                       }
//                       if ($item->kxstatus == 2) {
//                           $pcanshu->payment_status = 'taobao_pay';
//                       }
//                       if ($item->kxstatus == 3) {
//                           $pcanshu->payment_status = 'payment_days_user';
//                       }
//                       if ($item->kxstatus == 4) {
//                           $pcanshu->payment_status = 'pay_in_advance';
//                       }
//                       if ($item->kxstatus == 5) {
//                           $pcanshu->payment_status = 'account_paid';
//                       }
//
//                       if ($item->fwstatus == 0) {
//                           $pcanshu->service_status = 0;
//                       }
//                       if ($item->fwstatus == 1) {
//                           $pcanshu->service_status = 400;
//                       }
//                       if ($item->fwstatus == 2) {
//                           $pcanshu->service_status = 1200;
//                       }
//                       if ($item->fwstatus == 3) {
//                           $pcanshu->service_status = 3600;
//                       }
//
//                       if (empty($item->fptype)) {
//                           $pcanshu->invoice_type = 'no_invoice';
//                       }
//                       if ($item->fptype == 1) {
//                           $pcanshu->invoice_type = 'tax_invoice';
//                       }
//                       if ($item->fptype == 2) {
//                           $pcanshu->invoice_type = 'vat_special_invoice';
//                       }
//
//                       $pcanshu->invoice_info = $item->fpinfo;
//                       $pcanshu->logistics_id = $item->wladdress == null ? 0 : $item->wladdress;
//                       $pcanshu->logistics_info = $item->wlinfo;
//                       $pcanshu->parcel_count = $item->jiannum;
//                       $pcanshu->user_remark = $item->ddyaoqiu;
//                       $pcanshu->company_remark = $item->des;
//                       $pcanshu->urgent = $item->is_jiaji == 1 ? true : false;
//                       $pcanshu->flow_pic = $item->is_picshow == 1 ? true : false;
//                       $pcanshu->in_common_use = $item->changyong == 2 ? true : false;
//                       $pcanshu->pic = $item->dpic ? explode(';', $item->dpic) : [];
//                       $pcanshu->market = $item->xiaoshou;
//                       $pcanshu->participation_admin = [
//                           'acceptance' => $item->shouli ? explode('/', $item->shouli) : [],
//                           'skill' => $item->jishu ? explode('/', $item->jishu) : [],
//                           'pack' => $item->dabao ? explode('/', $item->dabao) : [],
//                       ];
//                       $pcanshu->admin = $item->admin;
//                       $pcanshu->created_at = date('Y-m-d H:i:s', $item->tjordertime);
//                       $pcanshu->updated_at = $item->edittime==null?date('Y-m-d H:i:s', $item->tjordertime):date('Y-m-d H:i:s', $item->edittime);
//                       $pcanshu->deleted_at = $item->is_del == 2 ? date('Y-m-d H:i:s', time()) : null;
//                  //   $pcanshu->save();
//                   }}

        // dump($pcanshu);
        /*---------------------- order_materials ---------------------*/
        //php artisan insert:data data

        /*---------------------- common_equipments ---------------------*/
//                 $pcanshu = new CommonEquipment();
//                  $pcanshu->id=$item->id;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->order_id=$item->orderid;
//                   $pcanshu->name=$item->name;
//                      $pcanshu->machine_model = $item->xinghao;
//                       $pcanshu->code = $item->peizhi;
//                       $pcanshu->unit_price = $item->danjia == null ? 0 : $item->danjia;
//                       $pcanshu->total_prices = $item->price == null ? 0 : $item->price;
//                       $pcanshu->num = $item->dgshu;
//                         $pcanshu->user_remark = $item->ddyaoqiu;
//                       $pcanshu->company_remark = $item->des;
//                       $pcanshu->market = $item->xiaoshou;
//                       $pcanshu->old_prices= $item->oldprice;
//                         if ($item->orderms == 1) {
//                           $pcanshu->order_type = 'parts';
//                       }
//                       if ($item->orderms == 2) {
//                           $pcanshu->order_type = 'waso_complete_machine';
//                       }
//                       if ($item->orderms == 3) {
//                           $pcanshu->order_type = 'custom_complete_machine';
//                       }
//                       if ($item->orderms == 4) {
//                           $pcanshu->order_type = 'designer_computer';
//                       }
//                     if ($item->fwstatus == 0) {
//                           $pcanshu->service_status = 0;
//                       }
//                       if ($item->fwstatus == 1) {
//                           $pcanshu->service_status = 400;
//                       }
//                       if ($item->fwstatus == 2) {
//                           $pcanshu->service_status = 1200;
//                       }
//                       if ($item->fwstatus == 3) {
//                           $pcanshu->service_status = 3600;
//                       }
//
//                       if (empty($item->fptype)) {
//                           $pcanshu->invoice_type = 'no_invoice';
//                       }
//                       if ($item->fptype == 1) {
//                           $pcanshu->invoice_type = 'tax_invoice';
//                       }
//                       if ($item->fptype == 2) {
//                           $pcanshu->invoice_type = 'vat_special_invoice';
//                       }
//                        $pcanshu->invoice_type = 'vat_special_invoice';
//                         $pcanshu->save();
        /*---------------------- common_equipment_materials ---------------------*/
//                 $pcanshu = new CommonEquipment;
//                $p=$pcanshu->find($item->orderid);
//                $g=new ProductGood;
//                $pw=$g->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->common_equipment_product_goods()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao,'product_good_price'=>$item->danjia,'product_good_raid'=>$item->raid]);
//                }
        /*---------------------- demand_filtrates ---------------------*/
//                 $pcanshu = new DemandFiltrate();
//                 $pcanshu->id=$item->id;
//                 $pcanshu->name=$item->name;
//                 $pcanshu->parent_id=$item->pid;
//                 $pcanshu->category=$item->type ===1 ?  'issue' : 'answer';
//               $pcanshu->save();
        /*---------------------- demand_filtrates ---------------------*/
        //php artisan insert:data data
        /*---------------------- divisional_managements ---------------------*/
//             $pcanshu = new DivisionalManagement();
//               $pcanshu->id=$item->id;
//               $pcanshu->name=$item->name;
//               $pcanshu->parent_id=$item->pid;
//               if($item->status ==1){
//                   $pcanshu->identifying='company';
//               }
//               if($item->status ==2){
//                   $pcanshu->identifying='department';
//               }
//               if($item->status ==3){
//                   $pcanshu->identifying='group';
//               }
////
//           $pcanshu->save();//首先添加部门  然后注释 在执行下面if里面的代码
//               if(!empty($item->chengyuan)){
//                   $admin=Admin::whereIn('account',explode(';',$item->chengyuan))->get();
//                   if($admin->isNotEmpty()){
//                       foreach ($admin as $value){
//                           $pcanshu1 = new DivisionalManagement();
//                           $pcanshu1->name=$value->name;
//                           $pcanshu1->parent_id=$item->id;
//                           $pcanshu1->admin_id=$value->id;
//                           $pcanshu1->identifying='member';
//                           $pcanshu1->save();
//                       }
//                   }
//               }
        /*---------------------- task_managements ---------------------*/
//               $pcanshu = new TaskManagement();
//               if(!empty($item->chengyuan)){
//                   $admins=Admin::whereAccount($item->chengyuan)->first();
//                   $admin=DivisionalManagement::whereAdminId($admins->id)->first();
//                   $pcanshu->divisional_id=$admin->id;
//               }else{
//                   if(!empty($item->zudui)){
//                       $pcanshu->divisional_id=$item->zudui;
//                   }else{
//                       if(!empty($item->bumen)){
//                           $pcanshu->divisional_id=$item->bumen;
//                       }else{
//                           $pcanshu->divisional_id=$item->gongsi;
//                       }
//                   }
//               }
//               if($item->moshi == 1){
//                   $pcanshu->task_mode='single';
//               }else{
//                   $pcanshu->task_mode='multiterm';
//               }
//               $pcanshu->goal=(int)$item->arw;
//               $pcanshu->guaranteed_task=(int)$item->abrw;
//               $pcanshu->award_coefficient=(int)$item->jlxs;
//               $pcanshu->goal_two=(int)$item->b2mb;
//               $pcanshu->award_coefficient_two=(int)$item->b2xs;
//               $pcanshu->goal_three=(int)$item->b3mb;
//               $pcanshu->award_coefficient_three=(int)$item->b3mb;
//               $pcanshu->punish_index=(int)$item->cfbz;
//               $pcanshu->award_index=(int)$item->jlbz;
//               $pcanshu->units_index=(int)$item->dwzb;
//               $pcanshu->save();
        /*---------------------- funds_managements ---------------------*/
        //php artisan insert:data data
        /*---------------------- historical_task_managements ---------------------*/
//               $pcanshu = new HistoricalTaskManagement();
//                if($item->duixiang >= 800){
//                    $admin=Admin::whereAccount($item->duixiang)->first();
//                    $Divisional=DivisionalManagement::whereAdminId($admin->id)->first();
//                    if($Divisional){
//                    $pcanshu->divisional_id=$Divisional->id;
//                    $pcanshu->goal=$item->mubiao;
//                    $pcanshu->guaranteed_task=$item->baodi;
//                    $pcanshu->returned_money=$item->huikuan;
//                    $pcanshu->monthly_sales=$item->xiaoshou;
//                    $pcanshu->outstanding=$item->weijie;
//                    $pcanshu->punish_award=$item->jiangcheng;
//                    $pcanshu->year=$item->year;
//                    $pcanshu->mouth=$item->mouth;
//                    $pcanshu->save();
//                    }
//                }else{
//                    $ybumen=\DB::table('waso_ybumen')->whereId($item->duixiang)->first();
//                    if($ybumen){
//                        $Divisional=DivisionalManagement::whereName($ybumen->name)->first();
//                        if($Divisional){
//                            $pcanshu->divisional_id=$Divisional->id;
//                            $pcanshu->goal=$item->mubiao;
//                            $pcanshu->guaranteed_task=$item->baodi;
//                            $pcanshu->returned_money=$item->huikuan;
//                            $pcanshu->monthly_sales=$item->xiaoshou;
//                            $pcanshu->outstanding=$item->weijie;
//                            $pcanshu->punish_award=$item->jiangcheng;
//                            $pcanshu->year=$item->year;
//                            $pcanshu->mouth=$item->mouth;
//                            $pcanshu->save();
//                        }
//                    }
////
//                }

        /*---------------------- supplier_managements ---------------------*/
        //  $pcanshu = new SupplierManagement();
//              $pcanshu->id=$item->id;
//              $pcanshu->name=$item->name;
//              $pcanshu->code=$item->jianma;
//              $pcanshu->phone=$item->tel;
//              $pcanshu->address=$item->address;
//              $admin=Admin::whereAccount($item->admin)->first();
//              $pcanshu->admin=$admin->id;
//               $pcanshu->linkman=$admin->user;
//               $pcanshu->save();
        /*---------------------- procurement_plans ---------------------*/
        //php artisan insert:data data
        /*---------------------- inventory_managements ---------------------*/
//               $pcanshu = new InventoryManagement();
//               $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
//               if($good){
//                   $pcanshu->product_id= $item->cplx;
//                   $pcanshu->product_good_id= $good->id;
//                   $pcanshu->new= $item->xpsl>=0 ? $item->xpsl : 0;
//                   $pcanshu->good= $item->lpsl>=0 ? $item->lpsl : 0;
//                   $pcanshu->bad= $item->hhsl>=0 ? $item->hhsl : 0;
//                   $pcanshu->return_factory= $item->fcsl>=0 ? $item->fcsl : 0;
//                   $pcanshu->proxies= $item->dgsl>=0 ? $item->dgsl : 0;
//                   $pcanshu->test= $item->cspsl>=0 ? $item->cspsl : 0;
//                   $pcanshu->warning= $item->bjx>=0 ? $item->bjx : 0;
//                   $pcanshu->save();
//               }
        /*---------------------- warehouse_out_managements ---------------------*/
        //php artisan insert:data data
        /*---------------------- barcode_associated ---------------------*/


//         });
//        });

    }
    public function comm2(Comdodel $comdodel)
    {
        $pinyin=new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
        $pdo=\DB::connection('mysql2');
            $a=$pdo->table('waso_pingtai')->where('z4', '=', '1')->limit(2)->get();
            dump($a);
//        $canshu=$comdodel->where('z4', '=', '1')->limit(2)->get();
//            foreach ($canshu as $key => $item) {
//                    //$a = explode(',', '15,13,22,14,19,16,21,18,20,17,24,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,41,43,44,45,46,47,689');//主板
//           //  $a=explode(',',"119,120,129,130,122,121,128,124,127,125,123,126,131,132,133,134,135,136,137,153,155,154,144,145,138,139,140,141,142,143,560,561,562,146,147,148,555,150,151,156,157,149,152,654,655,687,690,710,711"); //平台
//              //  $a =explode(',','92,93,95,96,97,101,102,99,100,98,104,105,94,103,693');//机箱
//                $a =explode(',','106,107,109,110,108,691,692,738');//电源
//                    if (!empty(array_filter($a))) {
//                        foreach ($a as $k => $v) {
//                            $p = new ProductParamenter;
//                            $pn = $p->find($v);
////                        echo $pn->name;
//                            $k++;
//                            $b = 'g' . $k;
//                            $va = explode(',', $item->$b);
//                            if (count($va) >= 1 && $pn->type == 'checkbox') {
//                                $zh[strtolower($pinyin->permalink($pn->name, '_'))] = $b;
//                            } elseif (count($va) >= 1 && $pn->type == 'radio') {
//                                $zh[strtolower($pinyin->permalink($pn->name, '_'))] = $b;
//                            } else {
//                                if ($item->$b == '') {
//                                    $zh[strtolower($pinyin->permalink($pn->name, '_'))] = $b;
//                                } else {
//                                    $zh[strtolower($pinyin->permalink($pn->name, '_'))] = $b;
//                                }
//
//                            }
//
//                        }
////                   //dump(json_encode($c,true));
//                        dump($zh);
//                    }
//                }
        set_time_limit(0);
        // $canshu=$comdodel->get();
//dd($canshu);
//        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
//            foreach ($users as $user) {
//                //
//            }
//        });
        //$canshu=$comdodel->where('z4','=','1')->get();
   // $comdodel->where('name','<>','未添加单位')->chunk(100, function ($canshu) use ($pinyin){
  // $comdodel->where([['status','=',1],['pid','=',118],['yyms','=',1]])->chunk(100, function ($canshu) use ($pinyin){
   //  $comdodel->where('z4', '=', '1')->chunk(100, function ($canshu) use ($pinyin) {
//     $comdodel->latest('xietong')->chunk(100, function ($canshu) use ($pinyin) {
//        $comdodel->chunk(100, function ($canshu) use ($pinyin) {
//        $comdodel->chunk(100, function ($canshu) use ($pinyin) {
//           $canshus = $canshu->each(function ($item, $key) use ($pinyin)
//           {
                //Framework
//               $pcanshu=new ProductFramework;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->product_id=$item->ppid;
//                $pcanshu->parent_id=$item->pid;
//                $pcanshu->save();
                //Product
//                $pcanshu=new Product;
//                $pcanshu->id=$item->id;
//                $pcanshu->title=$item->title;
//                $pcanshu->bianhao=$item->bianhao;
//                $pcanshu->jianma=$item->jianma;
                //  $pcanshu->save();
                //Product_canshu
//                $pcanshu=new ProductParamenter;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->danwei=$item->danwei;
//                $pcanshu->type=$item->tagtype;
//                $pcanshu->order=$item->sort;
//                $pcanshu->qiantai_show=$item->is_show;
//                $pcanshu->admin_show=$item->is_hshow;
//                $pcanshu->product_id=$item->sid;
//                $pcanshu->parent_id=$item->pid;
//                if(!empty($item->red_id)){
//                    $red_id=explode(',',$item->red_id);
//                    $pcanshu->parameter_pid=$red_id[0];
//                    $pcanshu->parameter_id=$red_id[1];
//                    $pcanshu->show_type='paramenters';
//                }
//                if(!empty($item->red_jg_id)){
//                    $pcanshu->parameter_id=$item->red_jg_id;
//                    $pcanshu->show_type='framework';
//                }
//               $pcanshu->save();
                //cpu
//                $pcanshu = new ProductGood;
//                $pcanshu->oldid = $item->id;
//                $pcanshu->product_id = $item->b10;
//                $pcanshu->jiagou_id = $item->b6;
//                $pcanshu->xilie_id = $item->b8;
//                $pcanshu->name = $item->a1;
//                $pcanshu->jiancheng = $item->a2;
//                $pcanshu->jianma = $item->a3;
//                $pcanshu->daima = $item->yuanchangdaima;
//                $pcanshu->price = ['retail_price'=>$item->a6,
//                                    'member_price'=>$item->a7,
//                                    'cooperation_price'=>$item->a8,
//                                    'core_price'=>$item->a9,
//                                    'cost_price'=>$item->a5,
//                                    'taobao_price'=>$item->a21
//                ];
//                $pcanshu->status = ['show'=>$item->a10 == 1 ? 0 : 1,
//                    'main_current'=>$item->a11 == 1 ? 0 : 1,
//                    'recommend'=>$item->a12 == 1 ? 0 : 1,
//                    'halt_production'=>$item->a13 == 1 ? 0 : 1,
//                    'hot'=>$item->a14 == 1 ? 0 : 1,
//                    'hide'=>$item->a15 == 1 ? 0 : 1
//                ];
//                $pcanshu->quality_time = $item->a4;
//                  $pcanshu->series_name=$item->series->name;
                 //   $pcanshu->framework_name=$item->framework->name;

//                $pcanshu->pic =explode(';', $item->a18);
//            $a=explode(',',"119,120,129,130,122,121,128,124,127,125,123,126,131,132,133,134,135,136,137,153,155,154,144,145,138,139,140,141,142,143,560,561,562,146,147,148,555,150,151,156,157,149,152,654,655,687,690,710,711"); //平台
//             $a =explode(',','1,2,3,4,8,5,7,10,6,9,11,12');//cpu
//            $a =explode(',','15,13,22,14,19,16,21,18,20,17,24,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,41,43,44,45,46,47,689');//主板
//              $a =explode(',','48,57,49,54,55,52,53,58,50,51,56');//内存
//              $a =explode(',','59,61,62,60,64,65,63,66');//硬盘
//              $a =explode(',','75,77,79,80,76,78,81,82');//显卡
//                $a =explode(',','72,68,67,656,70,71,73,69,74');//阵列卡
//                 $a =explode(',','83,86,85,87,84,88');//网卡
//                $a =explode(',','89,91');//专用卡
//                $a =explode(',','92,93,95,96,97,101,102,99,100,98,104,105,94,103,693');//机箱
//             $a =explode(',','106,107,109,110,108,691,692,738');//电源
//                $a =explode(',','112,113,114,115,680,684,116');//散热器
//             $a = explode(',', '');//其他
//                if (!empty(array_filter($a))) {
//                    foreach ($a as $k => $v) {
//                        $p=new ProductParamenter;
//                        $pn=$p->find($v);
////                        echo $pn->name;
//                        $k++;
//                        $b = 'g' . $k;
//                        $va = explode(',', $item->$b);
//                        if (count($va) >= 1 && $pn->type =='checkbox') {
//                            $c[strtolower($pinyin->permalink($pn->name,'_'))] = $va;
//                        }elseif (count($va) >= 1 && $pn->type =='radio'){
//                            $c[strtolower($pinyin->permalink($pn->name,'_'))] = $item->$b ==2 ? 0 :1;
//                        }else {
//                            if ($item->$b == '') {
//                                $c[strtolower($pinyin->permalink($pn->name,'_'))] = null;
//                            } else {
//                                $c[strtolower($pinyin->permalink($pn->name,'_'))] = $item->$b;
//                            }
//
//                        }
//
//                    }
//                   //dump(json_encode($c,true));
//            //      dump($zh);
//                    $pcanshu->details = $c;
//
//               }
//      $ss= $pcanshu->save();

                //Admin
//                $pcanshu=new Admin;
//                $pcanshu->id=$item->id;
//                $pcanshu->name=$item->name;
//                $pcanshu->account=$item->account;
//                $pcanshu->password=bcrypt(123456);
//                $pcanshu->qq=$item->qq;
//                $pcanshu->email=$item->email;
//                $pcanshu->phone=$item->tel;
//                if($item->ruzhitime != -28800){
//                $pcanshu->entryed_at=date('Y-m-d H:i:s',$item->ruzhitime);
//                $pcanshu->social_securityed_at=date('Y-m-d H:i:s',$item->sbstarttime);;
//                $pcanshu->pacted_at=date('Y-m-d H:i:s',$item->htendtime);
//                }
//                $pcanshu->login_count=$item->login_count;
//                $pcanshu->save();
                /*---------------------- complete_machines ---------------------*/
//                $pcanshu = new CompleteMachine;
//                $pcanshu->id = $item->id;
//                $pcanshu->name = $item->name;
//                $pcanshu->code = $item->peizhi;
//                foreach(explode(',',$item->cat) as $v){
//                    $jiagou[strtolower($pinyin->permalink($v,'_'))]=$v;
//                }
//                $pcanshu->jiagou =$jiagou;
//                if(!empty($item->gnms)){
//                    foreach(explode(',',$item->gnms) as $v){
//                        $application[strtolower($pinyin->permalink($v,'_'))]=$v;
//                    }
//                }else{
//                    foreach(explode(',',$item->sxcs) as $v){
//                        $application[strtolower($pinyin->permalink($v,'_'))]=$v;
//                    }
//                }
//                $pcanshu->application =$application;
//                $pcanshu->price = [ 'retail_price'=>$item->jiage1,
//                                    'member_price'=>$item->jiage2,
//                                    'cooperation_price'=>$item->jiage3,
//                                    'core_price'=>$item->jiage4,
//                                    'cost_price'=>$item->jiage,
//                                    'taobao_price'=>$item->wsjiage
//                ];
//                $pcanshu->additional_arguments = [ 'mm'=>$item->guige,
//                                                    'product_description'=>$item->canshu,
//                                                    'humidity'=>$item->shidu,
//                                                    'system'=>$item->xitong,
//                                                    'page_description'=>$item->miaoshu,
//
//                ];
//                $pcanshu->status = [ 'show'=>$item->is_post==2?1:0,
//                                     'recommend'=>$item->tuijian==2?1:0,
//                ];
//                $pcanshu->weight=is_numeric($item->qita) ? $item->qita:0;
//                if($item->yingxiao==0){
//                    $pcanshu->marketing='none';
//                }elseif ($item->yingxiao==1){
//                    $pcanshu->marketing='new';
//                }elseif ($item->yingxiao==2){
//                    $pcanshu->marketing='hot';
//                }elseif ($item->yingxiao==3){
//                    $pcanshu->marketing='moods';
//                }elseif ($item->yingxiao==4){
//                    $pcanshu->marketing='sale';
//                }
//                $pcanshu->quality_time=$item->zhibao;
//                $pcanshu->details=$item->content;
//                $pcanshu->parent_id=$item->type;
//
//           $pcanshu->save();
//
                /*---------------------- complete_machine_product_goods ---------------------*/
//               $pcanshu = new CompleteMachine;
//                $p=$pcanshu->find($item->zjid);
//                $g=new ProductGood;
//                $pw=$g->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->complete_machine_product_goods()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao]);
//                }
               /*---------------------- self_build_terraces ---------------------*/
//               $pcanshu = new CompleteMachineFrameworks;
//               $pcanshu->name=$item->name;//
//               $pcanshu->order=$item->sort;
//               $pcanshu->select_type=$item->types==1?'radio':'checkbox';
//               $pcanshu->category="filtrate";
//
//              // dump($pcanshu);
//               $pcanshu->save();
               /*---------------------- CompleteMachineFrameworks ---------------------*/
//               $pcanshu = new ProductGood();
//               $p=$pcanshu->whereProductId(23)->whereOldid($item->pid)->first();
//                $pw=$pcanshu->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->product_goods_self_build_terrace()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao]);
//                }
               /*---------------------- integrations ---------------------*/
//               $pcanshu = new Integration();
//               $pcanshu->id=$item->id;
//               $pcanshu->name=$item->name;
//               $pcanshu->parent_id=1;
//               $pcanshu->pic=explode(',',$item->pic);
//               $pcanshu->details=$item->content;
//               $pcanshu->description=$item->des;
//               $pcanshu->click=$item->click;
//               $pcanshu->show=$item->post==2?1:0;dump($pcanshu);
             // $pcanshu->save();
               /*---------------------- members ---------------------*/
//               $pcanshu = new User();
//               $pcanshu->id=$item->userid;
//                $pcanshu->oid=$item->oldid ?? 0;
//               $pcanshu->unit=$item->dwjc;
//               $pcanshu->username=$item->username;
//               $pcanshu->nickname=$item->nickname;
//               $pcanshu->password=bcrypt($item->c);
//               $pcanshu->clear_text=encrypt($item->c);
//               $pcanshu->sex=$item->sex==1?'Mr':$item->sex==2?'lady':'privary';
//               $pcanshu->birthday=$item->borthday;
//               $pcanshu->phone=$item->mobile;
//               $pcanshu->telephone=$item->telephone;
//               $pcanshu->email=$item->email;
//               $pcanshu->wechat=$item->weixin;
//               $pcanshu->qq=$item->qq;
//               $pcanshu->industry=$item->hangye;
//               $pcanshu->address=$item->address;
////               $jibie=MemberGrade::pluck('id','identifying');
//                if($item->vip ==12){
//                    $pcanshu->grade='unverified';
//                }//未认证
//                 if($item->vip ==10){
//                    $pcanshu->grade='blocked_account';
//                }//冻结账户
//                 if($item->vip ==1){
//                     $pcanshu->grade='retail_price';
//                 }//零售价格
//                 if($item->vip ==11){
//                     $pcanshu->grade='taobao_price';
//                 }// 淘宝价
//                 if($item->vip ==2 || $item->vip ==6){
//                     $pcanshu->grade='member_price';
//                 }////会员价
//                 if($item->vip ==3 || $item->vip ==7){
//                     $pcanshu->grade='cooperation_price';
//                 }//合作价
//                 if($item->vip ==4 || $item->vip ==8){
//                     $pcanshu->grade='core_price';
//                 }//核心价
//                 if($item->vip ==5 || $item->vip ==9){
//                     $pcanshu->grade='cost_price';
//                 }//成本价
//               if($item->kefu!=null || $item->kefu!=''){
//                   $admin=Admin::whereAccount($item->kefu)->first();
//                   $pcanshu->administrator=$admin->id;
//               }else{
//                   $pcanshu->administrator=0;
//               }
//                 $pcanshu->payment_days=$item->zhangqi;
//                 $pcanshu->tax_rate=$item->shuidian==50?1:10;
//                 if($item->infotype==1){$pcanshu->message_type='phone_receiving';}
//                 if($item->infotype==2){$pcanshu->message_type='email_receiving';}
//                 if($item->infotype==3){$pcanshu->message_type='all_receiving';}
//                 if($item->infotype==4){$pcanshu->message_type='no_receiving';}
//                 $pcanshu->parts_buy=$item->is_peijian==1?0:1;
//                 $pcanshu->register_ip=$item->regip;
//                 $pcanshu->last_login_ip=$item->last_login_ip;
//                 $pcanshu->login_count=$item->loginnum;
//                 $pcanshu->last_login_time=date('Y-m-d H:i:s',$item->lastdate);
//                 $pcanshu->deal=$item->chengjiao ==1?1:0;
//                 $pcanshu->avatar=[];
//                 $pcanshu->parameters=[];
//                 $pcanshu->created_at=date('Y-m-d H:i:s',$item->regdate);
//
//                 $pcanshu->save();
               /*---------------------- user_address ---------------------*/
//               $pcanshu = new UserAddress();
//               $a=User::whereId($item->userid)->first();
//               if($a){
//                   $pcanshu->id=$item->wlid;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->address=$item->address;
//                   $pcanshu->name=$item->shouhuoren;
//                   $pcanshu->phone=$item->tel;
//                   $pcanshu->alternative_phone=$item->bytel;
//                   $pcanshu->logistics=$item->wlzhiding;
//                   $pcanshu->default=$item->status==1?false:true;
//                   $pcanshu->number=$item->bianhao;
//                   $pcanshu->zip=$item->youbian;
//            //   $pcanshu->save();
//               }

              // dump($pcanshu);

                  /*---------------------- user_companies ---------------------*/
//               $pcanshu = new UserCompany();
//               $a=User::whereId($item->userid)->first();
//               $invoice=MemberStatus::whereType('invoice')->pluck('identifying','name')->toArray();
//               if($a){
//                   $pcanshu->id=$item->qiyeid;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->address=$item->address;
//                   $pcanshu->name=$item->name;
//                   $pcanshu->unit=$item->dwjc;
//                   $pcanshu->unit_code=$item->dwjm;
//                   $pcanshu->unit_phone=$item->tel;
//                   $pcanshu->fax=$item->ctel;
//                   $pcanshu->zip=$item->youbian;
//                   $pcanshu->url=$item->url;
//                   $pcanshu->tax_mode=$invoice[$item->shuimoshi] ?? 'no_invoice';
//                   $pcanshu->tax_number=$item->shuihao;
//                   $pcanshu->account=$item->zhanghao;
//                   $pcanshu->opening_bank=$item->kaihuhang;
//                   $pcanshu->bank_address=$item->khhaddress;
//                   $pcanshu->bank_phone=$item->khhtel;
//                   $pcanshu->finance=$item->caiwu;
//                   $pcanshu->finance_phone=$item->cwtel;
//                   $pcanshu->logistics=$item->zhiding;
//                   $pcanshu->number=$item->bianhao;
//                   $pcanshu->default=$item->status==1?false:true;
                 // $pcanshu->save();

           //   }

//               /*---------------------- visitor_details ---------------------*/
//             $pcanshu = new VisitorDetail();
//               if($item->userid){
//                $user=User::whereId($item->userid)->first();
//               if($user) {
//               $pcanshu->id=$item->id;
//               $pcanshu->user_id=$user->id;
//               $pcanshu->source=$item->laiyuan;
//               $pcanshu->nickname=$item->nickname;
//               $pcanshu->industry=$item->hangye;
//               $pcanshu->address=$item->address;
//               $pcanshu->search=$item->sousuoci;
//               $pcanshu->key=$item->guanjianci;
//               $pcanshu->phone=$item->phone;
//               $pcanshu->email=$item->email;
//               $pcanshu->wechat=$item->wechat;
//               $pcanshu->qq=$item->qq;
//               $pcanshu->admin=$item->admin;
//               $pcanshu->details=$item->des;
//               $pcanshu->contact_count=$item->lianxi==1?'one':'two';
//               $pcanshu->valid=$item->youxiao==1?'no':'yes';
//               $pcanshu->created_at=$item->fwtime;
//                   $user->visitor_details()->update($pcanshu->only(["nickname",
//                       "industry",
//                       "address",
//                       "phone",
//                       "email",
//                       "wechat",
//                       "qq"
//                   ]));
//                   $pcanshu->save();
//                   }
//               }

               /*---------------------- orders ---------------------*/
//               $pcanshu = new Order();
//               $pcanshu->id=$item->orderid;
//               $pcanshu->user_id=$item->userid;
//               if($item->userid){
//                   $user=User::whereId($item->userid)->first();
//                   if($user) {
//                       $pcanshu->serial_number = $item->orderhao;
//                       $pcanshu->machine_model = $item->xinghao;
//                       $pcanshu->code = $item->peizhi;
//                       $pcanshu->unit_price = $item->danjia == null ? 0 : $item->danjia;
//                       $pcanshu->total_prices = $item->price == null ? 0 : $item->price;
//                       $pcanshu->price_spread = $item->chae;
//                       $pcanshu->num = $item->dgshu;
//                       if ($item->orderms == 1) {
//                           $pcanshu->order_type = 'parts';
//                       }
//                       if ($item->orderms == 2) {
//                           $pcanshu->order_type = 'waso_complete_machine';
//                       }
//                       if ($item->orderms == 3) {
//                           $pcanshu->order_type = 'custom_complete_machine';
//                       }
//                       if ($item->orderms == 4) {
//                           $pcanshu->order_type = 'designer_computer';
//                       }
//
//                       if ($item->orderstatus == 0) {
//                           $pcanshu->order_status = 'intention_to_order';
//                       }
//                       if ($item->orderstatus == 1) {
//                           $pcanshu->order_status = 'placing_orders';
//                       }
//                       if ($item->orderstatus == 2) {
//                           $pcanshu->order_status = 'order_acceptance';
//                       }
//                       if ($item->orderstatus == 3) {
//                           $pcanshu->order_status = 'in_transportation';
//                       }
//                       if ($item->orderstatus == 4) {
//                           $pcanshu->order_status = 'arrival _of_goods';
//                       }
//
//                       if ($item->send == 0) {
//                           $pcanshu->message_status = 'intention_to_order';
//                       }
//                       if ($item->send == 1) {
//                           $pcanshu->message_status = 'placing_orders';
//                       }
//                       if ($item->send == 2) {
//                           $pcanshu->message_status = 'order_acceptance';
//                       }
//                       if ($item->send == 3) {
//                           $pcanshu->message_status = 'in_transportation';
//                       }
//
//                       if ($item->kxstatus == 0) {
//                           $pcanshu->payment_status = 'pay_first';
//                       }
//                       if ($item->kxstatus == 1) {
//                           $pcanshu->payment_status = 'pay_on_delivery';
//                       }
//                       if ($item->kxstatus == 2) {
//                           $pcanshu->payment_status = 'taobao_pay';
//                       }
//                       if ($item->kxstatus == 3) {
//                           $pcanshu->payment_status = 'payment_days_user';
//                       }
//                       if ($item->kxstatus == 4) {
//                           $pcanshu->payment_status = 'pay_in_advance';
//                       }
//                       if ($item->kxstatus == 5) {
//                           $pcanshu->payment_status = 'account_paid';
//                       }
//
//                       if ($item->fwstatus == 0) {
//                           $pcanshu->service_status = 0;
//                       }
//                       if ($item->fwstatus == 1) {
//                           $pcanshu->service_status = 400;
//                       }
//                       if ($item->fwstatus == 2) {
//                           $pcanshu->service_status = 1200;
//                       }
//                       if ($item->fwstatus == 3) {
//                           $pcanshu->service_status = 3600;
//                       }
//
//                       if (empty($item->fptype)) {
//                           $pcanshu->invoice_type = 'no_invoice';
//                       }
//                       if ($item->fptype == 1) {
//                           $pcanshu->invoice_type = 'tax_invoice';
//                       }
//                       if ($item->fptype == 2) {
//                           $pcanshu->invoice_type = 'vat_special_invoice';
//                       }
//
//                       $pcanshu->invoice_info = $item->fpinfo;
//                       $pcanshu->logistics_id = $item->wladdress == null ? 0 : $item->wladdress;
//                       $pcanshu->logistics_info = $item->wlinfo;
//                       $pcanshu->parcel_count = $item->jiannum;
//                       $pcanshu->user_remark = $item->ddyaoqiu;
//                       $pcanshu->company_remark = $item->des;
//                       $pcanshu->urgent = $item->is_jiaji == 1 ? true : false;
//                       $pcanshu->flow_pic = $item->is_picshow == 1 ? true : false;
//                       $pcanshu->in_common_use = $item->changyong == 2 ? true : false;
//                       $pcanshu->pic = $item->dpic ? explode(';', $item->dpic) : [];
//                       $pcanshu->market = $item->xiaoshou;
//                       $pcanshu->participation_admin = [
//                           'acceptance' => $item->shouli ? explode('/', $item->shouli) : [],
//                           'skill' => $item->jishu ? explode('/', $item->jishu) : [],
//                           'pack' => $item->dabao ? explode('/', $item->dabao) : [],
//                       ];
//                       $pcanshu->admin = $item->admin;
//                       $pcanshu->created_at = date('Y-m-d H:i:s', $item->tjordertime);
//                       $pcanshu->updated_at = $item->edittime==null?date('Y-m-d H:i:s', $item->tjordertime):date('Y-m-d H:i:s', $item->edittime);
//                       $pcanshu->deleted_at = $item->is_del == 2 ? date('Y-m-d H:i:s', time()) : null;
//                  //   $pcanshu->save();
//                   }}

         // dump($pcanshu);
               /*---------------------- order_materials ---------------------*/
               //php artisan insert:data data

               /*---------------------- common_equipments ---------------------*/
//                 $pcanshu = new CommonEquipment();
//                  $pcanshu->id=$item->id;
//                   $pcanshu->user_id=$item->userid;
//                   $pcanshu->order_id=$item->orderid;
//                   $pcanshu->name=$item->name;
//                      $pcanshu->machine_model = $item->xinghao;
//                       $pcanshu->code = $item->peizhi;
//                       $pcanshu->unit_price = $item->danjia == null ? 0 : $item->danjia;
//                       $pcanshu->total_prices = $item->price == null ? 0 : $item->price;
//                       $pcanshu->num = $item->dgshu;
//                         $pcanshu->user_remark = $item->ddyaoqiu;
//                       $pcanshu->company_remark = $item->des;
//                       $pcanshu->market = $item->xiaoshou;
//                       $pcanshu->old_prices= $item->oldprice;
//                         if ($item->orderms == 1) {
//                           $pcanshu->order_type = 'parts';
//                       }
//                       if ($item->orderms == 2) {
//                           $pcanshu->order_type = 'waso_complete_machine';
//                       }
//                       if ($item->orderms == 3) {
//                           $pcanshu->order_type = 'custom_complete_machine';
//                       }
//                       if ($item->orderms == 4) {
//                           $pcanshu->order_type = 'designer_computer';
//                       }
//                     if ($item->fwstatus == 0) {
//                           $pcanshu->service_status = 0;
//                       }
//                       if ($item->fwstatus == 1) {
//                           $pcanshu->service_status = 400;
//                       }
//                       if ($item->fwstatus == 2) {
//                           $pcanshu->service_status = 1200;
//                       }
//                       if ($item->fwstatus == 3) {
//                           $pcanshu->service_status = 3600;
//                       }
//
//                       if (empty($item->fptype)) {
//                           $pcanshu->invoice_type = 'no_invoice';
//                       }
//                       if ($item->fptype == 1) {
//                           $pcanshu->invoice_type = 'tax_invoice';
//                       }
//                       if ($item->fptype == 2) {
//                           $pcanshu->invoice_type = 'vat_special_invoice';
//                       }
//                        $pcanshu->invoice_type = 'vat_special_invoice';
//                         $pcanshu->save();
               /*---------------------- common_equipment_materials ---------------------*/
//                 $pcanshu = new CommonEquipment;
//                $p=$pcanshu->find($item->orderid);
//                $g=new ProductGood;
//                $pw=$g->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                if($p && $pw){
//                    $p->common_equipment_product_goods()->attach($pw->id,['product_good_num'=>$item['num'],'product_number'=>$item->bianhao,'product_good_price'=>$item->danjia,'product_good_raid'=>$item->raid]);
//                }
               /*---------------------- demand_filtrates ---------------------*/
//                 $pcanshu = new DemandFiltrate();
//                 $pcanshu->id=$item->id;
//                 $pcanshu->name=$item->name;
//                 $pcanshu->parent_id=$item->pid;
//                 $pcanshu->category=$item->type ===1 ?  'issue' : 'answer';
//               $pcanshu->save();
               /*---------------------- demand_filtrates ---------------------*/
               //php artisan insert:data data
               /*---------------------- divisional_managements ---------------------*/
//             $pcanshu = new DivisionalManagement();
//               $pcanshu->id=$item->id;
//               $pcanshu->name=$item->name;
//               $pcanshu->parent_id=$item->pid;
//               if($item->status ==1){
//                   $pcanshu->identifying='company';
//               }
//               if($item->status ==2){
//                   $pcanshu->identifying='department';
//               }
//               if($item->status ==3){
//                   $pcanshu->identifying='group';
//               }
////
//           $pcanshu->save();//首先添加部门  然后注释 在执行下面if里面的代码
//               if(!empty($item->chengyuan)){
//                   $admin=Admin::whereIn('account',explode(';',$item->chengyuan))->get();
//                   if($admin->isNotEmpty()){
//                       foreach ($admin as $value){
//                           $pcanshu1 = new DivisionalManagement();
//                           $pcanshu1->name=$value->name;
//                           $pcanshu1->parent_id=$item->id;
//                           $pcanshu1->admin_id=$value->id;
//                           $pcanshu1->identifying='member';
//                           $pcanshu1->save();
//                       }
//                   }
//               }
               /*---------------------- task_managements ---------------------*/
//               $pcanshu = new TaskManagement();
//               if(!empty($item->chengyuan)){
//                   $admins=Admin::whereAccount($item->chengyuan)->first();
//                   $admin=DivisionalManagement::whereAdminId($admins->id)->first();
//                   $pcanshu->divisional_id=$admin->id;
//               }else{
//                   if(!empty($item->zudui)){
//                       $pcanshu->divisional_id=$item->zudui;
//                   }else{
//                       if(!empty($item->bumen)){
//                           $pcanshu->divisional_id=$item->bumen;
//                       }else{
//                           $pcanshu->divisional_id=$item->gongsi;
//                       }
//                   }
//               }
//               if($item->moshi == 1){
//                   $pcanshu->task_mode='single';
//               }else{
//                   $pcanshu->task_mode='multiterm';
//               }
//               $pcanshu->goal=(int)$item->arw;
//               $pcanshu->guaranteed_task=(int)$item->abrw;
//               $pcanshu->award_coefficient=(int)$item->jlxs;
//               $pcanshu->goal_two=(int)$item->b2mb;
//               $pcanshu->award_coefficient_two=(int)$item->b2xs;
//               $pcanshu->goal_three=(int)$item->b3mb;
//               $pcanshu->award_coefficient_three=(int)$item->b3mb;
//               $pcanshu->punish_index=(int)$item->cfbz;
//               $pcanshu->award_index=(int)$item->jlbz;
//               $pcanshu->units_index=(int)$item->dwzb;
//               $pcanshu->save();
               /*---------------------- funds_managements ---------------------*/
               //php artisan insert:data data
              /*---------------------- historical_task_managements ---------------------*/
//               $pcanshu = new HistoricalTaskManagement();
//                if($item->duixiang >= 800){
//                    $admin=Admin::whereAccount($item->duixiang)->first();
//                    $Divisional=DivisionalManagement::whereAdminId($admin->id)->first();
//                    if($Divisional){
//                    $pcanshu->divisional_id=$Divisional->id;
//                    $pcanshu->goal=$item->mubiao;
//                    $pcanshu->guaranteed_task=$item->baodi;
//                    $pcanshu->returned_money=$item->huikuan;
//                    $pcanshu->monthly_sales=$item->xiaoshou;
//                    $pcanshu->outstanding=$item->weijie;
//                    $pcanshu->punish_award=$item->jiangcheng;
//                    $pcanshu->year=$item->year;
//                    $pcanshu->mouth=$item->mouth;
//                    $pcanshu->save();
//                    }
//                }else{
//                    $ybumen=\DB::table('waso_ybumen')->whereId($item->duixiang)->first();
//                    if($ybumen){
//                        $Divisional=DivisionalManagement::whereName($ybumen->name)->first();
//                        if($Divisional){
//                            $pcanshu->divisional_id=$Divisional->id;
//                            $pcanshu->goal=$item->mubiao;
//                            $pcanshu->guaranteed_task=$item->baodi;
//                            $pcanshu->returned_money=$item->huikuan;
//                            $pcanshu->monthly_sales=$item->xiaoshou;
//                            $pcanshu->outstanding=$item->weijie;
//                            $pcanshu->punish_award=$item->jiangcheng;
//                            $pcanshu->year=$item->year;
//                            $pcanshu->mouth=$item->mouth;
//                            $pcanshu->save();
//                        }
//                    }
////
//                }

               /*---------------------- supplier_managements ---------------------*/
            //  $pcanshu = new SupplierManagement();
//              $pcanshu->id=$item->id;
//              $pcanshu->name=$item->name;
//              $pcanshu->code=$item->jianma;
//              $pcanshu->phone=$item->tel;
//              $pcanshu->address=$item->address;
//              $admin=Admin::whereAccount($item->admin)->first();
//              $pcanshu->admin=$admin->id;
//               $pcanshu->linkman=$admin->user;
//               $pcanshu->save();
               /*---------------------- procurement_plans ---------------------*/
               //php artisan insert:data data
               /*---------------------- inventory_managements ---------------------*/
//               $pcanshu = new InventoryManagement();
//               $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
//               if($good){
//                   $pcanshu->product_id= $item->cplx;
//                   $pcanshu->product_good_id= $good->id;
//                   $pcanshu->new= $item->xpsl>=0 ? $item->xpsl : 0;
//                   $pcanshu->good= $item->lpsl>=0 ? $item->lpsl : 0;
//                   $pcanshu->bad= $item->hhsl>=0 ? $item->hhsl : 0;
//                   $pcanshu->return_factory= $item->fcsl>=0 ? $item->fcsl : 0;
//                   $pcanshu->proxies= $item->dgsl>=0 ? $item->dgsl : 0;
//                   $pcanshu->test= $item->cspsl>=0 ? $item->cspsl : 0;
//                   $pcanshu->warning= $item->bjx>=0 ? $item->bjx : 0;
//                   $pcanshu->save();
//               }
               /*---------------------- warehouse_out_managements ---------------------*/
               //php artisan insert:data data
               /*---------------------- barcode_associated ---------------------*/


//         });
//        });



    }

    public function getParameters($parts='')
    {

        $status=MemberStatus::all();
        $i=1;
        foreach ($status as $item){

            if($item->type=='customer_status'){
                $arr['order_type_code'][$i++]=$item->identifying;
            }

        }

        return $arr;
    }
    public function comm1()
    {
//        $dro=ProductGood::get();
//        $dro->each(function ($item, $key){
//            $item->series_name=$item->series->name ?? '';
//            $item->framework_name=$item->framework->name ?? '';
//            $item->save();
//        });
    }

}
