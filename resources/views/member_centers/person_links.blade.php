@foreach(config('site.member_center_links') as $title=>$item)
    <dl>
        <dt>{{ $title }}</dt>
        @foreach($item as $url=>$value)
            @if(user()->parts_buy && $url== 'parts_buy.index')
                <dd><a href="{{ route($url) }}" class="@if(Route::is($url)) active @endif">{{ $value['name'] }}111 {{ user()->parts_buy && $url== 'parts_buy.index' }}</a><img src="{{ config('site.member_center_links_pic') }}"></dd>
                @else
                <dd><a href="@if(Route::has($url)) {{ route($url) }}  @endif" class="@if(Route::is($url)) active @endif">{{ $value['name'] }}</a><img src="{{ config('site.member_center_links_pic') }}"></dd>
            @endif
        @endforeach
    </dl>
@endforeach
