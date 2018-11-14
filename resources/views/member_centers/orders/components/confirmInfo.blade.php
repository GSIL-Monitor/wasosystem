<div class="confirmInfo">
    <div class="erweiBox">
        <h5>配置代码</h5>
        <input type="text" value="{{ $order->code }}" class="codes" disabled>
        <button class="copyInfoBtn" data-clipboard-text="{{ $order->code }}">复制代码</button>
        <a href="javascript:;" class="PC_hide">查看配置二维码</a>
        <div id="peizhi"></div>
    </div>
    <div class="tableTotal total">
        <div class="editOpen"></div>
        <div class="orderPrice ">
            <ul>
                <li class="fixHide"><span class="bottomTit">商品数量：</span><span
                            class="bottomContent"><b><i class="proTotalNum">{{ $order->num }}</i>个</b></span>
                    <div class="clear"></div>
                </li>
                <li class="fixHide"><span class="bottomTit">商品金额<i>@if($order->invoice_type !='no_invoice')（含17%增值税) @endif</i>：</span><span
                            class="bottomContent"><b><i
                                    class="Pro_Total">{{ $order->total_prices }}</i>.00元</b></span>
                    <div class="clear"></div>
                </li>
                <li class="fixHide"><span class="bottomTit">服务费：</span><span class="bottomContent"><b><i
                                    class="service_price">{{ $order->service_status }}</i>.00元</b></span>
                    <div class="clear"></div>
                </li>
                <li class="botLi"><span class="bottomTit">应付金额：</span><span class="bottomContent"><b><i
                                    class="total_prices">{{ $order->total_prices }}</i>.00元</b></span>
                    <div class="clear"></div>
                </li>
                <li class="leftLi"><span class="bottomTit">款项状态：</span>
                    <span class="bottomContent">
                        @if($order->payment_status == 'account_paid')
                            已付货款
                            @else
                            未付货款
                        @endif
                    </span>
                    <div class="clear"></div>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<div class="confirm_btns">
    <div class="confirm_btn">
        <div class="Btn_price"><em>应付金额：</em><span><b class="AllPri">{$order.price}</b>.00元</span>
        </div>
        <input type="hidden" id="price" value="{{ $order->total_prices }}" name="total_prices" autocomplete="off">
        <input type="hidden" id="unit_price" value="{{ $order->unit_price }}" name="unit_price" autocomplete="off">

        <input type="hidden"  value="{{ $order->order_type }}" class="order_type" autocomplete="off">
        <input type="hidden" class="shuidian" value="{{ user()->tax_rates->identifying }}"/>
        <a class="goBack" href="">返回</a>
        <a class="phoneThrBtn order_save" data-status="intention_to_order"   data-url="{{ route('orders.update',$order->id) }}">意向保存</a>
        <a class="confirm phoneThrBtn order_save" data-status='placing_orders'   data-url="{{ route('orders.update',$order->id) }}">下单订货</a>
    </div>
    <div class="clear"></div>
</div>