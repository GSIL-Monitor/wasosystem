@extends('site.news.layouts.default')
@section('title',$news_title)
@section('css')
    <link href="{{ asset('css/newsPublic.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/news.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')

@endsection
@section('content')
    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="/">网烁官网</a> <i>></i>
                {{ config('site.news_type_cn')[$type] }}
            </div>
            <ul class="newsType">
                @foreach(config('site.news_type_cn') as $key=>$value)
                    <li  ><a href="{{ url('/news_'.$key.'.html') }}" class="@if($type == $key) li2 @endif"><i></i>{{ $value }}</a></li>
                @endforeach
                <div class="clear"></div>
            </ul>

            <div class="newsBox ">
                <div class="news_left">
                    <ul class="news_ul">
                      @if($news->isEmpty())
                            <li><span class="empty_word">暂无相关信息</span></li>
                      @else
                          @foreach($news as $new)
                                <li>
                                    <a href="{{ route('news.show',$new->id) }}"  class="c" target="_blank">
                                        <h5 class="newsName">{{ $new->name }}
                                            <span class="newsTips">
                                            @if($loop->index == 0)<i class="newTips">最新</i>@endif
                                          @foreach(array_except($new->marketing,'show') as $key=>$item)
                                               @if($item)
                                               <i class="{{ $key }}">{{ config('status.information_management_marketing')[$key] }}</i>
                                               @endif
                                          @endforeach
                                        </span>
                                            <div class="time"><i class="newsIcon newsTime" title="发布时间"></i>{{ $new->created_at }}<i title="阅读量" class="newsIcon newsRead"></i>{{ $new->visits()->count() }}阅读</div>
                                        </h5>
                                        <div class="pic lazy" style="background-image: url({{ pic($new->pic)[0]['url'] ?? '' }})">
                                        </div>
                                        <div class="words"><p>{{ $new->description }}</p></div>
                                        <div class="readMore">查看更多</div>
                                        <div class="clear"></div>
                                    </a>
                                </li>
                           @endforeach

                         @endif
                    </ul>
                    {!! $news->appends(Request::except('page'))->render() !!}
                </div>


                <div class="news_right news_right_abs">
                    <div class="right_wrap">
                        <div class="goodNews">
                            <div class="NRtits"><b>精选文章</b></div>
                            <ul>
                               @foreach($choiceness_news as $choiceness)
                                    <li>
                                        <a href="{{ route('news.show',$choiceness->id) }}" target="_blank">
                                            <div class="imgBox "><img class="lazy" data-original="{{ pic($choiceness->pic)[0]['url'] ?? ''  }}"></div>
                                            <p>{{ $choiceness->name }}</p>
                                        </a>
                                    </li>
                               @endforeach
                            </ul>
                        </div>

                        <div class="hotNews">
                            <div class="NRtits"><b>热门资讯</b></div>
                            <ul>
                                @foreach($hot_news as $hot)
                                    <li><i></i><a href="{{ route('news.show',$hot->id) }}" target="_blank" title="{{ $hot->name }}">{{ $hot->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--  热门新闻  -->

                        <div class="new_ad">
                            <div class="NRtits"><b>最新活动</b></div>
                            <ul>
                                <li><a href=""><img src="{{ asset('pic/news/ad1.jpg') }}"/></a></li>
                                <li><a href=""><img src="{{ asset('pic/news/ad2.jpg') }}"/></a></li>
                            </ul>
                        </div>
                        <!--   广告图册 -->

                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection