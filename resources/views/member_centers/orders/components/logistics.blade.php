<div class="address">
    <div class="Border borderTop"></div>
    <h5 class="orderTit">收货地址 <a href="{{ route('user_addresses.index') }}" target="_blank">新增 / 修改地址</a></h5>
    <!--  选中的地址  START   -->
    <div class="CheckAddr"></div>
    <div class="addrMore">
        <div class="addrBox">
            <ul class="chooseBox">
                <input type="hidden" name="logistics_id" class="logistics_id">
                @foreach($order->user->user_address as $address)
                    <li class="@if($order->logistics_id == $address->id)
                                active
                                @else
                                @if($address->default && !$order->logistics_id)
                                        active
                               @endif @endif
                                logistics"
                                data-id="{{ $address->id }}"
                    >
                        <div class="addrInfo" >
                            <i></i>
                            <span class="names"><em>{{ $address->number }}:</em>{{ $address->name }}</span>
                            <span class="tell">{{ $address->phone }}</span>
                            <span class="addr">{{ $address->address }}</span>
                            <span class="zhiD">{{ $address->logistics }}</span>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="addBtns">
        <a class="MoreBtn" target="_blank"><i></i></a>
    </div>
</div>