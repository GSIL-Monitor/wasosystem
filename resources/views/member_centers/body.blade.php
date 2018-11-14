<div class="body" id="body_bg">
    <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 个人中心</div></div>
    <div class="wrap">
        <div class="info_box">
            <div class="left">
                @include('member_centers.person_links')
            </div>
            <div class="right">
                <div class="info">
                    <div class="person_info">
                        <div class="my_info">
                            <div class="name">
                                <div class="P_headPic"><img src="{{ asset('pic/P_headPic.png') }}"></div>
                                <div class="nameBox">
                                    <a href="">{{ user()->username }} {{ user()->nickname }}</a>
                                    <h6>您好，欢迎来到个人中心！</h6>
                                    <h6>您一共登陆了 {{ user()->login_count }}  次</h6>
                                    <h6>@if(user()->last_login_time == '0')您是第一次登录 @else 最近一次登录时间：{{ user()->last_login_time }} @endif</h6>
                                </div>
                                <div class="clear"></div>
                                <img class="headPicBg" src="{{ asset('pic/person/headPicBg.png') }}">
                            </div>

                            <div class="tonggao">
                                <a class="infoMoreBtn" href="{{ route('notifications.index') }}">
                                    <img src="{{ asset('pic/person/personMsgIcon.png') }}">
                                    <span>{{ user()->notification_count }}</span>
                                    <h5 class="infoTit">我的消息（条）</h5>
                                </a>
                            </div>

                            <div class="MyMoney">
                                <a class="infoMoreBtn" href="">
                                    <img src="{{ asset('pic/person/personPriceIcon.png') }}">
                                    <div class="MoneyBox">
                                        @if($debt_price)
                                            <span class="HaveDebt"><b>{{ $debt_price }}</b>.00</span>
                                        @else
                                            <span class="NotDebt">没有欠款</span>
                                        @endif
                                        <h5 class="infoTit">未付货款（元）</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="clear"></div>

                        </div>
                        <!--   个人  -->
                        <div class="clear"></div>
                    </div>

                    <div class="personInfo">
                        <div class="orderTit">我的订单</div>
                        <ul>

                            <li><a href="{{ route('orders.index') }}?order_status=intention_to_order"><img src="{{ asset('pic/person/yixiang.png') }}"><i>{{ $intention_to_order_count }}</i><h5>意向订单</h5></a></li>
                            <li><a href="{{ route('orders.index') }}?order_status=placing_orders"><img src="{{ asset('pic/person/xiadan.png') }}"><i>{{ $placing_orders_count }}</i><h5>下单订货</h5></a></li>
                            <li><a href="{{ route('orders.index') }}?order_status=order_acceptance"><img src="{{ asset('pic/person/shouli.png') }}"><i>{{ $order_acceptance_count }}</i><h5>受理订单</h5></a></li>
                            <li><a href="{{ route('orders.index') }}?order_status=in_transportation"><img src="{{ asset('pic/person/zaitu.png') }}"><i>{{ $in_transportation_count }}</i><h5>在途运输</h5></a></li>
                            <li><a href="{{ route('orders.index') }}?order_status=arrival_of_goods"><img src="{{ asset('pic/person/chengjiao.png') }}"><i>{{ $arrival_of_goods_count }}</i><h5>成交订单</h5></a></li>
                            <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                    </div>



                    <div class="companyInfo">
                        <div class="addrTit">地址管理</div>
                        <ul>
                            <li><a href="{{ route('user_companies.index') }}">企业信息管理<img src="{{ asset('pic/more_black.png') }}"></a></li>
                            <li><a href="{{ route('user_addresses.index') }}">收货地址管理<img src="{{ asset('pic/more_black.png') }}"></a></li>
                            <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <!--   手机端 显示   -->
                    <div class="P_more">
                        <ul>
                            @foreach(config('site.member_center_links') as $title=>$item)
                                    @foreach($item as $url=>$value)
                                        @if(isset($value['image']) && !empty($value['image']) )
                                        @if(user()->parts_buy && $url== 'parts_buy.index')
                                            <li><a href="{{ route($url) }}" class="@if(Route::is($url)) active @endif" ><h5><img src="{{ asset('pic/'.$value['image']) }}"></h5><img class="arrow" src="{{ config('site.member_center_links_pic') }}"></a></li>

                                        @else
                                        <li><a href="@if(Route::has($url)) {{ route($url) }}  @endif" class="@if(Route::is($url)) active @endif" ><h5><img src="{{ asset('pic/'.$value['image']) }}">{{ $value['name'] }}</h5><img class="arrow" src="{{ config('site.member_center_links_pic') }}"></a></li>
                                        @endif
                                    @endif
                                    @endforeach
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                        <a class="Out" href="{{ url('/logout') }}"><h5>退出登录</h5></a>
                    </div>
                    <!--   手机端 显示    结束  -->
                </div>

            </div>

            <div class="clear"></div>
        </div>

    </div>
</div>