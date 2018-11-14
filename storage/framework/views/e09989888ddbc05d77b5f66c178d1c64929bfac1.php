
 <div class="right">
                        <div class="info">
                            <div class="tit bigTit">
                                <h5>配件选购</h5>
                                <p>根据自己的需求，选取配件。</p>
                            </div>

                           <?php echo Form::open(['method'=>'put','id'=>'AllDel','class'=>'product_form','onsubmit'=>'return false']); ?>

                            <div class="orderTable">
                                <div class="AddPeijian" id="app">
                                    <div class="BuyType">
                                        <button class="radius invoice_type checked" data-id="vat_special_invoice"><i></i> 单位采购
                                        </button>
                                        <button class="radius invoice_type" data-id="no_invoice"><i></i>个人采购</button>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="AddType"><?php echo Form::select(null,$products,null,['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']); ?></div>
                                    <div class="AddName">
                                        <select2 :good-list="goodList" ref="child"></select2>
                                    </div>
                                    <div class="AddNums"><input type="number" value="" v-model="good_num"></div>
                                    <div class="AddBtn">
                                        <button @click="add_good()">添加</button>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="clear"></div>
                                </div>
                                <div class="menu">
                                    <div class="check_box TH"></div>
                                    <div class="links_a TH">商品信息</div>
                                    <div class="price TH">单价</div>
                                    <div class="num TH">数量</div>
                                    <div class="zhibao TH">质保</div>
                                    <div class="total TH">总计</div>
                                    <div class="control TH">类别</div>
                                    <div class="clear"></div>
                                </div>
                                <div class="peijian">
                                        <?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->product->title == '机箱' && $item->details['kun_bang_dian_yuan']): ?>
                                                <?php $power=$item->find($item->details['kun_bang_dian_yuan']);?>
                                            <?php endif; ?>
                                            <div class="orderList listTable">
                                                <div class="check_box TD"><input class="selectIds" type="checkbox"
                                                                                 autocomplete="off" name="ids[]"
                                                                                 value="<?php echo e($item->id); ?>"/></div>
                                                <div class="links_a TD"><?php echo e($item->name); ?></div>
                                                <div class="price TD"><span class="pri"
                                                                            data-id="<?php echo e($item->pivot->product_good_price); ?>"><?php echo e($item->pivot->product_good_price); ?></span>.00元
                                                </div>
                                                <div class="num TD">
                                                    <div class="num_box">
                                                        <button class="delNum">-</button>
                                                        <input type="text" name="good_list[<?php echo e($item->id); ?>]" class="PJnum good_num OneNumber"
                                                               value="<?php echo e($item->pivot->product_good_num); ?>"
                                                               product-name="<?php echo e($item->product->title); ?>"
                                                               product-bianhao="<?php echo e($item->product->bianhao); ?>"
                                                               good-id="<?php echo e($item->id); ?>"
                                                               good-framework="<?php echo e($item->framework->name); ?>"
                                                               good-jianma="<?php echo e($item->jianma); ?>">
                                                        <button class="addNum">+</button>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="zhibao TD">
                                                    <span>质保</span> <?php echo e($item->quality_time); ?> 年
                                                </div>
                                                <div class="total TD"><span class="to"></span>.00元</div>
                                                <div class="control TD"><?php echo e($item->product->title); ?></div>
                                            </div>
                                            <?php if(isset($power)): ?>
                                                <div class="num TD">
                                                    <div class="num_box">
                                                        <button class="delNum">-</button>
                                                        <input type="hidden" class="PJnum good_num"
                                                               product-name="<?php echo e($power->product->title); ?>"
                                                               product-bianhao="<?php echo e($power->product->bianhao); ?>"
                                                               good-id="<?php echo e($power->id); ?>"
                                                               good-framework="<?php echo e($power->framework->name); ?>"
                                                               good-jianma="<?php echo e($power->jianma); ?>">
                                                        <button class="addNum">+</button>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>
                                        <!--配件类 结束-->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="total_control confirm_btn">
                                    <div class="t_l">
                                        <ul>
                                            <li><input type="checkbox" class="selectAll" autocomplete="off"/>全选</li>
                                            <li><a class="AllDels AllDel" form="AllDel"
                                                   data_url="<?php echo e(url('/parts_buy/destory')); ?>">删除</a></li>
                                            <div class="clear"></div>
                                        </ul>
                                    </div>
                                    <div class="t_r">
                                        <ul>
                                            <!--<li>已选择 <b class="AllNum">0</b> <b> 件</b></li>-->
                                            <li>合计 <b class="AllPri">0</b><span>.00元</span></li>
                                            <div class="clear"></div>
                                        </ul>
                                        <div class="confirm_btns">
                                            <input type="hidden" name="order_type" class="order_type" value="parts"/>
                                            <input type="hidden" class="shuidian" value="<?php echo e(user()->tax_rates->identifying); ?>"/>
                                            <input type="hidden" class="code" name="code" value="1"/>
                                            <input type="hidden" class="invoice_type" name="invoice_type" value="vat_special_invoice"/>
                                            <input type="hidden" name="code" autocomplete="off" class="codes" value=""/>
                                            <input type="hidden" name="machine_model" autocomplete="off" class="name" value=""/>
                                            <input type="hidden" name="total_prices" autocomplete="off" class="total_prices" value="0"/>
                                            <input type="hidden" name="price_spread" autocomplete="off" class="price_spread" value="0"/>
                                            <a class="create_orders" data_url="<?php echo e(route('parts_buy.update',user()->id)); ?>">意向保存</a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
