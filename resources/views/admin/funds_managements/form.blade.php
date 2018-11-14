<table class="listTable">
    <tr>
        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
        <th  class="">订单序列号</th>
        <th class="">订单状态</th>
        <th class="">订单未付价格</th>
        <th class="">付款情况</th>
        <th class="">款项状态</th>
        <th class="">提交时间</th>
        <th class="">操作</th>
    </tr>
    @forelse($orders as $order)
        <tr>
            <td class="tableInfoDel">
                <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $order->id }}">
            </td>
            <td class="tableInfoDel  tablePhoneShow  tableName">
                {{ $order->serial_number }}
            </td>
            <td class="">{{ $parameters['order_status'][$order->order_status] }}</td>
            <td class="">{{ $order->total_prices }}</td>
            <td class="payments">
                @php
                $price=$funds_management->where([
                ['comment','like',"%$order->serial_number%"],
                ['type','=','down_payment'],
                ])->sum('price');
                @endphp
               已支付 <span> {{ $price }}</span>
               未支付 <span class="payment"> {{ $order->total_prices - $price }}</span>
            </td>
            <td class="">{{ $parameters['payment_status'][$order->payment_status] }}</td>
            <td class="">{{ $order->created_at }}</td>
            <td class="pays"><a class="pay" data-type="down_payment" serial_number="{{ $order->serial_number }}" price="{{ $order->total_prices - $price }}" >支付定金</a></td>
        </tr>
    @empty
        <tr><td><div class='error'>没有数据</div></td></tr>
    @endforelse
</table>