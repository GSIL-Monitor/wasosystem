@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if($status=='intention_to_order')
                @can('delete orders')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/orders/destory') }}">删除
                    </button>
                @endcan
                @endif
                @if(Request::has('source'))
                    <button class="changeWebClose Btn">返回</button>
                @endif

            </div>
            @include('admin.common._search',[
            'url'=>route('admin.orders.index'),
            'status'=>array_except(Request::all(),['type','keyword','_token','user_id']),
            'condition'=>[
                'serial_number'=>'订单序列号',
                'user_id'=>'用户账号',
                'market'=>'工号',
                'total_prices'=>'价格',
            ]
            ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>array_prepend($parameters['order_status'], '全部订单', 'all_orders'),'duiBiCanShu'=>$status,'url'=>route('admin.orders.index'),'canshu'=>'status','link'=>Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' ])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="orders">
            <table class="listTable">
                <tr>
                    @if($status=='intention_to_order')
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    @endif
                    <th class="tableInfoDel">订单序列号</th>
                    <th  class=""><a href="{{ route('admin.orders.index') }}?status={{ $status }}{{ Request::has('source')? '&'.array_to_url(array_except(Request::all(),['status'])) :'' }}">用户账号(取消用户)</a></th>
                    <th  class="">型号</th>
                    <th  class="">订单类型</th>
                    <th  class="">订单状态</th>
                    <th  class="">数量</th>
                    <th  class="">总金额</th>
                    <th  class="">款项状态</th>
                    <th  class="">含税状态</th>
                    <th  class="">提交时间</th>
                    <th  class=""><a href="{{ route('admin.orders.index') }}?status={{ $status }}">管理员</a></th>
                    <th class="">操作</th>

                </tr>

                @forelse($orders as $order)
                    <tr>
                        @if($status == 'intention_to_order')
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $order->id }}">
                        </td>
                        @endif
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="{{ route('admin.orders.edit',$order->id) }}">
                                @if($order->created_at == $order->updated_at)
                                <span class="redWord new">{{ $order->serial_number }}</span>
                                <i class="newOrder"></i>
                                    @else
                                {{ $order->serial_number }}
                                @endif
                            </a>
                        </td>
                        <td class=""><a href="{{ route('admin.orders.index') }}?user_id={{ $order->user_id }}&status={{ $status }}{{ Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' }}">{{ $order->user->username }} {{ $order->user->nickname }}</a></td>
                        <td class="">{{ $order->machine_model }}</td>
                        <td class="">{{ $parameters['order_type'][$order->order_type] }}</td>
                        <td class="">{{ $parameters['order_status'][$order->order_status] }}</td>
                        <td class="">{{ $order->num }}</td>
                        <td class="">{{ $order->total_prices }}</td>
                        <td class="">{{ $parameters['payment_status'][trim($order->payment_status)] }}  </td>
                        <td class="">{{ $parameters['invoice'][$order->invoice_type] }}</td>
                        <td class="">{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class=""><a href="{{ route('admin.orders.index') }}?market={{ $order->user->admins->account }}&status={{ $status }}{{ Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' }}">{{ $order->user->admins->name }}</a></td>
                         <td><a data_url="{{ route('admin.orders.copy',$order->id) }}" class="Copy">复制</a>
                             @if($order->order_type!='parts')
                                 <a data_title="常用配置名" data_parent_id="0" data_product_id="0" data_url="{{ route('admin.orders.add_common_equipment',$order->id) }}" class="OneAdd">常用</a>
                             @endif
                         </td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                {{ $orders->appends(Request::has('source')? array_except(Request::all(),['status','page']) :array_except(Request::all(),['page']) )->links() }}

            </form>
        </div>
    </div>

@endsection