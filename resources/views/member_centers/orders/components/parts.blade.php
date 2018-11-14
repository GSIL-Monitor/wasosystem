@foreach($order->order_product_goods as $product_good)
    <div class="orderList orderList1 MainOrder">
        <div class="imgs"><img src="{{ asset('pic/product/'.$product_good->product->bianhao.'.png') }}"></div>
        <div class="links_a">{{ $product_good->jiancheng }}</div>
        <div class="price"  style="display: none"><span class="pri" data-id="{{ $product_good->pivot->product_good_price }}">{{ $product_good->pivot->product_good_price }}</span>.00元
        </div>
        <div class="num">
            <div class="num_box">
                <button class="delNum @if($product_good->pivot->product_good_num == 1) none @endif">-</button>
                <input type="text" class="PJnum good_num OneNumber" name="good_list[{{ $product_good->id }}]"
                       value="{{ $product_good->pivot->product_good_num  }}">
                <button class="addNum">+</button>
                <div class="clear"></div>
            </div>
        </div>
        <div class="total pri" style="display: none" ><span class="to">{{ $product_good->pivot->product_good_num  }}</span>
        </div>
        <div class="control" >
          <span><a class="Del" data_condition="{{ $order->id }}" data_id="{{ $product_good->id }}" data_url="{{ url('/orders/destory') }}"
                   data_title="{{ $product_good->jiancheng }}">删除</a></span>
        </div>
        <div class="clear"></div>
    </div>
@endforeach
<input type="hidden" name="num" value="{{ $order->num }}">