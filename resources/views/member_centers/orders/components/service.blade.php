<div class="other">
    <h5 class="orderTit">服务模式 <a href="{{ route('service_support.service_clause',41) }}" target="_blank">服务说明</a></h5>
    <div class="p_serverBox phoneOrderInfo">
        <div class="tit">服务模式</div>
        <div class="content">原厂邮寄送修服务(免费)</div>
        <i class="arrow"></i>
        <div class="clear"></div>
    </div>
    <div class="serverBox">
        @foreach($service_status as $status)
        <label class="chosL @if($status->identifying  == $order->service_status) activeLabel @endif">
            <i class="chooseIcon"></i>
            <input type="radio" autocomplete="off"   @if($status->identifying  == $order->service_status)) checked  @endif  class="service_status" name="service_status" value="{{ $status->identifying }}">
            {{ $status->name }}
          </label>
        @endforeach
        <div class="clear"></div>
    </div>
</div>