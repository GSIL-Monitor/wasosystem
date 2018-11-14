<?php

use Faker\Generator as Faker;
//composer dump-autoload
$factory->define(App\Models\Order::class, function (Faker $faker) {
    $admins=[801,806,800,803,807,812,808,813,888];
    $a=Admin::whereIn('account',$admins)->get();
    $admin=$a->random();
    $user=$admin->users->random();
    $payment_statuss=['pay_in_advance','account_paid','payment_days_user'];
    $payment_status=array_random($payment_statuss);
    $price=$faker->numberBetween(1500,100000);
    $sn='SN'.date('YmdHis',time());
    $time=date('Y-m-d H:i:s',time());
    $funds['user_id']=$user->id;
    $funds['type']="pay";
    $funds['price']=$price;
    $funds['operate']=809;
    $funds['market']=$admin->account;
    $funds['created_at']=$time;
    $funds['updated_at']=$time;
    return [
        'user_id'=>$user->id,
        'serial_number'=>$sn,
        'machine_model'=>'',
        'code'=>'',
        'unit_price'=>$price,
        'total_prices'=>$price,
        'price_spread'=>0,
        'num'=>1,
        'order_type'=>'parts',
        'order_status'=>'arrival_of_goods',
        'message_status'=>'parts',
        'payment_status'=>function() use ($payment_status,$funds){
            if($payment_status == 'account_paid'){
                App\Models\FundsManagement::create($funds);
            }
            return $payment_status;
        },
        'service_status'=>0,
        'invoice_type'=>'no_invoice',
        'parcel_count'=>1,
        'urgent'=>false,
        'flow_pic'=>false,
        'in_common_use'=>1,
        'market'=>$admin->account,
        'pic'=>[],
        'created_at'  => $time,
        'updated_at'  => $time,
    ];
});
