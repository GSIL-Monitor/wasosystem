@php
    $admin_account=$barcode_associated['admin']->pluck('name','account');
    $admin_id=$barcode_associated['admin']->pluck('name','id');

@endphp
@include('admin.common.field._input',['title'=>'产品条码','field'=>'code','field_val'=>$barcode_associated['code'],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'占位符','field'=>null,'field_val'=>'','other'=>['readonly']])
@include('admin.common.field._input',['title'=>'产品类型','field'=>null,'field_val'=>$barcode_associated['product_good']->product->title,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('product_good_id',$barcode_associated['product_good']->id) !!}
@include('admin.common.field._input',['title'=>'产品规格','field'=>null,'field_val'=>$barcode_associated['product_good']->name,'other'=>['class'=>'checkNull','readonly']])



@include('admin.common.field._input',['title'=>'当前事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['status']],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'入库时间','field'=>null,'field_val'=>$barcode_associated['procurement_plan']->created_at ?? $barcode_associated['barcode_associated']->created_at,'other'=>['class'=>'checkNull','readonly']])

@if(Request::has('search'))
@include('admin.common.field._input',['title'=>'选择事件','field'=>'current_state','field_val'=>array_only(config('status.barcode_associateds_type'),['test_return','test_to_procurement'])[$barcode_associated['barcode_associated']->current_state],'other'=>['placeholder'=>'请选择事件','class'=>'checkNull','readonly']])
@else
@include('admin.common.field._select',['title'=>'选择事件','field'=>'current_state','field_list'=>array_only(config('status.barcode_associateds_type'),['test_return','test_to_procurement']),'other'=>['placeholder'=>'请选择事件','class'=>'checkNull','v-model'=>'selected','@change'=>'changeSelect()']])
@endif

@include('admin.common.field._input',['title'=>'供货商','field'=>null,'field_val'=>$barcode_associated['supplier_managements']->name,'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'采购人员','field'=>null,'field_val'=>$admin_id[$barcode_associated['procurement_plan']->purchase ?? $barcode_associated['barcode_associated']->admin],'other'=>['class'=>'checkNull','readonly']])

{!!  Form::hidden('admin',admin()->id,["class"=>'checkNull','readonly']) !!}
@include('admin.common.field._input',['title'=>'操作人员','field'=>null,'field_val'=>admin()->name,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._textarea',['title'=>'上一备注','field'=>null,'field_val'=>$barcode_associated['procurement_plan']->postscript ?? $barcode_associated['barcode_associated']->postscript,'other'=>['readonly']])
@if(!Request::has('search'))
@include('admin.common.field._textarea',['title'=>'备注信息','field'=>'postscript','field_val'=>null,'other'=>[]])
@endif
{!!  Form::text('product_colour',$barcode_associated['procurement_plan']->product_colour ?? 'new',["class"=>'checkNull','readonly']) !!}
{!!  Form::text('warehouse_out_management_id',$barcode_associated['warehouse_out_management']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::text('order_id',$barcode_associated['warehouse_out_management']->order->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::text('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::text('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::text('barcode_associated_id',$barcode_associated['barcode_associated']->id ?? 0,["class"=>'checkNull','readonly']) !!}




