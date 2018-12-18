<div class="searchResultPage s_solution s_info searchSol">
    <ul>
        @foreach($integrations->take(10) as $search)
            <li>
                <a href="{{ route('solution.show',$search->id) }}">
                    <div class="pic"><img  class="lazy" src="{{ json_decode($search->pic,true)[0]['url'] ?? '' }}"></div>
                    <div class="infos">
                        <b>
                            {!! str_ireplace(Request::get('key'), "<font  style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->name) !!}
                        </b>
                        <p>
                            {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->description) !!}
                        </p>
                        <i class="round time">{{ $search->created_at->format('Y-m-d') }}</i>
                    </div>
                </a>
            </li>
        @endforeach
        <div class="clear"></div>
            @if($integrations->count() > 10)
            <div class="more_hide">
                @foreach($integrations as $search)
                    @if($loop->index > 9)
                    <li>
                        <a href="{{ route('solution.show',$search->id) }}">
                            <div class="pic"><img  class="lazy" src="{{ json_decode($search->pic,true)[0]['url'] ?? '' }}"></div>
                            <div class="infos">
                                <b>
                                    {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->name) !!}
                                </b>
                                <p>
                                    {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->description) !!}
                                </p>
                                <i class="round time">{{ $search->created_at->format('Y-m-d') }}</i>
                            </div>
                        </a>
                    </li>
                    @endif
                    @endforeach
                <div class="clear"></div>
                <i class="noMore">没有更多的结果了</i>
            </div>
            <div class="clear"></div>
            <span class="lookAll" >显示更多</span>
            @endif
        <div class="clear"></div>
    </ul>
</div>
