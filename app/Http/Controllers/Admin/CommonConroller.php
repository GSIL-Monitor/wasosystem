<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Symfony\Component\HttpFoundation\Response;

class CommonConroller extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function allUpdate(Request $request)
    {
         $data=collect($request->get('edit'));
         $data->each(function ($item, $key) use($request) {
         $array=array_add($item,'updated_at',date('Y-m-d H:i:s',time()));
         $arr=[];
         foreach ($array as $key2=>$value){
             if(is_numeric($value)){
                 $arr[$key2]=intval($value);
             }else{
                 $arr[$key2]=$value;
             }
         }
       DB::table($request->get('table'))->where('id',$key)->update($arr);
        });
     return response()->json(['info'=>'更新成功'],Response::HTTP_OK);
    }
}
