<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompleteMachineFrameworks;
use App\Models\CompleteMachine;
use App\Models\ProductGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CompleteMachineFrameworksController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id') ?? 1;
        $category = $request->get('category') ?? 'framework';

        $parent_parameters = CompleteMachineFrameworks::whereNull('parent_id')->pluck('name', 'id')->toArray();

        if ($category == 'filtrate') {
            $complete_machine_frameworks = CompleteMachineFrameworks::whereCategory($category)->defaultOrder()->descendantsOf($parent_id)->toTree();
        } else {
            $complete_machine_frameworks = CompleteMachineFrameworks::whereCategory($category)->whereParentId($parent_id)->orderBy('order','asc')->get(); //获取架构/应用/筛选参数
        }

        return view('admin.complete_machine_frameworks.index', compact('complete_machine_frameworks', 'parent_parameters', 'parent_id', 'category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $parent = CompleteMachineFrameworks::findOrFail($request->get('parent_id'));
        $category = $request->get('category') ?? 'framework';
        $listArr = $this->getList($request);

        return view('admin.complete_machine_frameworks.create_and_edit', compact('parent', 'category', 'listArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_array($request->get('name'))) {
            $data = $request->except(['name']);
            foreach (array_filter($request->get('name')) as $key=>$item) {
              $data['child_id']=$key;
              $data['name']=$item;
              CompleteMachineFrameworks::create($data);
            }
            return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
        } else {
            $complete_machine_frameworks = CompleteMachineFrameworks::create($request->all());
            return response()->json(['info' => '添加' . $complete_machine_frameworks->name . '成功', $complete_machine_frameworks], Response::HTTP_CREATED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompleteMachineFrameworks $completeMachineFrameworks
     * @return \Illuminate\Http\Response
     */
    public function show(CompleteMachineFrameworks $completeMachineFrameworks)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $completeMachineFrameworks = CompleteMachineFrameworks::findOrFail($id);
        $parent = CompleteMachineFrameworks::findOrFail($completeMachineFrameworks->parent_id);
        $category = $completeMachineFrameworks->category;
        return view('admin.complete_machine_frameworks.create_and_edit', compact("completeMachineFrameworks", 'parent', 'category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $completeMachineFrameworks = CompleteMachineFrameworks::findOrFail($id);
        $completeMachineFrameworks->update($request->all());
        return response()->json(['info' => '修改' . $completeMachineFrameworks->name . '成功', $completeMachineFrameworks], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $data = CompleteMachineFrameworks::whereIn('id', $request->get('id'))->get(); //查找所有删除对象
        $data->each(function ($item, $key) {
            $item->delete();
        });
        return response()->json(['info' => '删除成功'], Response::HTTP_OK);
    }

    /*-------------------  问题，答案，产品 列表  -------------------*/
    public function getList($request)
    {
        $arr = [];
        $arr['filtrate'] =  CompleteMachineFrameworks::whereCategory('filtrate')->whereParentId($request->get('parent'))->orderBy('order','asc')->get(); //获取架构/应用/筛选参数;
        $arr['answer'] =CompleteMachineFrameworks::whereCategory('answer')->whereParentId($request->get('parent'))->orderBy('order','asc')->get();
        $arr['it_service'] =ProductGood::whereJiagouId(162)->oldest()->get();
        $arr['product'] = CompleteMachine::whereParentId($request->get('parent'))->get();
        return $arr;
    }
}
