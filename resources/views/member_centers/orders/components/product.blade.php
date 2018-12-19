<div class="pro_list">
    <h5 class="orderTit">商品信息<span>订单编号：{{ $order->serial_number }}</span></h5>
    <div class="orderTable">
        <div class="ComfirInfo">
            <div class="menu">
                <div class="imgs" style="text-align:left;">商品</div>
                <div class="links_a"></div>
                @if($order->order_type !='parts')
                    <div class="price">单价</div>
                @endif
                <div class="num"> 数量</div>
                @if($order->order_type !='parts')
                    <div class="total"> 小计</div>
                @endif
                <div class="control"> 操作</div>
            </div>
            @if($order->order_type !='parts')
                @include('member_centers.orders.components.complete_machine')
            @else
                @include('member_centers.orders.components.parts')
            @endif
        </div>

        <div class="orderTotal">合计：<span><b class="AllPri"></b>.00元</span></div>
    </div>
    <!--购物车订单 结束-->
