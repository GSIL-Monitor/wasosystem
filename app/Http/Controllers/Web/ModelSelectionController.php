<?php

namespace App\Http\Controllers\Web;

use App\Services\ModelSelectionServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelSelectionController extends Controller
{
    public $model_selection;

    public function __construct(ModelSelectionServices $modelSelectionServices)
    {
        $this->model_selection=$modelSelectionServices;
    }
    public function three_major_items(Request $request)
    {

        $cpus=$this->model_selection->cpu();
        return view('site.model_selections.three_major_items',compact('cpus'));
    }


    public function order(Request $request)
    {
        $type=request()->input('type') ?? 'cpu';
        if(request()->ajax() || request()->wantsJson()){
            switch ($type){
                case 'memory' :
                {
                    $memory=$this->model_selection->memory();
                    $html=view('site.model_selections.table.memory_table')->with(['memory_lists'=>$memory]);
                    return  response($html)->getContent();
                }
                case 'hard_disk' :
                {
                    $hard_disk=$this->model_selection->hard_disk();
                    $html=view('site.model_selections.table.hard_disk_table')->with(['hard_disk_lists'=>$hard_disk]);
                    return  response($html)->getContent();
                }
                default :{
                    $cpu=$this->model_selection->cpu();
                    $html=view('site.model_selections.table.cpu_table')->with(['cpus'=>$cpu]);
                    return  response($html)->getContent();
                }
            }
        }
    }

    public function server_selection()
    {
        $server_selections=$this->model_selection->server_selection();
        return view('site.model_selections.server_selection',compact('server_selections'));
    }
    public function filter(Request $request)
    {
        $server_selections=$this->model_selection->server_selection($request->input('id'));

        if($server_selections->isNotEmpty()){
            $type=$server_selections[0]->child_category;
            if($type == 'product'){
                $server_selections=$this->model_selection->server_selection($server_selections[0]->parent_id,'product');
                $html=view('site.model_selections.filter.server_selection_search')->with(['server_selections'=>$server_selections[0]->children]);
            }else{
                $html=view('site.model_selections.filter.server_selection_filter')->with(['server_selections'=>$server_selections]);
            }
            return response()->json(['type'=>$type,'html'=>response($html)->getContent()]);
        }else{
            $html=view('site.model_selections.filter.server_selection_empty');
           return response()->json(['html'=>response($html)->getContent()],404);
        }
    }


    public function designer_selection(Request $request)
    {
        $designer_selections=$this->model_selection->designer_selection();
        return view('site.model_selections.designer_selection',compact('designer_selections'));
    }
    public function designer_filter(Request $request)
    {
        $server_selections=$this->model_selection->designer_filter();
        if($server_selections->isNotEmpty()){
            $html=view('site.model_selections.filter.server_selection_search')->with(['server_selections'=>$server_selections]);
            return response()->json(['html'=>response($html)->getContent()]);
        }else{
            $html=view('site.model_selections.filter.server_selection_empty');
            return response()->json(['html'=>response($html)->getContent()],404);
        }
    }
}
