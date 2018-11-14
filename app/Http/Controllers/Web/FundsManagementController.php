<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\FundsManagementRequest;
use App\Http\Requests\Request;
use App\Models\User;
use App\Services\FundsManagementServices;
use App\Models\FundsManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class FundsManagementController extends Controller
{
    protected $funds_management;
    protected $funds_managementServices;
    public function __construct(FundsManagement $funds_management,FundsManagementServices $funds_managementServices)
    {
        $this->funds_management= $funds_management;
           $this->funds_managementServices= $funds_managementServices;
    }
    //资金管理列表
    public function index(Request $request)
    {
        $orders=user()->orders()->whereIn('payment_status', ['pay_first', 'pay_on_delivery', 'taobao_pay', 'payment_days_user', 'payment_days_user', 'pay_in_advance'])
            ->where('order_status', '<>', 'intention_to_order')->get();
        $parameters=$this->funds_managementServices->getParameters();
        $financial_details=user()->funds()->latest()->paginate(12);

       return view('member_centers.funds_managements.index',compact('orders','parameters','financial_details'));

    }
}