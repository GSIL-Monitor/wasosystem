<?php

namespace App\Http\Controllers\Admin;

use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $permissions=Permission::where(function ($query){
           $query->when(\request('keyword'),function ($query){
               $keyword=\request('keyword');
               $query->where(\request('type'),'like',"%$keyword%");
           });
       })->paginate(20);
       return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::get();
        return view('admin.permissions.create_and_edit',compact('roles'));
    }

    /**
     * @param PermissionRequest $permissionRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionRequest $permissionRequest)
    {
        $name=$permissionRequest->get('name');
        $data=['name'=>$name,'title'=>$permissionRequest->get('title')];
        $permissions=Permission::create($data);
        $roles =array_filter($permissionRequest->get('roles'));
        if (!empty($roles)) { //如果选择了一个或多个角色。
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //将输入角色匹配
                $permission = Permission::where('name', '=', $name)->first(); //匹配输入权限到数据库
                $r->givePermissionTo($permission);
            }
        }
        //将当前添加的权限添加给超级管理员
        $super_admin = Role::where('id', '=', 1)->firstOrFail(); //将输入角色匹配
        $super_admin->givePermissionTo($permissions);

        return response()->json(['info'=>'添加成功',$permissions],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $roles=Role::get();
        return view('admin.permissions.create_and_edit',compact('permission','roles'));
    }

    /**
     * @param PermissionRequest $permissionRequest
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionRequest $permissionRequest, Permission $permission)
    {
       $permission->fill($permissionRequest->all())->update();
        return response()->json(['info'=>'修改成功',$permission],Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $res=Permission::destroy($request->get('id'));
        return response()->json($res,Response::HTTP_OK);
    }
}
