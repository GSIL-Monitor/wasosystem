<div class="lookType">
    <ul class="radiusBtn">
        @if(is_array($datas))
        @foreach($datas as $key=>$data)
            @if($key == $duiBiCanShu)
                <li class="active"><a href="{{ $url }}?{{ $canshu }}={{ $key }}{{ $link ?? '' }}">{{ $data }}</a></li>
            @else
                <li class=""><a href="{{ $url }}?{{ $canshu }}={{ $key }}{{ $link ?? '' }}">{{ $data }}</a></li>
            @endif
        @endforeach
            @else
            @foreach($datas as $data)
                @if($data->id == $duiBiCanShu)
                    <li class="active"><a href="{{ $url }}?{{ $canshu }}={{ $data->id }}{{ $link ?? '' }}">{{ $data->title }}</a></li>
                @else
                    <li class=""><a href="{{ $url }}?{{ $canshu }}={{ $data->id }}{{ $link ?? '' }}">{{ $data->title }}</a></li>
                @endif
            @endforeach
        @endif
        @if(isset($add))
                @foreach($add as $key=>$item)
                    <li class=""><a class="changeWeb" data_url="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                @endforeach
        @endif
    </ul>
</div>