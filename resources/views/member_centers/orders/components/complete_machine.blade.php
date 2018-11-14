<div class="orderList MainOrder">
    <div class="imgs openImg">
        <ul class="scroll_pic">
            <li><span><img src="{{ order_complete_machine_pic($order->order_product_goods) }}"></span></li>
        </ul>
    </div>
    <div class="links_a openDetail">{{ $order->machine_model }}</div>
    <div class="price"><span class="pri danjia" data-id="{{ $order->unit_price }}">{{ $order->unit_price }}</span>.00元</div>
    <div class="num">
        <div class="num_box">
                <button class="delNum @if($order->num == 1) none @endif">-</button>
                <input type="text" class="good_num " name="num" value="{{ $order->num }}"
                       autocomplete="off">
                <button class="addNum"  >+</button>
            <div class="clear"></div>
        </div>
    </div>
    <div class="total pri"><span class="to total_to"></span>.00元</div>
    @if($order->order_status =='intention_to_order')
    <div class="control"><span><a class="editDetail" href="javascript:;">修改配置</a></span>
    @endif
    </div>
    <span class="clear"></span>
</div>

<div class="detailTable">
    <ul>
        @foreach($order_details['complete_machine_detailed'] as $key=>$detail)
        <li><span class="DTit">{{ $key }}</span><span>{{ $detail }}</span>
            <div class="clear"></div>
        </li>
        @endforeach
            <li><span class="DTit">温馨提示</span><span><span style="color: red">*以上内容仅供参考，不构成任何约束和承诺，详情及价格请联系客服！</span></span><div class="clear"></div></li>
    </ul>

    <div class="download">
        <a href="{{ route('orders.show',$order->id) }}?export=UnitQuotation&export_name=整机报价表">【下载 服务器明细及报价表】</a>
        @if(user()->parts_buy)
        <a href="{{ route('orders.show',$order->id) }}?export=AccessoriesOffer&export_name=配件报价表">【下载 服务器配件报价表】</a>
        @endif
        <p>* 报价表请在电脑端下载</p>
    </div>
</div>

   <span class="proDetail">展开配置<i></i></span>
    @foreach($order->order_product_goods as $product_good)
        <div class="complete_machine_parts" style="display: none">
            <div class="price TD"><span class="pri"
                                        data-id="{{ $product_good->pivot->product_good_price }}">{{ $product_good->pivot->product_good_price }}</span>.00元
            </div>
            <div class="num TD">
                <div class="num_box">
                    <input type="text" class="PJnum good_num OneNumber"
                           value="{{ $product_good->pivot->product_good_num  }}">
                    <div class="clear"></div>
                </div>
            </div>
            <div class="total TD"><span class="to"></span>.00元</div>
        </div>
@endforeach

