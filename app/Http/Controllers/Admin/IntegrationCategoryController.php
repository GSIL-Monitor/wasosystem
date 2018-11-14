<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IntegrationCategoryRequest;
use App\Models\IntegrationCategory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class IntegrationCategoryController extends Controller
{
    protected $integration_category;
    public function __construct(IntegrationCategory $integration_category)
    {
        $this->middleware('auth.admin:admin');
        $this->integration_category= $integration_category;
    }
    //软硬一体化分类列表
    public function index(IntegrationCategoryRequest $request)
    {
        $integration_categories = IntegrationCategory::latest()->paginate(20);

       return view('admin.integration_categories.index',compact('integration_categories'));

    }
    //软硬一体化分类添加
    public function store(IntegrationCategoryRequest $request)
    {
        IntegrationCategory::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //软硬一体化分类添加页面
    public function create()
    {
       return view('admin.integration_categories.create_and_edit');
    }
  //软硬一体化分类修改页面
    public function edit(IntegrationCategory $integration_category)
    {
        return view('admin.integration_categories.create_and_edit',compact('integration_category'));
    }
  //软硬一体化分类修改
    public function update(IntegrationCategoryRequest $request, IntegrationCategory $integration_category)
    {

        $integration_category->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //软硬一体化分类删除
    public function destroy(IntegrationCategoryRequest $request)
    {
        IntegrationCategory::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}