<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminsRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AdminsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }


	public function index(Request $request)
	{
        $admins = Admin::with('roles')->paginate(20);
		return view('admin.admins.index', compact('admins'));
	}

    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

	public function create()
	{
        $roles = Role::get();
		return view('admin.admins.create_and_edit', compact('roles'));
	}

	public function store(AdminsRequest $request)
	{
	    $data=$request->all();
        $data['password']=bcrypt($request->get('password'));
		$admin=Admin::create($data);
        $roles=$request->get('roles');//检索角色
        //检查角色是否被选中。
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $admin->assignRole($role_r); //将角色分配给用户
            }
        }
        return response()->json(['info'=>'添加成功',$admin],Response::HTTP_CREATED);
	}

	public function edit(Admin $admin)
	{
        $roles = Role::get();
        //dump($admin);   dump($roles);
		return view('admin.admins.create_and_edit', compact('admin','roles'));
	}

	public function update(AdminsRequest $request, Admin $admin)
	{
        $data=$request->all();
        if(!empty($request->get('password'))){
            $data['password']=bcrypt($request->get('password'));
        }else{
            unset($data['password']);
        }
        $roles = $request->get('roles'); //检索所有角色
		$admin->update($data);
        if (isset($roles)) {
            $admin->roles()->sync($roles);  //如果选择了一个或多个角色，则将其关联到角色。
        }
        else {
            $admin->roles()->detach(); //如果选择了一个或多个角色，则将其关联到角色。
        }
        return response()->json(['info'=>'修改成功',$admin],Response::HTTP_CREATED);
	}

	public function destroy(Request $request)
	{
        $res=Admin::destroy($request->get('id'));
        return response()->json($res,Response::HTTP_OK);
	}

    public function log_viewer()
    {
        return redirect()->route('log-viewer::logs.list');
	}
}