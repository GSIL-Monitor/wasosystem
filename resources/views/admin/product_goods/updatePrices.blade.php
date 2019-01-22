@extends('admin.layout.default')
@section('css')
    <style>
        .listTable tr td input {width: 60px; border:1px solid #ddd; line-height:25px;}
        .listTable tr td input[readonly]{background:none; border:none;}

        .listTable tr td i{display: inline-block; width:15px; height:15px; vertical-align: middle;}
    </style>
@endsection
@section('js')
    <script src="{{ asset('admin/js/goodPriceUpdate.js') }}"></script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit updatePrices')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
            </div>
            @include('admin.common._search',[
            'url'=>route('admin.product_goods.updatePrices'),
            'status'=>array_except(Request::all(),['type','keyword','_token']),
            'condition'=>[
                'name'=>'产品型号',
                'jiancheng'=>'产品简称',
            ]
            ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.updatePrices'),'canshu'=>'product_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="product_goods">
            <table class="listTable">

                <tr>
                    <th >序号</th>
                    <th class="tableInfoDel">产品型号</th>
                    <th class="tableMoreHide">销量</th>
                    <th class="tableMoreHide">新品</th>
                    <th class="tableMoreHide">良品</th>
                    <th class="tableMoreHide">坏货</th>
                    <th>零售价格</th>
                    <th>会员价格</th>
                    <th>合作价格</th>
                    <th>核心价格</th>
                    <th>成本价格</th>
                    <th>淘宝价格</th>
                    <th>产品销量</th>
                    <th>价格浮动</th>
                    <th>更新时间</th>
                </tr>
                @forelse($product_goods as $product_good)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">{{ $product_good->name }}</td>
                        <td class="tableMoreHide">{{ $product_good->product_goods_order->sum('pivot.product_good_num') }}</td>
                        <td class="tableMoreHide">{{ optional($product_good->inventory_management)->new ?? 0 }}</td>
                        <td class="tableMoreHide">{{ optional($product_good->inventory_management)->good ?? 0 }}</td>
                        <td class="tableMoreHide">{{ optional($product_good->inventory_management)->bad ?? 0 }}</td>
                        @foreach(config('status.procuctGoodPrices') as $key=>$value)
                            @if($key=='cost_price' || $key=='taobao_price')
                                <td>{!!  Form::number('edit['.$product_good->id.'][price->'.$key.']',old('edit['.$product_good->id.'][price->'.$key.']',$product_good->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'class'=>'checkNull cost_price','original_price'=>$product_good->price[$key],'data-id'=>$product_good->id,'id'=>$key.$product_good->id,'onkeyup'=>'this.value=(this.value>0)?this.value:0','original_price'=>$product_good->price[$key] ?? 0]) !!}   </td>
                            @else
                                <td>{!!  Form::number('edit['.$product_good->id.'][price->'.$key.']',old('edit['.$product_good->id.'][price->'.$key.']',$product_good->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key.$product_good->id]) !!}   </td>
                            @endif
                        @endforeach
                        <td> {!!  Form::hidden('edit['.$product_good->id.'][float]',old('edit['.$product_good->id.'][float]',$product_good->float),['readonly','class'=>'checkNull','id'=>'float'.$product_good->id]) !!}
                            @switch($product_good->float)
                                @case("come-up")
                               <i class="UP"></i>
                                @break
                                @case("lower")
                                <i class="HOLD"></i>
                                @break
                                @default
                                <i class="DOWN"></i>
                            @endswitch
                        </td>
                        <td class="">{{ $product_good->updated_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <div class="empty">没有数据</div>
                @endforelse
            </table>
                {{ $product_goods->appends(Request::except(['_token','page']))->links() }}
            </form>
        </div>
    </div>

@endsection