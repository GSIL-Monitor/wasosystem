<div class="buy_left">
    <div class="main_pic" title="点击查看大图">
        @php $pics=order_complete_machine_pic($completeMachine->complete_machine_product_goods,'all') ?? [];@endphp
        @switch($completeMachine->marketing)
            @case('new')
            <i class="saleIcon newP"></i>
            @break;
            @case('hot')
            <i class="saleIcon hotP"></i>
            @break;
            @case('moods')
            <i class="saleIcon popP"></i>
            @break;
            @case('sale')
            <i class="saleIcon saleP"></i>
            @break;
        @endswitch
        <span data-close="" class="close" title="关闭">×</span>
        <span class="arrow leftArrow">‹</span>
        <span class="arrow rightArrow">›</span>
        <ul class="bigP">
          @forelse($pics as $item)
                <li class="@if($loop->index == 0)active @endif"
                    data-number="{{ $loop->index }}">
                    <img class="lazy"
                         data-original="{{ $item['url'] ?? '' }}"
                         data-src="{{ $item['url'] ?? ''}}">
                </li>
              @empty
          @endforelse
            <div class="clear"></div>
        </ul>
    </div>

    <div class="picsBox">
        <ul class="scroll_pic">
            @forelse($pics as $item)
                <li class="@if($loop->index == 0)active @endif" data-number="{{ $loop->index }}"><img src="{{ $item['url'] ?? '' }}"></li>
            @empty
            @endforelse
            <div class="clear"></div>
        </ul>
    </div>

    <div class="clear"></div>
</div>