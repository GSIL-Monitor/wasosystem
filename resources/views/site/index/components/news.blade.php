<div class="pic_news">
    <div class="wrap">
        <div class="news">
            <div class="newTit">
                <h5>最新资讯</h5>
                <a href="{{ url('/news_gongsi.html') }}">查看更多+</a>
            </div>
            <div class="newsPicList">
                <ul>
                    @foreach($new_boutiques as $new_boutique)
                    <li>
                        <a href="{{ route('news.show',$new_boutique->id) }}">
                            <div class="newsPic"><img src="{{ pic($new_boutique->pic)[0]['url'] ?? '' }}"></div>
                            <div class="newsName">{{ $new_boutique->name }}</div>
                            <div class="newsTime"><span>{{ $new_boutique->created_at->format('Y-m-d') }}</span></div>
                            <div class="newsTxt">{{ str_limit($new_boutique->description,100) }}</div>
                            <div class="whiteBg"></div>
                        </a>
                    </li>
                        @endforeach
                </ul>
            </div>

            <div class="newsList">
                <dl class="newAutoBox"><!--  默认读取 18条 -->
                    @foreach($new_lists as $new_list)
                        <dd><a href="{{ route('news.show',$new_list->id) }}">【{{ config('site.index_newType')[$new_list->type] }}】{{ $new_list->name }}</a></dd>
                    @endforeach
                    <div class="clear"></div>
                </dl>
            </div>

        </div>

        <div class="friendLinks">
            <dl>
                <dt>友情链接</dt>
                <dd>
                    @foreach($friends as $friend)
                    <a href="{{ $friend->field['url'] }}" name="F_news" target="_blank">{{ $friend->field['name'] }}</a>
                    @endforeach
                    <div class="clear"></div>
                </dd>
                <div class="clear"></div>
            </dl>
        </div>

    </div>
</div>