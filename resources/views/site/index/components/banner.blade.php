<div id="banner">
    <div class="main_pic">
        @foreach($banners as $banner)
            @php $pic=json_decode($banner->pic,true); @endphp
            <div class="bannerPage " name="{{ $loop->index }}" data-ppic="{{ $pic[0]['url'] }}"
                 data-mpic="{{ $pic[0]['url'] }}" target="_blank" data-color="{{ $banner['field']['color'] }}">
                <div class="moveBox"><span class="{{ $banner['field']['font_color'] }}" data-float="{{ $banner['field']['font_float'] }}"><em><h5>{{ $banner['field']['max_font'] }}</h5><h1>{{ $banner['field']['min_font'] }}</h1>
                            @if($banner['field']['more'] == '1' && !empty($banner['field']['url']))
                                <a href="http://{{ $banner['field']['url'] }}" target="_blank"><i></i><b>了解更多</b></a>
                            @endif
                    </em></span></div>
            </div>
        @endforeach
    </div>

    <div class="main_point">
        <ul class="whitePoint">
            @foreach($banners as $banner)
            <li data-color="{{  $banner['field']['font_color']  }}" data-number="{{ $loop->index }}"><b></b><i></i></li>
            @endforeach
        </ul>
    </div>
</div>