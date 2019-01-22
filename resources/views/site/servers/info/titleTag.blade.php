<div class="buy_right">
    <div class="right_wrap">
        <div class="pro_tit">
            <h5>
                网烁{{ str_before($completeMachine->name,'-') }}
                    <div class="radius findOnline">
                        <a name="F_news"
                           class="talkBtn"
                           data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125"
                        >立即询价</a></div>
            </h5>
            <p>{{ $completeMachine->additional_arguments['product_description'] }}</p>

           @auth('user')
                <div class="price">
                    <h5><i class="new_price">{{ $completeMachine->UnitPrice() }}.00元</i>
                    </h5>
                    <span class="lineSpan">原价：{{ priceSum($completeMachine->complete_machine_product_goods)['retail_price'] }}.00元</span>
                </div>
           @endauth

            <div class="icondetail">
                <b>基础配置：</b>
                <ul class="editDetail  @guest('user') noLogin @endguest">
                    @forelse($completeMachine->complete_machine_product_goods as $product_good)
                     @if(str_contains($product_good->product_id,[12,14,15,16,17,18,19]))
                        <li>
                            <div class="IDL"><img class="lazy" data-original="{{ asset('pic/complete_machine/'.$product_good->pivot->product_number.'.png') }}">
                            </div>
                            <div class="IDR"><h5>{{ $product_good->product->title }}</h5><h6>{{ $product_good->pivot->product_good_num.'*'.$product_good->jiancheng }}</h6></div>
                            <div class="clear"></div>
                        </li>
                        @endif
                        @empty
                    @endforelse
                    <div class="clear"></div>
                </ul>
                <div class="clear"></div>
            </div>


            <div class="tag">
                <div class="r_cont">
                    <ul>
                        <h5>应用类型：</h5>
                        @forelse($completeMachine->application as $item)
                            @if($item != '0')
                            <li><a class="radius" href="{{ route('search') }}?key={{ $item }}">{{ $item }}</a></li>
                            @endif
                            @empty
                          @endforelse
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>


        <div class="buy_info">
            <div class="buy_now">
                <dl class="tips">
                    <dt>温馨提示：</dt>
                    <dd><em><img src="{{ asset('pic/tipIcon.png') }}"></em>该为基础版，您可以通过下方【基础配置修改】来更改。
                    </dd>
                    <dd><em><img src="{{ asset('pic/softCopyrightIcon.png') }}"></em><span
                                class="copyBtn">【网烁整机配置管理系统】</span>受“计算机软件著作权”保护。
                    </dd>
                </dl>
                <div class="buy_btns">
                    {{--<button class="buy_now P_hide shop_car_btn buy">意向保存</button>--}}
                    <button class="buy_now P_hide editDetail @guest('user') noLogin @endguest">意向保存</button>
                    <div class="clear"></div>
                    <a target="_blank" name="F_news"
                       data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125"
                       class="ques talkBtn"><i></i>我有疑问，询问客服。</a>
                </div>
            </div>


        </div>
    </div>

</div>