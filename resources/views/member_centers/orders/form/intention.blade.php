@include('member_centers.orders.components.lookPic')
<div class="pro_detail" id="app">
    @if($order->order_type !='parts')
             @include('member_centers.orders.components.material_editor')
   @endif
</div>
<!--   编辑配置  END  -->
<!--<button class="editShop">编辑</button>-->
<div class="order_xiadan">
        {!! Form::open(['onsubmit'=>'return false','method'=>'put','class'=>'order_edit']) !!}
        <div class="body orderBody">
            <div class="wrap">
                <div id="crumbs">
                    <a href="/">首页</a> > <a href="javascript:history.back()" target="_blank;"> 我的订单 </a>
                    > {{ $order->serial_number }}
                </div>
                <div class="want_confirm">
                    @include('member_centers.orders.components.logistics')
                    @include('member_centers.orders.components.product')
                    @include('member_centers.orders.components.service')
                    @include('member_centers.orders.components.company')
                    <div class="otherInfo">
                        <h5 class="orderTit">备注信息</h5>
                        <textarea name="user_remark"
                                  placeholder="如有其他需求请备注，字数请限制在300字以内，如有特殊要求，请与在线客服取得联系。">{{ optional($order)->user_remark ?? '' }}</textarea>
                    </div>
                    @include('member_centers.orders.components.confirmInfo')
            </div>

        </div>
</div>
{!! Form::close() !!}
</div>
