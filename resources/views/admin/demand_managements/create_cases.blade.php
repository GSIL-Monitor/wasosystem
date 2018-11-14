@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/create_order.js') }}"></script>
    <script>
        $(function () {
            ConfigurationCodeCreate();
            qrcodeCreate();
            zheng_JiXingHao_Create();
            @if($cate!='parts')
            get_machine_balance("{{ route('admin.demand_managements.add_modified_temporary_materials',$demand_management->id) }}");
            @endif
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="Btn create_orders blue"  data_url="{{ route('admin.demand_managements.add_modified_temporary_materials',$demand_management->id) }}">生成订单</button>
                <button class="Btn AllDel"  data_url="{{ url('/waso/demand_managements/destory') }}?delOrder=admins&cate={{ $cate }}">删除</button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            @if($cate=='parts')
            @include('admin.common._search',[
             'url'=>route('admin.demand_managements.show',$demand_management->id),
             'status'=>array_except(Request::all(),['keyword','_token']),
             'placeholder'=>'请输入配置代码',
             'btn'=>'生成配置'
             ])
            @endif
            <div class="phoneBtnOpen"></div>
            <div class=PageBtnTxt><div>客户信息：{{ $demand_management->user->username }} ({{ $demand_management->user->nickname }} => {{ $demand_management->user->grades->name }})</div></div>
        </div>

        <div class="PageBox">
              @include('admin.common._lookType',['datas'=>$order_type,'duiBiCanShu'=>$cate,'url'=>route('admin.demand_managements.show',$demand_management->id),'canshu'=>'cate'])
              {!! Form::open(['route'=>'admin.demand_managements.store','method'=>'post','id'=>'demand_managements','onsubmit'=>'return false']) !!}
           <ul class="maxUl shengchengUl">
              <li class="allLi">
                 <div class="liLeft">配置代码</div>
                 <div class="liRight">
                   {!!  Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']) !!}
                   <div class="codeBox">
                     <div id="qrcode"></div>
                     <button class="Btn OpenCode">显示二维码</button>
                     <button class="Btn CloseCode" style="display: none;">隐藏二维码</button>
                   </div>
                 </div>
                 <div class="clear"></div>
              </li>

                {!!  Form::hidden('null',$code ?? $order_type_code[$cate],["class"=>'code','readonly']) !!}
                {!!  Form::hidden('order_type',old('order_type',!empty($code) ? $order_type_code_str[$code] : $cate),["class"=>'order_type','readonly']) !!}
              <li class="allLi">
                <div class="liLeft">整机型号</div>
                <div class="liRight">{!!  Form::text('machine_model',old('machine_model'),['placeholder'=>'整机型号',"class"=>'checkNull name','readonly']) !!}</div>
                <div class="clear"></div>
              </li>
                {!!  Form::hidden('null',$demand_management->user->tax_rates->identifying,["class"=>'tax_point','readonly']) !!}
                {!!  Form::hidden('status','添加') !!}
                {!!  Form::hidden('num',1,["class"=>'order_num','readonly']) !!}
                {!!  Form::hidden('price_spread',0,['placeholder'=>'整机差额',"class"=>'price_spread','readonly']) !!}
              <li class="allLi">
                 <div class="liLeft">整机差额</div>
                 <div class="liRight">{!!  Form::text('total_prices',$productGood_prices,['placeholder'=>'总价',"class"=>'total_prices','readonly']) !!}</div>
                 <div class="clear"></div>
              </li>

             <li class="allLi">
                <div class="liLeft">配件列表</div>
                <div class="liRight">
                  @include('admin.demand_managements.table.table')
                  {!! Form::close() !!}
                </div>
                <div class="clear"></div>
             </li>
            @if($cate == 'parts')
                @include('admin.common._addTemporayProduct',['url'=>route('admin.demand_managements.add_modified_temporary_materials',$demand_management->id).'?cate='.$cate,'id'=>$demand_management->id])
            @else
                @include('admin.common._addCompleteMachineTemporayProduct',['url'=>route('admin.demand_managements.add_modified_temporary_materials',$demand_management->id).'?cate='.$cate,'id'=>$demand_management->id])
            @endif
           </ul>
        </div>
    </div>

@endsection