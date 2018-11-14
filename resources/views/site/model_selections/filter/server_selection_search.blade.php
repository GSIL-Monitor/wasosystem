<div class="nowSit">
    <h5>已为您匹配{{ $server_selections->count() }}款配置<span class="goBtn"><b class="gotoBack">上一步</b></span></h5>
</div>
    <ul>
     @foreach($server_selections as $selection)
            <li class="@if(str_contains($loop->index,[3,7,11,15])) last @endif">
                <a href="" target="_blank">
                    <img src="{{ order_complete_machine_pic($selection->good->complete_machine_product_goods ?? $selection->complete_machine_product_goods) }}">
                    <h5>{{ $selection->name }}</h5>
                </a>
                <a class="savePro" href="">查看详情</a>
                <a class="savePro ">意向保存</a></li>
        @endforeach
        <div class="clear"></div>
    </ul>


