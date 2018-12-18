<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ServiceSheetExport;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\Request;
use App\Models\Admin;
use App\Models\Order;
use App\Services\ServiceServices;
use App\Models\Service;
use function foo\func;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    protected $service;
    protected $serviceServices;

    public function __construct(Service $service, ServiceServices $serviceServices)
    {
        $this->middleware('auth.admin:admin');
        $this->service = $service;
        $this->serviceServices = $serviceServices;
    }

    //服务管理列表
    public function index(Request $request)
    {
        $status=$request->get('status') ?? 'quality_assurance_apply_for';
        $services = $this->service->where(function ($query) use ($status){
            return $query->where('quality_assurance_status',$status)
                ->when(\request()->input('keyword') != '' ,function ($query){
                    $request=\request();
                    $query->where($request->type,'like',"%{$request->keyword}%");
                });
        })->latest()->paginate(20);

        return view('admin.services.index', compact('services','status'));

    }
    //返修统计
    public function repair_statistics(Request $request)
    {
        $year =$request->get('year') ??  date('Y',time());
        $mouth =$request->get('mouth') ?? date('m',time()) ;
        $firstYearGroup=Order::oldest()->first();
        $lastYearGroup=Order::latest()->first();
        $firstYear=$firstYearGroup->created_at->format('Y');
        $firstMouth=$firstYearGroup->created_at->format('m');
        $lastYear=$lastYearGroup->created_at->format('Y');
        $lastMouth=$lastYearGroup->created_at->format('m');
        $years=range($firstYear,$lastYear);
        if($firstYear == 2017 && $year==2017){
            $mouths=range($firstMouth,12);
        }else{
            $mouths=range(1,$lastMouth);
        }
        $orders=Order::whereYear('created_at',$year)->whereMonth('created_at',$mouth)->get(['market','participation_admin']);
        $services=Service::where('service_event','<>','E')->whereYear('created_at',$year)->whereMonth('created_at',$mouth)->get(['door_and_service_staff']);

        $arr=[];

        $multiplied = $orders->map(function ($item, $key) use (&$arr) {

            $participation_admin=$item->participation_admin ?? [];
            return array_merge($participation_admin,[$item->market]);
        });
        $service_multiplied = $services->map(function ($item, $key) use (&$arr) {
            return $item->door_and_service_staff['door'] ?? [];
        });
        $service_admins=array_sort_recursive(array_count_values (array_flatten($service_multiplied)));
        $admins=array_sort_recursive(array_count_values (array_flatten($multiplied)));
        $admin_lists=Admin::oldest('account')->pluck('name','account')->toArray();

        return view('admin.services.repair_statistics',compact('years','year','mouths','mouth','admins','admin_lists','service_admins'));
    }
    //服务管理添加
    public function store(ServiceRequest $request)
    {
        $service=Service::create($request->all());
        ding()->with('service_section')->at([],true)->text('测试信息！！！ 有质保服务申请，质保号：'.$service->serial_number.'！客户：'.$service->username.'，请服务人员尽快联系处理！');
        return response()->json(['info' => '质保申请成功！'], Response::HTTP_CREATED);
    }

    //服务管理添加页面
    public function create(Request $request)
    {
        $order = [];
        if ($request->has('keyword') && $request->keyword) {
            $order = Order::with(['user'])->where(function ($query) {
                $query->when(request()->get('type') == 'serial_number', function ($query) {
                    $request = request();
                    $query->where('serial_number', 'like', "%{$request->keyword}%");
                },function ($query) {
                    return $query->whereHas('warehouseOut.codes', function ($query) {
                        $request = request();
                        $query->where('code', 'like', "%{$request->keyword}%");
                    });
                });
            })->first();
        }
        $service=[];
        $admins=Admin::oldest('account')->pluck('name','account');
        return view('admin.services.create_and_edit', compact('order','admins','service'));
    }

    //服务管理修改页面
    public function edit(Service $service)
    {
        $order=[];
        if($service->order){
            $order =$service->order->load('user');
        }
        $admins=Admin::oldest('account')->pluck('name','account');
        return view('admin.services.create_and_edit', compact('service','order','admins'));
    }

    //服务管理修改
    public function update(ServiceRequest $request, Service $service)
    {

        $service->update(request()->all());
        return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
    }
    //下载表格和doc文档
    public function export(Service $service, Request $request, Excel $excel)
    {

        $file_name = $service->serial_number. '网烁公司上门服务单' . '.xlsx';
        return $excel->download(new ServiceSheetExport($service), $file_name);
    }
    //服务管理删除
    public function destroy(ServiceRequest $request)
    {
        Service::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}