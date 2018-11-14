@extends('admin.layout.default')
@inject('OrderParamenterPresenter','App\Presenters\OrderParamenterPresenter')
@php
    $raids=$OrderParamenterPresenter->raids();
  $goodss=$OrderParamenterPresenter->get_goods($common_equipment_product_goods,$common_equipment);
@endphp
@section('css')
    <style>
        *{box-sizing: border-box;}
        .pro_detail .addPro{padding:8px 0;}
        .pro_detail .addPro .addTypeBox{float:left;}
        .pro_detail .addPro .addNumBox{display:none;}
        .pro_detail .addPro .addNumBox input{text-align: center;}
        .pro_detail .addPro .addTypeBox select{border:1px solid #999; line-height: 24px; margin-right:10px; float:left; }
        .pro_detail .addPro .addTypeBox input{border:1px solid #d4d4d4; line-height: 24px; width:55%; }
        .pro_detail .addPro .addNumBox input{border:1px solid #d4d4d4;  line-height: 24px; width: 10%;color: red}
        .pro_detail .addPro .addBtn input{line-height:26px; border:none;}
         .A_num .A_numbox{font-size: 14px; text-align: center;}
        .A_num .A_numbox button{float:left; cursor: pointer; background:#fff; font-size: 15px;color:#333; height:30px;}
        .A_num .A_numbox input{border:1px solid #999!important; background:#fff!important; float:left; width:60%; height:30px; text-align: center; line-height:30px;}
        .A_num .A_numbox .none{color:#fff; cursor: default; background: #fff;}
        .pro_detail .BtnR button{line-height:35px;}
        .pro_detail .BtnR .baocun{line-height:35px; display:inline-block; vertical-align:middle;}
        .raids select{display: none}
    </style>
@endsection
@section('js')
    <script src="{{ asset('admin/js/order_edit.js') }}"></script>
    <script>
        $(function () {
            check_terrace();
            A_checkNum();
            zheng_JiXingHao_Create();
            hard_disk();
        })
    </script>
@endsection
@section('content')
    <div class="nowWebBox pro_detail">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit orders')
                    <button type="submit" class="Btn common_add" form_id="orders"
                            location="top">保存</button>
                @endcan
                @can('delete orders')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/common_equipments/destory') }}?goodDel=admins">删除
                    </button>
                @endcan
                <button class="changeWebClose Btn all_delete" data_url="{{ url('/waso/common_equipments/destory') }}?goodDel=allDelete"  order_id="{{ $common_equipment->id }}">返回</button>
                {!!  Form::hidden('null',$common_equipment->id,["class"=>'order_id']) !!}
                {!!  Form::hidden('null',$common_equipment->num,["class"=>'order_num']) !!}
                {!!  Form::hidden('null',0,["class"=>'price_spread']) !!}
                {!! Form::model($common_equipment,['route'=>['admin.common_equipments.add_modified_temporary_materials',$common_equipment->id],'id'=>'orders','method'=>'post','onsubmit'=>'return false']) !!}
                <li>
                    @php $total_price=$common_equipment->common_equipment_product_goods->sum(function ($item){
                         return $item->pivot->product_good_price * $item->pivot->product_good_num ;
                }); @endphp
                {!!  Form::text('total_prices',$total_price,["class"=>'total_prices','readonly']) !!}
                @if($common_equipment->order_type!='parts')
                {!!  Form::text('machine_model',old('machine_model',$common_equipment->machine_model),['placeholder'=>'整机型号',"class"=>'name','readonly']) !!}
                @endif
                </li>

                {!! Form::close() !!}
                {!!  Form::hidden('null',$parameters['order_type_code'][$common_equipment->order_type],["class"=>'code']) !!}
                <div class="DoneControl">
                    <div class="A_allTotal">合计 <b>{{ $total_price }}</b>.00元 </div>
                    <div class="clear"></div>
                </div>

            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox detail_inner">

                            <table class="listTable">
                                <tr class="tit">
                                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                                    <th class="">类型</th>
                                    <th class="tableInfoDel">名称</th>
                                    <th class="">单价</th>
                                    <th class="">数量</th>
                                    <th>&nbsp;</th>
                                    <th>合计</th>
                                </tr>
                                @include('admin.common_equipments.complete_machine_table')
                                <tfoot>
                                <tr class="tit">
                                    <td colspan="7">
                                        <div class="addPro" id="app" >

                                            {!!  Form::select('product',$parameters['product'],old('product'),['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']) !!}

                                            <select2 :good-list="goodList" ref="Child"></select2>
                                            <input type="number"  value="" v-model="good_nums">
                                            <div class="clear"></div>
                                            <input class="Btn" type="button" @click="add_good()" value="添加">
                                        </div>
                                    </td>
                                </tr>
                                <tfoot/>
                            </table>
                    <div class="clear"></div>


            </div>
        </div>
    </div>

    @include('admin.common._addTemporayProduct',['url'=>route('admin.common_equipments.add_modified_temporary_materials',$common_equipment->id),'id'=>$common_equipment->id ?? Auth::user()->id])
@endsection
