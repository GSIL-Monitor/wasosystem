<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenusRequest;
use Symfony\Component\HttpFoundation\Response;

class MenusController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin:admin');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $cat=$request->get('cat') ?? 'web';
        $menus=Menu::with('childMenus')->condition($cat)->order()->paginate();
        return view('admin.menus.index',compact('menus','cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create_and_edit');
    }

    /**
     * @param MenusRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MenusRequest $request)
    {
       $menu=Menu::create($request->all());
       return response()->json(['info'=>'添加成功',$menu],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.create_and_edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return response()->json(['info'=>'修改成功',$menu],Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $res=Menu::destroy($request->get('id'));
        return response()->json($res,Response::HTTP_OK);
    }
}
