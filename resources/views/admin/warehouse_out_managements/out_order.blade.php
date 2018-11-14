@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="warehouse_out_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">序列号</th>
                    <th class="">型号</th>
                    <th class="">收货单位</th>
                    <th class="">数量</th>
                    <th class="">经办人</th>
                    <th class="">下单时间</th>
                    <th class="">操作</th>
                </tr>

                @forelse($out_orders as $out_order)
                    @if(!$out_order->warehouse_out)
                <tr>
                    <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                           data_url="{{ route('admin.warehouse_out_managements.create') }}?id={{ $out_order->id }}">{{ $out_order->serial_number }}</a>
                    </td>
                    <td>{{ $out_order->machine_model ?? '' }}</td>
                    <td>{{ $out_order->user->username.' -  '.$out_order->user->nickname }}</td>
                    <td>{{ $out_order->order_product_goods->sum('pivot.product_good_num') }}</td>
                    <td>{{ $out_order->markets->name ?? '' }}</td>
                    <td class="">{{ $out_order->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($out_order->order_type !='parts' && str_contains($warehouse_out_model, substr($out_order->machine_model,0,3)))
                            <a data_url="{{ route('admin.warehouse_out_managements.inventory_machine') }}?id={{ $out_order->id }}" class="changeWeb">调用库存整机</a>
                        @endif
                    </td>
                </tr>
                @endif
        @empty
         <tr><td><div class='error'>没有数据</div></td></tr>
    @endforelse
</table>
</form>
{!! $out_orders->appends(Request::all())->render() !!}
</div>
</div>

@endsection