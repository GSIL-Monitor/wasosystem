@extends('site.news.layouts.default')
@section('title',$informationManagement->name)
@section('css')
    <link href="{{ asset('css/newsPublic.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/news_info.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{ asset('js/news.js') }}"></script>
    <script>
        $(document).ready(function(){
            //  /*  右部资讯固定  */
            var viewH = $(window).height() - 140;
            var divHTop = $(".newsInfoBox").offset().top+20;
            var divH = $(".newsInfoBox").height();
            if(divH < viewH){
                $(".newsInfoBox").css("min-height", viewH + "px");
            }
            $(window).scroll(function(){
                if($(window).scrollTop() >= divHTop){
                    $(".newsInfoBox .news_right").removeClass("news_right_abs").addClass("news_right_fix");
                } else{
                    $(".newsInfoBox .news_right").removeClass("news_right_fix").addClass("news_right_abs");
                }
            });
            $(".other_news li:nth-child(3n)").addClass("last");

        });
    </script>

@endsection
@section('content')

    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="/">网烁官网</a> <i>></i>
                <a href="{{ url('/news_'.$type.'.html') }}"> {{ config('site.news_type_cn')[$type] }}</a>
                <i>></i>
                {{ $informationManagement->name }}
            </div>

            <div class="newsBox newsInfoBox">
                <div class="news_left">
                    <div class="news_box">
                        <h5 class="title">   {{ $informationManagement->name }}</h5>

                        <div class="wordsTips">
                            @foreach(array_except($informationManagement->marketing,'show') as $key=>$item)
                                @if($item)
                                    <i class="{{ $key }}">{{ config('status.information_management_marketing')[$key] }}</i>
                                @endif
                            @endforeach
                        </div>

                        <div class='infos'>
                        <span>
                            <i class="newsIcon newsTime"></i>{{ $informationManagement->created_at }}
                            <div class="phoneCode">
                                <div class="phoneBtn"><i class="newsIcon newsPhone"></i>手机看帖</div>
                                <div class="codeBox"><div class="iconInner" id="qrcode"></div></div>
                            </div>
                        </span>
                            <span class="readNum">
                            <i class="newsIcon newsRead"></i>{{ visits($informationManagement)->count() }} 阅读
                            {{--<i class="newsIcon newsPerson"></i>--}}
                        </span>
                            <div class="clear"></div>
                        </div>
                        <div class="content">
                            {!! str_replace('src=','class="lazy" data-original=',$informationManagement->content) !!}
                        </div>

                        <div class="weixin">
                            <img src="{{ json_decode(getImages(setting('contact_wechat')),true)[0]['url'] ?? '' }}">
                            <h5>扫一扫，关注网烁公众号！</h5>
                            <h5>微信搜索“<b>网烁</b>”或“<b>waso-vip</b>”</h5>
                            <div class="weiTeach"><img src="{{ asset('pic/news/weiTeach.jpg') }}"></div>
                        </div>

                        <div class="goBack">
                            <a class="leftBtn" href="/" title="了解更多关于服务器定制 图形工作站 it服务外包"><i></i>网烁首页</a>
                            <a class="rightBtn" href="{{ url('/news_'.$type.'.html') }}" title="了解更多关于服务器定制 图形工作站 it服务外包">新闻列表<i></i></a>
                            <div class="clear"></div>
                        </div>

                        <div class="other_news">
                            <h5>相关推荐</h5>
                            <ul>
                               @foreach($recommend_news as $recommend)
                                    <li><a href="{{ route('news.show',$recommend->id) }}"><div class="otherPic"><img class="lazy" data-original="{{ pic($recommend->pic)[0]['url'] ?? '' }}"></div><h5>{{ $recommend->name }}</h5></a></li>
                               @endforeach
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="news_right news_right_abs">
                    <div class="right_wrap">
                        <div class="hotNews">
                            <div class="NRtits"><b>热点资讯</b></div>
                            <ul>
                                @foreach($hot_news as $hot)
                                    <li><i></i><a href="{{ route('news.show',$hot->id) }}" target="_blank" title="{{ $hot->name }}">{{ $hot->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>



@endsection