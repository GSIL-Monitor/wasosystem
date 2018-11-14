
<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>资金管理</h5>
                        <p>您可以在这里查看金额使用情况。</p>
                    </div>

                    <div class="TotalPrice">
                        <div class="PriceTable">
                            @if(count($orders) > 0)
                                未付货款<i>：</i><span class="HaveDept"><b id="price">{{ $orders->sum('total_prices') }}</b>.00元</span>
                                @else
                                <span class="NotDept">太棒了，没有欠款！</span>
                            @endif
                        </div>
                    </div>

                    <div class="moneyBox">
                        <ul class="PageSelect">
                            <li class="@if(!Request::has('p')) active @endif"><span>未付款订单</span></li>
                            <li class="last @if(Request::has('p')) active @endif"><span>资金记录</span></li>
                            <div class="clear"></div>
                        </ul>

                        <div class="MoneyBox">
                            <div class="PageBox QK" id="QK">
                                <div class="Table">
                                    <div class="Th">
                                        <span class="MoneyNum">订单编号</span>
                                        <span class="MoneySitu">订单状态</span>
                                        <span class="MoneyTotal">订单价格</span>
                                        <span class="MoneyMSitu">款项状态</span>
                                        <span class="MoneyTime">提交时间</span>
                                        <div class="clear"></div>
                                    </div>

                                 @forelse($orders as $order)
                                        <div class="Td">
                                            <span class="MoneyNum"><a href="{{ route('orders.edit',$order->id) }}">{{ $order->serial_number }}</a></span>
                                            <span class="MoneySitu">{{ $parameters['order_status'][$order->order_status] }}</span>
                                            <span class="MoneyTotal">+ {{ $order->total_prices }}.00元</span>
                                            <span class="MoneyMSitu">{{ $parameters['payment_status'][$order->payment_status] }}</span>
                                            <span class="MoneyTime">{{  $order->created_at->format('Y-m-d') }}</span>
                                            <div class="clear"></div>
                                        </div>
                                        @empty
                                            <div class="Td">
                                                <span class="MoneyInfo">没有欠款订单</span>
                                                <div class="clear"></div>
                                            </div>
                                        @endforelse
                                </div>
                            </div>
                            <!--  欠款订单 结束  -->
                            <div id="log" class="PageBox JL">
                                <!--  欠款订单 结束  -->
                                <div class="Table">
                                    <div class="Th">
                                        <span class="MoneyType">交易类型</span>
                                        <span class="MoneyNum">交易金额</span>
                                        <span class="MoneyTime">交易时间</span>
                                        <span class="MoneyInfo">信息备注</span>
                                        <div class="clear"></div>
                                    </div>
                                   @forelse($financial_details as $financial_detail)
                                        <div class="Td">
                                            <span class="MoneyType">
                                                @if($financial_detail->type == 'deposit')
                                                    存入
                                                @elseif($financial_detail->type == 'pay')
                                                    支付
                                                @else
                                                    定金
                                                @endif</span>
                                            <span class="MoneyNum">{{ $financial_detail->price }}.00元</span>
                                            <span class="MoneyTime">{{ $financial_detail->created_at }}</span>
                                            <span class="MoneyInfo">{{ $financial_detail->comment }}</span>
                                            <div class="clear"></div>
                                        </div>
                                       @empty
                                        <div class="Td">
                                            <span class="MoneyInfo">没有资金记录</span>
                                            <div class="clear"></div>
                                        </div>
                                   @endforelse
                                </div>
                                {!! $financial_details->appends(array_prepend(Request::except('page'),'QK','p'))->render() !!}
                            </div>


                            <!--  资金记录 结束  -->
                        </div>
                    </div>
                </div>

            </div>
