@php
    $admin_account=$barcode_associated['admin']->pluck('name','account');
    $admin_id=$barcode_associated['admin']->pluck('name','id');
    $order=$barcode_associated['warehouse_out_management']->order;
    $user=$barcode_associated['warehouse_out_management']->user ??  $barcode_associated['barcode_associated']->user;
@endphp
@include('admin.common.field._input',['title'=>'产品条码','field'=>'code','field_val'=>$barcode_associated['code'],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['vue'=>'v-if="!showInput  "','title'=>'占位符','field'=>null,'field_val'=>'占位符','other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'产品类型','field'=>null,'field_val'=>$barcode_associated['product_good']->product->title,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('product_good_id',$barcode_associated['product_good']->id,['class'=>'product_good_id']) !!}
@include('admin.common.field._input',['title'=>'产品规格','field'=>null,'field_val'=>$barcode_associated['product_good']->name,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._input',['title'=>'当前事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['status']],'other'=>['class'=>'checkNull','readonly']])
@include('admin.common.field._input',['title'=>'受理时间','field'=>null,'field_val'=>$barcode_associated['warehouse_out_management']->created_at ?? $barcode_associated['barcode_associated']->created_at,'other'=>['class'=>'checkNull','readonly']])
{!! Form::hidden('user_id',$barcode_associated['warehouse_out_management']->user->id) !!}

@include('admin.common.field._input',['title'=>'收货单位','field'=>null,'field_val'=>$user->username.'-'.$user->nickname,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._select',['title'=>'选择事件','field'=>'current_state','field_list'=>array_only(config('status.barcode_associateds_type'),['sell_return','warranty_replacement','quality_acceptance','loan_out_to_replace']),'other'=>['placeholder'=>'请选择事件','class'=>'checkNull','v-model'=>'selected','@change'=>'changeSelect()']])

{!!  Form::hidden('product_colour',$barcode_associated['barcode_associated']->product_colour ?? 'new',["class"=>'checkNull','readonly']) !!}
@include('admin.common.field._select',['vue'=>'v-if="showInput || showColor"','title'=>'产品成色','field'=>'product_colour','field_list'=>array_only(config('status.barcode_associateds_type'),['new','good','bad']),'other'=>['placeholder'=>'请选择产品成色','class'=>'checkNull']])

@include('admin.common.field._input',['vue'=>'v-if="showInput"','title'=>'条码录入','field'=>'','other'=>["class"=>'code','v-model'=>'code','v-on:keyup.enter'=>"entering()"]])


@include('admin.common.field._input',['vue'=>'v-if="showInput"','title'=>'新条码','field'=>'two_code','other'=>['v-model'=>'new_code','readonly']])
@if(optional($loan_outs))
<li v-if="showTable">
<div class="liLeft">更换条码：</div>
<div class="liRight">
{!!  Form::select('two_code',$loan_outs,old('two_code'),['placeholder'=>'请选择要更换的条码',"class"=>'checkNull']) !!}

</div>
<div class="clear"></div>
</li>
@endif

@include('admin.common.field._input',['title'=>'供货商','field'=>null,'field_val'=>$barcode_associated['supplier_managements']->name,'other'=>['class'=>'checkNull','readonly']])
{!!  Form::hidden('admin',admin()->id,["class"=>'checkNull','readonly']) !!}
@include('admin.common.field._input',['title'=>'操作人员','field'=>null,'field_val'=>admin()->name,'other'=>['class'=>'checkNull','readonly']])


@include('admin.common.field._textarea',['title'=>'上一备注','field'=>null,'field_val'=>$barcode_associated['warehouse_out_management']->postscript ?? $barcode_associated['barcode_associated']->postscript ?? '','other'=>['readonly']])
@include('admin.common.field._textarea',['title'=>'备注信息','field'=>'postscript','field_val'=>null,'other'=>[]])


{!!  Form::hidden('warehouse_out_management_id',$barcode_associated['warehouse_out_management']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('order_id',$barcode_associated['warehouse_out_management']->order->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0,["class"=>'checkNull','readonly']) !!}
{!!  Form::hidden('barcode_associated_id',$barcode_associated['barcode_associated']->id ?? 0,["class"=>'checkNull','readonly']) !!}




