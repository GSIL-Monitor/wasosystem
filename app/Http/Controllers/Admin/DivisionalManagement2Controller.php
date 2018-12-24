<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\DivisionalManagementRequest;
use App\Http\Requests\Request;
use App\Models\Admin;
use App\Services\DivisionalManagementServices;
use App\Models\DivisionalManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class DivisionalManagement2Controller extends Controller
{
    protected $divisional_management;
    protected $divisional_managementServices;
    public function __construct(DivisionalManagement $divisional_management,DivisionalManagementServices $divisional_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->divisional_management= $divisional_management;
        $this->divisional_managementServices= $divisional_managementServices;
    }
    //部门管理列表
    public function index(Request $request)
    {
//        $divisional_managements =  $this->divisional_management->latest()->paginate(20);
        $divisional_managements = $this->divisional_management->with('task')->defaultOrder()->descendantsAndSelf(88)->toTree();

        return view('admin.divisional_managements.index',compact('divisional_managements'));

    }
    //部门管理添加
    public function store(DivisionalManagementRequest $request)
    {
        if($request->get('identifying') == 'member'  && !empty($request->get('admins'))){
            $this->divisional_managementServices->add_member($request->get('admins'),$request->get('parent_id'));
        }else{
            DivisionalManagement::create($request->all());
        }
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
    //部门管理添加页面
    public function create(Request $request)
    {
        $parent=DivisionalManagement::find($request->get('parent_id'));
        $diffKeys=$parent->descendants->pluck('name','admin_id')->toArray();
        $admin=Admin::oldest('account')->get()->pluck('name','id');
        $admins = $admin->diffKeys($diffKeys)->all();//排除部门下面的成员
        return view('admin.divisional_managements.create_and_edit',compact('admins','parent'));
    }
    //部门管理修改页面
    public function edit(DivisionalManagement $divisional_management)
    {

        return view('admin.divisional_managements.create_and_edit',compact('divisional_management'));
    }
    //部门管理修改
    public function update(DivisionalManagementRequest $request,  DivisionalManagement $divisional_management)
    {

        $divisional_management->update($request->all());
        return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
    //部门管理删除
    public function destroy(DivisionalManagementRequest $request)
    {
        DivisionalManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}
