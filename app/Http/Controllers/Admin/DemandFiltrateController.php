<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DemandFiltrateRequest;
use App\Http\Requests\Request;
use App\Services\DemandFiltrateServices;
use App\Models\DemandFiltrate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class DemandFiltrateController extends Controller
{
    protected $demand_filtrate;
    protected $demand_filtrateServices;
    public function __construct(DemandFiltrate $demand_filtrate,DemandFiltrateServices $demand_filtrateServices)
    {
        $this->middleware('auth.admin:admin');
        $this->demand_filtrate= $demand_filtrate;
           $this->demand_filtrateServices= $demand_filtrateServices;
    }
    //需求管理筛选列表
    public function index(Request $request)
    {
//        $demand_filtrates =  $this->demand_filtrate->latest()->paginate(20);
        $demand_filtrates=$this->demand_filtrate->reversed()->descendantsAndSelf(43)->toTree();
//        dump($a);
       return view('admin.demand_filtrates.index',compact('demand_filtrates'));

    }
    //需求管理筛选添加
    public function store(DemandFiltrateRequest $request)
    {
        $data=$request->all();
        $data['category']=$request->get('product_id') == '问题'?'issue':'answer';

        DemandFiltrate::create($data);
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //需求管理筛选添加页面
    public function create(Request $request)
    {
       return view('admin.demand_filtrates.create_and_edit');
    }
  //需求管理筛选修改页面
    public function edit(DemandFiltrate $demand_filtrate)
    {
        return view('admin.demand_filtrates.create_and_edit',compact('demand_filtrate'));
    }
  //需求管理筛选修改
    public function update(DemandFiltrateRequest $request,  DemandFiltrate $demand_filtrate)
    {
        $demand_filtrate->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //需求管理筛选删除
    public function destroy(DemandFiltrateRequest $request)
    {
        DemandFiltrate::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}