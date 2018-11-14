<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth.admin:admin');
        $this->funds_management= $funds_management;
           $this->funds_managementServices= $funds_managementServices;
    }
    //资金管理列表
    public function index(Request $request)
    {
        $debit_users =  $this->funds_managementServices->get_debit_users();
        $users=User::DebitUser($debit_users,$request)->paginate(20);
       return view('admin.funds_managements.index',compact('users'));

    }
    //资金管理添加
    public function store(FundsManagementRequest $request)
    {
        FundsManagement::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //资金管理添加页面
    public function create(Request $request)
    {
        $user=User::find($request->input('user_id'));
        $orders=$user->orders()->BalanceOrder($request)->whereIn('payment_status',['pay_first','pay_on_delivery','taobao_pay','payment_days_user','payment_days_user','pay_in_advance'])
            ->where('order_status','<>','intention_to_order')->get();
        $funds_management=new FundsManagement();
        $funds_managements=$funds_management->whereUserId($user->id)->get();
        $Internal_funds=$this->funds_managementServices->Internal_funds($funds_managements);
        $parameters=$this->funds_managementServices->getParameters();
       return view('admin.funds_managements.create_and_edit',compact('user','orders','parameters','Internal_funds','funds_management'));
    }
    //资金管理记录
    public function financial_details(Request $request)
    {
        $user=User::find($request->input('user_id'));
        $key=$request->get('keyword') ?? '' ;
        $financial_details=FundsManagement::with('admin')->whereUserId($user->id)->MoneyRecord($key)->latest()->paginate(20);
        return view('admin.funds_managements.show',compact('financial_details','user'));
    }
    //存入金额
    public function deposit(Request $request)
    {
        $this->funds_managementServices->deposit($request);
       return back();
    }
    //付款
    public function pay(Request $request)
    {
        $this->funds_managementServices->pay($request);
        return back();
    }
  //资金管理修改页面
    public function edit(FundsManagement $funds_management)
    {
        return view('admin.funds_managements.create_and_edit',compact('funds_management'));
    }
  //资金管理修改
    public function update(FundsManagementRequest $request,  FundsManagement $funds_management)
    {
        $funds_management->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //资金管理删除
    public function destroy(FundsManagementRequest $request)
    {
        FundsManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}