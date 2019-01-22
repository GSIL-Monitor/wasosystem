<div class="headBg"></div>
<div class="body ITEasy">
    <div class="big_bg big_bgActive">
        <div class="blackBG"></div>
        <div class="wrap">
            <div class="bgTXT">
                <img src="{{ asset('pic/IT/it_txt.png') }}">
                <p>可为非我司销售的产品或已无质保产品提供升级维护、服务支持！</p>
            </div>
            <div class="mobileBlack"></div>
        </div>
    </div>


    <div class="designAD">
        <div class="SJStxt1 txtCon picBg"></div>
    </div>


    <!-- 选择  -->
    <div class="disignDiy">
        <div class="serverBox txtCon">
            <div class="wrap">
                <h5 class="serverName">IT技术服务</h5>
                @foreach($it_outsourcings->groupBy('name') as $key=>$item)
                    <h5 class="tit">{{ $key }}</h5>
                    <div class='UlBox'>
                        <ul>
                            @foreach($item as $item2)
                                <li>
                                    <div class="liBox">
                                        <div class="liPic"><img src="{{ pic($item2->pic)[0]['url'] ?? ''  }}"></div>
                                        <div class="induce">
                                            <div class="inducePage">
                                                <h5>{{ $item2->details['cooperation_types'] }}</h5>
                                                <p class="detail">{{ $item2->details['description'] }}</p>
                                                @guest('user')
                                                          @php $unit_price=$item2->price['retail_price'];   @endphp
                                                    @else
                                                        @php $unit_price=$item2->price[user()->grades->identifying];   @endphp
                                                        @endguest
                                                        @php
                                                                 $product_base=!empty($item2->details['product_base']) ? $item2->details['product_base'] : 1;
                                                        @endphp
                                                        <div class="priceBox">
                                                            <p>基数：<b>{{ $product_base }}台起</b></p>
                                                            @guest('user')
                                                                <p>更多请联系在线客服</p>
                                                                <p>&nbsp;</p>
                                                                @else

                                                                    <p>
                                                                        单价：<b>{{ $unit_price }}{{ $item2->details['tally'] }}</b>
                                                                    </p>
                                                                    <p>
                                                                        总价：<b>{{ $unit_price * $product_base  }}{{ $item2->details['tally'] }}</b>
                                                                    </p>
                                                                    @endguest
                                                        </div>
                                                        <button @guest('user')
                                                                onclick="location.href='{{ route('login') }}'"
                                                                @else
                                                                class="it_save"
                                                                data_title="{{ $item2->details['cooperation_types'] }}"
                                                                data_num="{{ $item2->details['product_base'] }}"
                                                                data_price="{{ $unit_price  }}"
                                                                data_total_price="{{ $unit_price * $product_base  }}"
                                                                data_url="{{ route('it_outsourcing.save',$item2->id) }}"
                                                                @endguest
                                                        >意向保存
                                                        </button>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>


        @foreach($its as $it)
            @if($loop->iteration !=1)
                <div class="serverBox serverBox2 txtCon"
                     data_phone="{{ asset('pic/IT/IT_page'.$loop->iteration.'_p.jpg') }}"
                     style="background-image:url({{ asset('pic/IT/IT_page'.$loop->iteration.'.jpg') }});">
                    <div class="wrap">
                        <div class="serverName">
                            @php $details=explode('|',$it->description)@endphp
                            {{ $it->name }}
                            <h5>{{ $details[3] }}{{ $details[4] }}</h5>
                        </div>
                        <div class="sPage">
                            <div class="pageTxt">
                                <p>{{ $details[0] }}</p>
                                <div class="contact">{{ $details[1] }}{{ $details[2] }}</div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>