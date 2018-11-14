<div class="other">
    <h5 class="orderTit">票据信息<a href="{{ route('user_companies.index') }}" target="_blank">新增 / 修改信息</a></h5>
    <div class="p_piaoBox phoneOrderInfo">
        <div class="tit">票据信息</div>
        <div class="content"></div>
        <i class="arrow"></i>
        <div class="clear"></div>
    </div>


    <div class="other_box">
        <div class="tip"><i></i>选择【单位采购】，单价将变成含税价格 </div>
        @foreach(config('site.member_center_order_invoice') as $key=>$item)
            @php $invoice_type_active = '';
                 $invoice_type_checked=''
            @endphp
            @if($key == $order->invoice_type )
                @php $invoice_type_active = 'activeLabel';
                     $invoice_type_checked='checked'
                @endphp
            @endif
                <label class="chosL {{ $invoice_type_active }}" ><input type="radio" name="invoice_type" value="{{ $key }}" {{ $invoice_type_checked }} class="invoice">  {{ $item }}<em></em></label>
        @endforeach
        <div class="clear"></div>
        <div class="hide_box">
            <!--  选中的地址  START   -->
            <input type="hidden" name="invoice_info" class="invoice_info">
            <div class="ticksAddr"></div>
            <div class="addrMore">
                <div class="ticksBox">
                    <ul class="chooseBox">
                        @foreach($order->user->user_company as $item)
                            <li class="@if($order->invoice_info == $item->id)
                                    active
                                    @else
                                    @if($item->default && !$order->invoice_info)
                                    active
                                    @endif @endif company"
                                    data-id="{{ $item->id }}">
                                <div class="addrInfo ">
                                    <i></i>
                                    <span class="names">{{ $item->name }}</span>
                                    <span class="addr">{{ $item->invoice_type }}</span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                </div>
                <!-- 选择开票地址  END  -->
            </div>
            <div class="ticksBtns">
                <a class="MoreTicksBtn" target="_blank">更多单位<i></i></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>