<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>我的订单</h5>
                        <p>您可以在这里检索到您要查询的订单。</p>
                    </div>
                    <div class="order_search">

                            <div class="sitUl">
                                <ul>
                                    <li>
                                        @foreach(config('site.member_center_order_links') as $key=>$item)
                                        <span><a href="{{ route('orders.index') }}?order_status={{ $key }}"  class="@if($status == $key ) active @endif">{{ $item }}</a></span>
                                        @if(!$loop->last)
                                                <i class="line">|</i>
                                        @endif
                                        @endforeach
                                        <div class="clear"></div>
                                    </li>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                        {!! Form::open(['route'=>'orders.index','id'=>'orders','method'=>'GET']) !!}
                            <div class="search_box">
                                <input type="text"name="keyword" placeholder="输入订单号或者关键字" required>
                                <input type="hidden"name="order_status" value="{{ $status }}" >
                                <a class="search_btn">搜索</a>
                            </div>
                            <div class="clear"></div>
                        {!! Form::close() !!}

                        <div class="clear"></div>
                    </div>

                            @foreach($orders as $item)

                            <div class="orderAllTable">
                                <a href="@if($item->order_status == 'intention_to_order'){{ route('orders.show',$item->id) }} @else {{ route('orders.edit',$item->id) }} @endif">
                                <div class="Ordertit">
                                    <div class="orderSitInfos">
                                        <span>订单编号：{{ $item->serial_number }}</span>
                                        <span class="orderSit"><i name="" class="">{{ $parameters['order_status'][$item->order_status] }}</i></span>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="OrderDetail">
                                    <!--   单个产品   开始 -->
                                    @if($item->order_type !='parts')
                                                <div class="pic">
                                                    <dl>
                                                        <dd>
                                                            <div class="orderPic"><img src="{{ order_complete_machine_pic($item->order_product_goods) ?? '' }}"></div>
                                                            <div class="proInfoTab">
                                                                <h5 class="canshu">{{ $item->machine_model }}</h5>
                                                                <h6 class="num">× {{ $item->num }}</h6>
                                                                <h6 class="prise">{{ $item->total_prices }}.00元</h6>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </dd>
                                                        <div class="clear"></div>
                                                    </dl>
                                                </div>
                                        @else
                                        <div class="pic">
                                            <dl>
                                                    @foreach($item->order_product_goods  as $key=>$item2)

                                                    <dd>
                                                        <div class="orderPic"><img src="{{ asset('pic/product/'.$item2->product->bianhao.'.png') }}"></div>  <!--  订单图片  -->
                                                        <div class="proInfoTab">
                                                            <h5 class="name">{{ $item2->name }}</h5>                                                         <!--  产品名称  -->
                                                            <!--  产品单价  -->
                                                            <h6 class=num>× {{ $item2->pivot->product_good_num }}</h6>
                                                        </div>
                                                        <div class="clear"></div>                                                                 <!--  产品数量  -->
                                                    </dd>
                                                    @if ($key == 1)
                                                        @break
                                                    @endif
                                                    @endforeach
                                                <!--   <dd>一个物料   -->
                                                <div class="clear"></div>
                                            </dl>
                                        </div>
                                    @endif
                                    </if>
                                </div>
                                <div class="orderInfo">
                                    <ul>
                                        <li><div class="orderInfoTit">订单模式：</div><div class="orderInfoContent"><i name="" class="orderType">{{ $parameters['order_type'][$item->order_type] }}</i></div><div class="clear"></div></li>
                                        <li class="lines">|</li>
                                        <li><div class="orderInfoTit">购买日期：</div><div class="orderInfoContent">{{ $item->created_at }}&nbsp;@if($status == 'old_orders' ) <simple style="color:red">(旧)</simple> @endif</div><div class="clear"></div></li>
                                        <div class="clear"></div>
                                    </ul>
                                </div>
                                <div class="Price">
                                    <span class="MoneyTotal">合计：<i>{{ $item->total_prices }}.00</i> 元</span>
                                </div>
                                </a>

                                <div class="control">
                                <!--判断是否是老订单-->
                                        @if($item->order_status !='intention_to_order')
                                           <a data_url="{{ route('orders.copy',$item->id) }}" class="Copy">再次购买</a>
                                        @else
                                            <a class="Del" data_url="{{ url('orders/destory') }}" data_id="{{ $item->id }}"  data_title="{{ $item->serial_number }}">删除订单</a>
                                        @endif
                                        <a href="@if($status == 'intention_to_order' ) {{ route('orders.show',$item->id) }} @else {{ route('orders.edit',$item->id) }} @endif" >订单详情</a>
                                    @if($item->order_type!='parts')
                                        <div class="seeMoreBox">
                                            <span class="seeMore">更多</span>
                                            <i></i>
                                            <a data_title="常用配置名" data_parent_id="0" data_product_id="0" data_url="{{ route('orders.add_common_equipment',$item->id) }}" class="OneAdd">设为常用配置</a>
                                        </div>
                                    @endif
                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>
                            </div>
                            @endforeach
                            <!--   单个产品   结束  -->


                    <!--  单个订单表 结束  -->

                    <div id="page">{{ $orders->links() }}</div>
                </div>

            </div>
