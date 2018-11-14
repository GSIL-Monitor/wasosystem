<div id="p_newsheader">
    <a class="goBack"><img onClick="javascript:window.history.back(-1);" src="{{ asset('pic/P_backB.png') }}"></a>
    <h5>新闻资讯</h5>
    <a class="goIndex radius" href="/">网烁首页</a>
</div>
<!--  手机端  通用页头  -->

<div id="news_header">
    <div class="wrap">
        <div class="logo news_logo">
            <a href="/">
                <img src="{{ asset('pic/logo.png') }}"/>
            </a>
        </div>


        <div class="news_user">
            <div class="user">
                <div class="user_login">
                    @guest('user')
                        <a href="{{ route('login') }}"> <img src="{{ asset('pic/login_btn.png') }}"> </a>
                        @else
                            <a href="{{ route('member_center') }}"><img src="{{ asset('pic/logined_btn.png') }}"> </a>
                            @endguest
                </div>

                <div class="user_box">
                    <i></i>
                    @guest('user')
                        <a href="" class="registerNow">立即注册</a>
                        <a href="{{ route('login') }}">立即登录</a>
                        @else
                            <a href="{{ route('member_center') }}">个人中心</a>
                            <a href="">我的消息
                                <em class="round">11</em>
                            </a>
                            <a href="{{ route('orders.index') }}">我的订单</a>
                            <a href="{{ url('/logout') }}">退出</a>
                            @endguest
                </div>
            </div>

            <div class="search_box">
                <div class="round searchBorder">
                    <input type="text"/>
                    <i>设计师电脑</i>
                    <span href=""><img src="{{ asset('pic/P_search_black.png') }}"></span>
                </div>
                <div class="clear"></div>
            </div>

            <ul class="newsType">
                @foreach(array_reverse(config('site.news_type_cn')) as $key=>$value)
                    <li><a href="{{ url('/news_'.$key.'.html') }}"
                           class="@if($type == $key) li2 @endif"><i></i>{{ $value }}</a></li>
                @endforeach
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>


</div>