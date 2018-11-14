
    <div class="hotServer P_hide"@if($recommends->isEmpty()) style="display: none" @endif>
        <div class="wrap">
            <h6 class="tit">相关推荐</h6>
            <ul>
                @foreach($recommends as $recommend)
                    @php $recommendPic=order_complete_machine_pic($recommend->complete_machine_product_goods) ?? [];@endphp
                    <li class="@if($loop->index ==2) last @endif">
                        <a href="{{ route('server.show',$recommend->id) }}">
                            <img class="lazy" data-original="{{ $recommendPic }}">
                            <h5>网烁{{ $recommend->name }}</h5><span>立即查看</span>
                        </a>
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>
    </div>