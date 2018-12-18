@php
    $admin_account=$barcode_associated['admin']->pluck('name','account');
    $admin_id=$barcode_associated['admin']->pluck('name','id');
    $order=$barcode_associated['warehouse_out_management']->order;
@endphp
@include('admin.common.field._input',['title'=>'产品条码','field'=>'code','field_val'=>$barcode_associated['code'],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'占位符','field'=>null,'field_val'=>'','other'=>['readonly']])
@include('admin.common.field._input',['title'=>'产品类型','field'=>null,'field_val'=>$barcode_associated['product_good']->product->title,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('product_good_id',$barcode_associated['product_good']->id) !!}
@include('admin.common.field._input',['title'=>'产品规格','field'=>null,'field_val'=>$barcode_associated['product_good']->name,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._select',['vue'=>'v-if="showProduct"','title'=>'产品新类型','field'=>'new_product_id','field_list'=>product()->pluck('title','id'),'other'=>['placeholder'=>'产品新类型','class'=>'checkNull product','data_product_name'=>'new_product_good_id']])
@include('admin.common.field._select',['vue'=>'v-if="showProduct"','title'=>'产品新规格','field'=>'new_product_good_id','field_list'=>[],'other'=>['placeholder'=>'产品新规格','class'=>'checkNull good']])

@include('admin.common.field._input',['title'=>'当前事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['status']],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'入库时间','field'=>null,'field_val'=>$barcode_associated['procurement_plan']->created_at ?? $barcode_associated['barcode_associated']->created_at,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('user_id',$barcode_associated['warehouse_out_management']->user->id) !!}
@if(Request::has('searchSelect'))
    {!! Form::hidden('current_state',Request::get('type')) !!}
    @include('admin.common.field._input',['title'=>'选择事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[Request::get('type')],'other'=>['class'=>'checkNull','readonly']])
@else
    @include('admin.common.field._select',['title'=>'选择事件','field'=>'current_state','field_list'=>array_only(config('status.barcode_associateds_type'),['returned_to_the_factory','stock_returns','breakage','models_to_replace']),'other'=>['placeholder'=>'请选择事件','class'=>'checkNull','v-model'=>'selected','@change'=>'changeSelect()']])
@endif


@include('admin.common.field._input',['title'=>'供货商','field'=>null,'field_val'=>$barcode_associated['supplier_managements']->name,'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'采购人员','field'=>null,'field_val'=>$admin_id[$barcode_associated['procurement_plan']->purchase],'other'=>['class'=>'checkNull','readonly']])

{!!  Form::hidden('admin',admin()->id,["class"=>'checkNull','readonly']) !!}
@include('admin.common.field._input',['title'=>'操作人员','field'=>null,'field_val'=>admin()->name,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._textarea',['title'=>'上一备注','field'=>null,'field_val'=>$barcode_associated['barcode_associated']->postscript,'other'=>['readonly']])
@include('admin.common.field._textarea',['title'=>'备注信息','field'=>'postscript','field_val'=>null,'other'=>[]])

{!!  Form::hidden('product_colour',$barcode_associated['barcode_associated']->product_colour ?? 'new',["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('warehouse_out_management_id',$barcode_associated['warehouse_out_management']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('order_id',$barcode_associated['warehouse_out_management']->order->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('barcode_associated_id',$barcode_associated['barcode_associated']->id ?? 0,["class"=>'checkNull','readonly']) !!}




