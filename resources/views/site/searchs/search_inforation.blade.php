<div class="searchResultPage searchNews">
    <div class="s_news s_info">
        <dl>
            @foreach($informationManagements->take(10) as $search)
                <dd>
                    <a href="{{ route('news.show',$search->id) }}">
                        {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold' >".Request::get('key')."</font>",$search->name) !!}
                    </a>
                    <p>
                        {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->description) !!}
                    </p>
                    <i class="round time">{{ $search->created_at->format('Y-m-d') }}</i>
                </dd>
            @endforeach
                @if($informationManagements->count() > 10)
                <div class="more_hide">
                    @foreach($informationManagements as $search)
                        @if($loop->index > 9)
                        <dd>
                            <a href="{{ route('news.show',$search->id) }}">
                                {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name) !!}
                            </a>
                            <p>
                                {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->description) !!}
                            </p>
                            <i class="round time">{{ $search->created_at->format('Y-m-d') }}</i>
                        </dd>
                        @endif
                    @endforeach
                    <i class="noMore">没有更多的结果了</i>
                </div>
                <span class="lookAll" >显示更多</span>
          @endif
        </dl>
    </div>
</div>
