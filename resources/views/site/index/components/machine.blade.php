<div class="indexPro">
    <div class="wrap">
        <div class="indexTit">推荐</div>
        <ul>
            @foreach($complete_machines as $complete_machine)
                @php $pics=order_complete_machine_pic($complete_machine->complete_machine_product_goods,'all');@endphp
                <li>
                    <a href="@if($complete_machine->parent_id ==1 )
                    {{ route('server.show',$complete_machine->id) }}
                    @else
                    {{ route('server.designer',$complete_machine->id) }}
                    @endif">
                        @switch($complete_machine->marketing)
                            @case('new')
                            <i class="saleIcon newP">新品</i>
                            @break;
                            @case('hot')
                            <i class="saleIcon hotP">热卖</i>
                            @break;
                            @case('moods')
                            <i class="saleIcon popP">人气</i>
                            @break;
                            @case('sale')
                            <i class="saleIcon saleP">折扣</i>
                            @break;
                        @endswitch
                        <div class="proPic">

                            <img data-original="{{ $pics[0]['url'] ?? '' }}" class="topPic lazy">
                            <img data-original="{{ $pics[1]['url'] ?? '' }}" class="botPic lazy">
                        </div>
                        <div class="name">
                            <h5>网烁{{ explode('-',$complete_machine->name)[0] }}</h5>
                            <p>{{ $complete_machine->additional_arguments['product_description'] }}</p>
                        </div>
                    </a>
                </li>
            @endforeach

            <div class="clear"></div>
        </ul>
    </div>
</div>