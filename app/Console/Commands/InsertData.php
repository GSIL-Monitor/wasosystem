<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\BarcodeAssociated;
use App\Models\DemandFiltrate;
use App\Models\DemandManagement;
use App\Models\FundsManagement;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\ProcurementPlan;
use App\Models\ProductGood;
use App\Models\SupplierManagement;
use App\Models\User;
use App\Models\VisitorDetail;
use App\Models\WarehouseOutManagement;
use Illuminate\Console\Command;
use App\Comdodel;
use Illuminate\Support\Facades\DB;

class InsertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:data {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        set_time_limit(0);
        $data = $this->argument('data');
        $pcanshu = new Order();
        $g = new ProductGood();
//        DB::table('waso_orderwl')->orderBy('orderid')->chunk(100, function ($users) use ($pcanshu,$g){
//            foreach ($users as $item) {
//                    if($item->orderid){
//                        $p=$pcanshu->find($item->orderid);
//                        $pw=$g->with('product')->whereProductId($item->type)->whereOldid($item->cpid)->first();
//                        if($p && $pw){
//                            $p->order_product_goods()->attach($pw->id,['product_good_price'=>$item->danjia ?? 0,'product_good_num'=>$item->num,'product_number'=>$pw->product->bianhao,'product_good_raid'=>$item->raid]);
//                        }
//                }
//            }
//        });
        /*---------------------- demand_filtrates ---------------------*/
//        DB::table('waso_peizhi')->latest('xietong')->chunk(100, function ($users) use ($pcanshu, $g) {
//            foreach ($users as $item) {
//                $pcanshu = new DemandManagement();
//                $pcanshu->id = $item->id;
//
//                if ($item->userid) {
//                    $user = User::find($item->userid);
//                    $visitor_details = VisitorDetail::find($item->zxid);
//                    if (!empty($user) && !empty($visitor_details)) {
//                        $pcanshu->user_id = $user->id;
//                        $pcanshu->visitor_details_id = $visitor_details->id;
//                        $pcanshu->demand_number = $item->hao;
//                        if ($item->peizhi) {
//                            $pcanshu->collocate = json_decode($item->peizhi, true);
//                        } else {
//                            $pcanshu->collocate = [];
//                        }
//                        $pcanshu->explain = $item->shuoming;
//                        $pcanshu->budget = $item->yusuan;
//                        if ($item->status == 1) {
//                            $pcanshu->demand_status = 'demand_consult';
//                        }
//                        if ($item->status == 2) {
//                            $pcanshu->demand_status = 'preliminary_scheme';
//                        }
//                        if ($item->status == 3) {
//                            $pcanshu->demand_status = 'requirement_determination';
//                        }
//                        $pcanshu->customer_status = $this->getParameters()['order_type_code'][$item->kehustatus];
//                        $pcanshu->the_next_step_program = $item->next;
//                        $pcanshu->record = $item->des;
//                        if ($item->xietong) {
//                            $pcanshu->assistant = json_decode($item->xietong, true);
//                        } else {
//                            $pcanshu->assistant = [];
//                        }
//
//                        $pcanshu->analog_data = $item->shuju;
//                        if ($item->admin) {
//                            $admin = Admin::whereAccount($item->admin)->first();
//                            $pcanshu->admin = $admin->id;
//                        }
//                        if($item->addtime){
//                            $pcanshu->created_at =date('Y-m-d H:i:s',$item->addtime);
//                        }
//                        if($item->edittime){
//                            $pcanshu->updated_at =date('Y-m-d H:i:s',$item->edittime);
//                        }
//
//                        $pcanshu->save();
//                        if ($item->shaixuan) {
//                            $shaixuan = explode(',', $item->shaixuan);
//                            $c = DemandFiltrate::whereIN('id', $shaixuan)->get()->implode('id', ',');
//                            $d = array_filter(explode(',', $c));
//                            if ($d) {
//                                $pcanshu->demand_management_filtrate()->sync($d);
//                            }
//                        }
//                        if ($item->sn) {
//                            $a = DB::table('waso_orders')->whereIN('zxhao', array_wrap($item->hao))->get()->implode('orderid', ',');
//                            $d = array_filter(explode(',', $a));
//                            if ($d) {
//                                $e = Order::whereIN('id', $d)->get()->implode('id', ',');
//                                $f = array_filter(explode(',', $e));
//                                if ($e) {
//                                    $pcanshu->demand_management_order()->sync($f);
//                                }
//                                $this->info($e);
//                            }
//
//
//                        }
//                    }
//                }
//            }
//        });
        /*---------------------- funds_managements ---------------------*/
//        DB::table('waso_funds')->latest('S_date')->chunk(100, function ($users) {
//            foreach ($users as $item) {
//                $pcanshu = new FundsManagement();
//                $user = User::whereUsername($item->userid)->first();
//                if ($user) {
//                    $pcanshu->user_id = $user->id;
//                    $pcanshu->market = $user->admins->account;
//                    if(str_contains($item->content,['订单的定金!'])){
//                        $pcanshu->type = 'down_payment';
//                    }else{
//                        if ($item->lb == 0) {
//                            $pcanshu->type = 'deposit';
//                        }
//                        if ($item->lb == 2) {
//                            $pcanshu->type = 'pay';
//                        }
//                    }
//
//                    $pcanshu->price = $item->money == '' ? 0 : abs($item->money);
//                    $pcanshu->created_at = $item->S_date;
//                    $pcanshu->comment = $item->content;
//                    if (str_contains($item->admin, 808)) {
//                        $pcanshu->operate = 808;
//                    } else {
//                        $pcanshu->operate = 809;
//                    }
//                   $pcanshu->save();
//                }
//            }
//        });
        /*---------------------- procurement_plans ---------------------*/
//        DB::table('waso_tin')->latest('addtime')->chunk(100, function ($users) {
//            foreach ($users as $item) {
//                $pcanshu = new ProcurementPlan();
//                $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
//                $ghdw=SupplierManagement::whereId($item->ghdw)->first();
//                if ($good && $ghdw && $item->yghao) {
//                    $pcanshu->id = $item->id;
//                    $pcanshu->supplier_managements_id = $ghdw->id;
//                    $pcanshu->serial_number = $item->yghao;
//                    if ($item->cglx == 1) {
//                        $pcanshu->procurement_type = 'procurement';
//                    } else {
//                        $pcanshu->procurement_type = 'test';
//                    }
//                    $pcanshu->product_id = $item->cplx;
//                    $pcanshu->product_good_id = $good->id;
//                    $pcanshu->quality_time = (int)$item->zbsj;
//                    $cgry = Admin::whereAccount($item->cgry)->first();
//                    $pcanshu->purchase = $cgry->id;
//                    $czry = Admin::whereAccount($item->cgry)->first();
//                    $pcanshu->admin = $czry->id;
//                    if ($item->cpcs == 6) {
//                        $pcanshu->product_colour = 'new';
//                    }
//                    if ($item->cpcs == 7) {
//                        $pcanshu->product_colour = 'good';
//                    }
//                    if ($item->cpcs == 8) {
//                        $pcanshu->product_colour = 'bad';
//                    }
//                    if ($item->rkzt == 1) {
//                        $pcanshu->procurement_status = 'procurement';
//                    }
//                    if ($item->rkzt == 2) {
//                        $pcanshu->procurement_status = 'unfinished';
//                    }
//                    if ($item->rkzt == 3) {
//                        $pcanshu->procurement_status = 'finish';
//                    }
//                    $pcanshu->postscript = $item->bzxx;
//                    $pcanshu->procurement_number = $item->cgsl;
//                    $pcanshu->finish_procurement_number = $item->glsl;
//                    $pcanshu->logistics_company = $item->wlgs;
//                    $pcanshu->logistics_number = $item->wldh;
//                    $pcanshu->code = explode(',', $item->tiaoma);
//                    $pcanshu->two_code = explode(',', $item->ejtm);
//                    $pcanshu->created_at = date('Y-m-d H:i:s', $item->addtime);
//                    $pcanshu->updated_at = date('Y-m-d H:i:s', $item->edittime);
//                    $pcanshu->save();
//                }
//            }
//        });
        /*---------------------- warehouse_out_managements ---------------------*/
//          DB::table('waso_tout')->latest('addtime')->chunk(100, function ($users) {
//            foreach ($users as $item) {
//                $pcanshu = new WarehouseOutManagement();
//                $code=explode(',',$item->tiaoma);
//                $cps=explode(';',$item->cps);
//                $arr=[];
//                $num = 0;
//                $flag=0;
//                foreach ($cps as $v){
//                    $a=explode(',',$v);
//                    if(count($a)==3){
//                        $good = ProductGood::whereProductId($a[0])->whereOldid($a[1])->first();
//                        if($good){
//                            $arr[$good->id]['product_good_id']=$good->id;
//                            $arr[$good->id]['product_good_num']=$a[2];
//                            $arr[$good->id]['product_good_number']=$good->product->bianhao;
//                            $tm = array_slice($code, $num, $a[2]);
//                            $num += $a[2];
//                            $arr[$good->id]['code']=$tm;
//                        }else{
//                            $flag=1;
//                        }
//                    }
//                }
//                $user=User::find($item->userid);
//                if($flag == 0 && $user){
//                    $admin=Admin::whereAccount($item->czry)->first();
//                    $pcanshu->id=$item->id;
//                    $pcanshu->user_id=$user->id;
//                    $pcanshu->order_id=$item->orderid ?? 0;
//                    $pcanshu->serial_number=$item->orderhao;
//                    $pcanshu->out_number=$item->cksl;
     //                 $pcanshu->finish_out_number=count(explode(',',$item->tiaoma));
//                    $pcanshu->admin=$admin->id;
//                    $pcanshu->postscript=$item->bzxx;
//                    if($item->cklb == 3){
//                        $pcanshu->out_type='sell';
//                    }
//                    if($item->cklb == 4){
//                        $pcanshu->out_type='loan_out';
//                    }
//                    $pcanshu->associated_disposal=$item->xszt;
//                    if($item->ckzt == 1){
//                        $pcanshu->out_status='unfinished';
//                    }
//                    if($item->ckzt == 2){
//                        $pcanshu->out_status='finish';
//                    }
//                    $pcanshu->created_at=date('Y-m-d H:i:s',$item->addtime);
//                    $pcanshu->updated_at=date('Y-m-d H:i:s',$item->edittime);
//                    $pcanshu->save();
//                    $pcanshu->codes()->createMany($arr);
//2017-11-17 15:45:38  2017-11-17 15:45:33

//                }
//
//            }
//        });
        /*---------------------- barcode_associated ---------------------*/
        DB::table('waso_tguanlian')->oldest('addtime')->chunk(100, function ($users) {
            foreach ($users as $item) {
                $pcanshu = new BarcodeAssociated();
                $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
                $admin = Admin::whereAccount($item->czry)->first();
                if($good) {
                    $ProcurementPlan=ProcurementPlan::where(function ($query) use ($item) {
                        $query->orWhere('code', 'like', '%' .$item->tiaoma . '%')
                              ->orWhere('two_code', 'like', '%' . $item->gltm . '%');
                    })->first();
                    $WarehouseOutManagement=WarehouseOutManagement::whereHas('codes',function ($query) use ($item){
                            $query->where(function ($query) use ($item) {
                                $query->orWhere('code', 'like', '%' .$item->tiaoma . '%')
                                      ->orWhere('code', 'like', '%' . $item->gltm . '%');
                            });
                    })->first();
                    $default_supplier_managements=BarcodeAssociated::where(function ($query) use ($item) {
                        $query->orWhere('code', 'like', '%' .$item->gltm . '%')
                            ->orWhere('two_code', 'like', '%' .  $item->tiaoma. '%');
                    })->oldest()->first();
                    $pcanshu->supplier_managements_id=$ProcurementPlan->supplier_managements_id ?? $default_supplier_managements->supplier_managements_id ?? 0;
                    $pcanshu->procurement_plans_id=$ProcurementPlan->id ?? 0;
                    $pcanshu->warehouse_out_management_id=$WarehouseOutManagement->id ?? $item->outid ?? 0;
                    $pcanshu->order_id=$WarehouseOutManagement->order->id ?? 0;
                    $pcanshu->user_id=$WarehouseOutManagement->user->id ?? $item->userid ?? 0;
                    $pcanshu->product_good_id=$good->id ?? 0;
                    $pcanshu->current_state=config('status.barcode_associatedss')[$item->dangqianshijian];
                    $pcanshu->code=$item->tiaoma;
                    if(!empty($item->gltm) && ($item->dangqianshijian ==15 || $item->dangqianshijian ==24)){
                        $pcanshu->description="有新条码!";
                    }
                    if(!empty($item->gltm) && $item->xszt ==9 && ($item->dangqianshijian ==11 || $item->dangqianshijian ==13)){
                        $pcanshu->description="换出!";
                    }
                    if(!empty($item->gltm) && $item->xszt ==10 && ($item->dangqianshijian ==11 || $item->dangqianshijian ==13)){
                        $pcanshu->description="换进!";
                    }
                    if(!empty($item->gltm)  && $item->true ==0 && ( $item->dangqianshijian ==24 ||  $item->dangqianshijian ==15)){
                        $pcanshu->description="换出!";
                    }
                    if(!empty($item->gltm)  && $item->true == 1 && ( $item->dangqianshijian ==24 ||  $item->dangqianshijian == 15)){
                        $pcanshu->description="换进!";
                    }
                    if( $item->userid ==0 && $item->ghdw ==0){
                        $pcanshu->location="库存";
                    }elseif(isset($item->userid) && !empty($item->userid) &&  $item->dangqianshijian== 12 || $item->dangqianshijian == 24 && $item->ghdw == 0){
                        $pcanshu->location="代管";
                    }elseif(isset($item->userid) && !empty($item->userid) && $item->dangqianshijian == 16 || $item->dangqianshijian == 24 && $item->ghdw != 0){
                        $pcanshu->location="供货商";
                    }elseif(isset($item->userid) and !empty($item->userid)){
                        $pcanshu->location="客户";
                    }else{
                        $pcanshu->location="供货商";
                    }
                    $pcanshu->associated_disposal=$item->xszt > 1 ? true : false;
                    $pcanshu->two_code=$item->gltm;
                    $pcanshu->product_colour=config('status.barcode_associatedss')[$item->cpcs] ?? 'new';
                    $pcanshu->postscript=$item->bzxx;
                    $pcanshu->admin=$admin->id;
                    $pcanshu->created_at = date('Y-m-d H:i:s', $item->addtime);
                    $pcanshu->updated_at = date('Y-m-d H:i:s', $item->addtime);
                   $pcanshu->save();
                }

            }
        });
        $this->info('success');
    }

    public function getParameters($parts = '')
    {

        $status = MemberStatus::all();
        $i = 1;
        foreach ($status as $item) {

            if ($item->type == 'customer_status') {
                $arr['order_type_code'][$i++] = $item->identifying;
            }

        }

        return $arr;
    }
}

