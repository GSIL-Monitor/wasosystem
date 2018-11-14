<div class="order_xiadan">
    <form onsubmit="return false">
        <div class="body orderBody">
            <div class="wrap">
                <div class="changBody">
                    <div class="pro_list">
                        <h5 class="orderTit">{{ $common_equipment->serial_number }}</h5>

                        <div class="orderTable">
                            <div class="ComfirInfo">
                                <div class="menu">
                                    <div class="imgs" style="text-align:left;">商品</div>
                                    <div class="links_a"></div>
                                    <div class="price">单价</div>
                                    <div class="num">数量</div>
                                    <div class="total">小计</div>
                                    <div class="control">操作</div>
                                    <div class="clear"></div>
                                </div>

                                <div class="orderList MainOrder">
                                    <div class="imgs openDetail"><img src="{{ order_complete_machine_pic($common_equipment->common_equipment_product_goods) }}"></div>
                                    <div class="links_a openDetail" style="text-align:left;">{{ $common_equipment->machine_model }}</div>
                                    <div class="price"><span class="pri" data-id="{{ $common_equipment->unit_price }}">{{ $common_equipment->unit_price }}</span>.00元
                                    </div>
                                    <div class="num">x {{ $common_equipment->num }} </div>
                                    <div class="total pri"><span class="to">{{ $common_equipment->total_prices }}</span>.00元</div>
                                    <div class="control"><span><a class="editDetail" href="javascript:;">修改配置<i></i></a></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="detailTable">
                                    <ul>
                                        @foreach($order_details['complete_machine_detailed'] as $key=>$detail)
                                            <li><span class="DTit">{{ $key }}</span><span>{{ $detail }}</span>
                                                <div class="clear"></div>
                                            </li>
                                        @endforeach
                                        <li><span class="DTit">温馨提示</span><span><span style="color: red">*以上内容仅供参考，不构成任何约束和承诺，详情及价格请联系客服！</span></span><div class="clear"></div></li>
                                    </ul>

                                    <div class="download">
                                        <a href="{{ route('orders.show',$common_equipment->order_id) }}?export=UnitQuotation&export_name=整机报价表">【下载 服务器明细及报价表】</a>
                                        @if(user()->parts_buy)
                                            <a href="{{ route('orders.show',$common_equipment->order_id) }}?export=AccessoriesOffer&export_name=配件报价表">【下载 服务器配件报价表】</a>
                                        @endif
                                        <p>* 报价表请在电脑端下载</p>
                                    </div>
                                </div>
                                <span class="proDetail">展开配置<i></i></span>
                            </div>
                        </div>

                        <!--购物车订单 结束-->
                    </div>

                    <div class="confirmInfo">
                        <div class="erweiBox">
                            <h5>配置代码</h5>
                            <input type="text" value="{{ $common_equipment->code }}" class="codes" disabled>
                            <button class="copyInfoBtn" data-clipboard-text="{{ $common_equipment->code }}">复制代码</button>
                            <a href="javascript:;" class="PC_hide">查看配置二维码</a>
                            <div id="peizhi"></div>
                            
                        </div>
                        <div class="tableTotal total">
                            <div class="editOpen"></div>
                            <div class="orderPrice ">
                                <ul>
                                    <li class="fixHide"><span class="bottomTit">商品金额<i><notempty name="order.fptype">（含17%增值税）</notempty></i>：</span><span
                                                class="bottomContent"><b><i class="">{{ $common_equipment->total_prices }}</i>.00元</b></span>
                                        <div class="clear"></div>
                                    </li>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>


                    <div class="confirm_btns">
                        <div class="confirm_btn">
                            <a class="goBack" href="{{ route('common_equipments.index') }}">返回</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
        </div>
</form>
</div>