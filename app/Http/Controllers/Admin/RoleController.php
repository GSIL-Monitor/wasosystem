<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate();//Get all roles

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//得到所有权限

        return view('admin.roles.create_and_edit',compact('permissions'));
    }

    /**
     * @param RoleRequest $roleRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $roleRequest)
    {
        $name=$roleRequest->get('name');
        $data=['name'=>$name,'title'=>$roleRequest->get('title')];
        $role=Role::create($data);
        $permissions=array_filter($roleRequest->get('permissions'));

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
//        //循环通过选择权限
//        if(!empty($permissions)) {
//            foreach ($permissions as $permission) {
//                $permiss = Permission::where('id', '=', $permission)->firstOrFail();
//                //获取新创建的角色并分配权限。
//                $role = Role::where('name', '=', $name)->first();
//                $role->givePermissionTo($permiss);
//            }
//        }
        return response()->json(['info'=>'添加'.$role->title.'成功'],Response::HTTP_CREATED);
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
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
//       dump($permissions=$permissions->groupBy(function ($item, $key) {
//        return mb_substr($item['title'], 0,-2);
//    }));
        return view('admin.roles.create_and_edit', compact('role', 'permissions'));
    }

    /**
     * @param RoleRequest $roleRequest
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $roleRequest, Role $role)
    {
        $permissions=array_filter($roleRequest->get('permissions'));
        $role->fill($roleRequest->except(['permissions','undefined']))->save();

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $res=Role::destroy($request->get('id'));
        return response()->json($res,Response::HTTP_OK);
    }
}
