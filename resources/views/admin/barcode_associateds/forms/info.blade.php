@php
    $admin_account=$barcode_associated['admin']->pluck('name','account');
    $admin_id=$barcode_associated['admin']->pluck('name','id');
    $order=$barcode_associated['warehouse_out_management']->order;

@endphp
@include('admin.common.field._input',['title'=>'产品条码','field'=>'code','field_val'=>$barcode_associated['code'],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'受理时间','field'=>null,'field_val'=>$barcode_associated['barcode_associated']->created_at,'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'产品类型','field'=>null,'field_val'=>$barcode_associated['product_good']->product->title,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('product_good_id',$barcode_associated['product_good']->id) !!}
@include('admin.common.field._input',['title'=>'产品规格','field'=>null,'field_val'=>$barcode_associated['product_good']->name,'other'=>['class'=>'checkNull','readonly']])

@include('admin.common.field._input',['title'=>'当前事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['status']],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'产品成色','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['barcode_associated']->product_colour],'other'=>['class'=>'checkNull','readonly']])

{!! Form::hidden('user_id',$barcode_associated['warehouse_out_management']->user->id) !!}
@if(!empty($barcode_associated['barcode_associated']->two_code))
    @include('admin.common.field._input',['title'=>'关联条码','field'=>null,'field_val'=>$barcode_associated['barcode_associated']->two_code,'other'=>['class'=>'checkNull','readonly']])
@endif
@if(!empty($barcode_associated['barcode_associated']->user))
@include('admin.common.field._input',['title'=>'关联客户','field'=>null,'field_val'=>$barcode_associated['barcode_associated']->user->username.'-'.$barcode_associated['barcode_associated']->user->nickname,'other'=>['class'=>'checkNull','readonly']])
@endif
@if(!empty($order))
@include('admin.common.field._input',['title'=>'经办人','field'=>null,'field_val'=>$admin_account[$order->market],'other'=>['class'=>'checkNull','readonly']])
@endif
@if(!empty($barcode_associated['supplier_managements']->name))
@include('admin.common.field._input',['title'=>'供货商','field'=>null,'field_val'=>$barcode_associated['supplier_managements']->name,'other'=>['class'=>'checkNull','readonly']])
@endif
@if(!empty($barcode_associated['procurement_plan']->purchase))
@include('admin.common.field._input',['title'=>'采购人员','field'=>null,'field_val'=>$admin_id[$barcode_associated['procurement_plan']->purchase],'other'=>['class'=>'checkNull','readonly']])
@endif
{!!  Form::hidden('admin',admin()->id,["class"=>'checkNull','readonly']) !!}
@include('admin.common.field._input',['title'=>'操作人员','field'=>null,'field_val'=>$admin_id[$barcode_associated['barcode_associated']->admin],'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._textarea',['title'=>'备注信息','field'=>null,'field_val'=>$barcode_associated['barcode_associated']->postscript,'other'=>['readonly']])

{!!  Form::hidden('product_colour',$barcode_associated['barcode_associated']->product_colour ?? 'new',["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('warehouse_out_management_id',$barcode_associated['warehouse_out_management']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('order_id',$barcode_associated['warehouse_out_management']->order->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('barcode_associated_id',$barcode_associated['barcode_associated']->id ?? 0,["class"=>'checkNull','readonly']) !!}




