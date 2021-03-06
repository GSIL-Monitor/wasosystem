<div class="JJList">
    <ul class="maxUl" >
        <?php if(Route::is('admin.orders.create')): ?>
            <?php echo Form::open(['route'=>'admin.orders.store','method'=>'post','id'=>'orders','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($order,['route'=>['admin.orders.update',$order->id],'id'=>'orders','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">订单序列号：</div>
                <div class="liRight">
                    <?php echo Form::hidden('null',$parameters['order_type_code'][$order->order_type],["class"=>'code']); ?>

                    <?php echo Form::text('serial_number',old('serial_number'),['placeholder'=>'订单序列号',"class"=>'checkNull','readonly']); ?>

                    <?php echo Form::hidden('null',$order->user->tax_rates->identifying,["class"=>'tax_point']); ?>

                    <?php echo Form::hidden('price_spread',old('price_spread'),["class"=>'price_spread']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">下单时间：</div>
                <div class="liRight">
                    <?php echo Form::text(null,$order->created_at,['readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户账户：</div>
                <div class="liRight">
                    <input type="text" value="<?php echo e($order->user->username); ?>" readonly="">
                </div>
                <div class="clear"></div>
            </li>
            <?php if($order->order_type !='parts'): ?>
            <li>
                <div class="liLeft">整机型号：</div>
                <div class="liRight">
                    <?php echo Form::text('machine_model',old('machine_model'),['placeholder'=>'整机型号',"class"=>'checkNull name','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <?php endif; ?>
            <li>
                <div class="liLeft">配置代码：</div>
                <div class="liRight">
                    <?php echo Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']); ?>

                    <div class="codeBox">
                        <div id="qrcode"></div>
                            <?php if($order->order_status =='intention_to_order' || auth('admin')->user()->can('super edit')): ?>
                            <button class="Btn alertWeb" data_url="<?php echo e(route('admin.orders.show',$order->id)); ?>">修改配置</button>
                            <?php endif; ?>
                        <button class="Btn OpenCode">显示二维码</button>
                        <button class="Btn CloseCode" style="display: none;">隐藏二维码</button>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">订单列表：</div>
                <div class="liRight" >
                    <table class="listTable">
                        <tr>
                            <th class="">类型</th>
                            <th class="tableInfoDel">名称</th>
                            <th class="">数量</th>
                            <th class="">成本</th>
                            <th class="">金额</th>
                            <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                            <th class="">条码</th>
                            <?php endif; ?>
                        </tr>
                        <?php $order_product_goods=$order->order_product_goods()->orderBy('product_number','asc')->get();
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan']): ?>
                                <?php $power=$product_good->whereProductId(21)->where('oldid',$product_good->details['kun_bang_dian_yuan'])->first();?>
                            <?php endif; ?>
                            <tr>
                                <td class="">
                                    <?php echo e($product_good->product->title); ?>

                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    <?php echo e($product_good->name); ?>

                                </td>
                                <td class="num">
                                    <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="<?php echo e($product_good->pivot->product_good_num / $order->num); ?>"  product-name="<?php echo e($product_good->product->title); ?>"  product-bianhao="<?php echo e($product_good->product->bianhao); ?>" good-id="<?php echo e($product_good->id); ?>" good-framework="<?php echo e($product_good->framework->name); ?>" good-jianma="<?php echo e($product_good->jianma); ?>" >
                                 <?php echo e($product_good->pivot->product_good_raid == '请选择raid' ? '' : $product_good->pivot->product_good_raid); ?>

                                </td>
                                <td data-price="<?php echo e($product_good->pivot->product_good_price); ?>" class="product_good_price"><?php echo e($product_good->pivot->product_good_price); ?></td>
                                <td class="total_price">
                                    
                                    <?php echo e($product_good->pivot->product_good_price * $product_good->pivot->product_good_num); ?>

                                </td>
                                <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                                <td class="">
                                    <div class="openTM openBtn">查看条码</div>
                                    <div class="TMBox">
                                        <?php echo implode('<br/>',$order->warehouseOut->codes[$loop->index]->code ?? []); ?>

                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6"><div class="empty">没有数据</div></td>
                            </tr>
                        <?php endif; ?>
                        <?php if(isset($power)): ?>
                            <tr >
                                <td class="num">
                                    <input type="hidden"  class="PJnum good_num"  product-name="<?php echo e($power->product->title); ?>"  product-bianhao="<?php echo e($power->product->bianhao); ?>" good-id="<?php echo e($power->id); ?>" good-framework="<?php echo e($power->framework->name); ?>" good-jianma="<?php echo e($power->jianma); ?>">
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tfoot>
                        <tr>  <td colspan="6">

                                <?php if($order->order_type=='parts'): ?>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=AccessoriesOffer&export_name=配件报价表">【配件报价表】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=AssemblyManufacturing&export_name=组装生产单">【组装生产单】</a>
                                    <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=MaterialCode&export_name=物料条码表">【物料条码表】</a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=Delivery&export_name=出库表">【出库表】</a>
                                    <a class="contract_alert">【合同模版】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=measuring&export=Measuring&export_name=借测模版">【借测模版】</a>
                                    <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=signature_form&export=SignatureForm&type=parts">【签收单】</a>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <a class="system_solution_alert">【整机方案书】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=UnitQuotation&export_name=整机报价表">【整机报价表】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=AccessoriesOffer&export_name=配件报价表">【配件报价表】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=AssemblyManufacturing&export_name=组装生产单">【组装生产单】</a>
                                    <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=MaterialCode&export_name=物料条码表">【物料条码表】</a>
                                  <?php endif; ?>
                                    <?php $model=substr($order->machine_model,1,1);
                                         $identifying=$order->order_type != 'designer_computer' ? ['W'=>'bg3','G'=>'bg4','E'=>'bg5','DE'=>'bg2'] : ['W'=>'bg5','DE'=>'bg3'];
                                        $img=$identifying[$model] ?? $identifying['DE'];
                                    ?>
                                    <a  target="_blank" href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=Publicity&img=<?php echo e($img); ?>&export_name=宣传单页">【宣传单页】</a>
                                    <a class="contract_alert">【合同模版】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=measuring&export=Measuring&export_name=借测模版">【借测模版】</a>
                                    <a href="<?php echo e(route('admin.orders.export',$order->id)); ?>?export=Delivery&export_name=出库表">【出库表】</a>
                                    <?php if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods'])): ?>
                                    <a class="signature_form_alert">【签收单】</a>
                                        <?php endif; ?>
                                <?php endif; ?>
                            </td></tr>
                        </tfoot>
                    </table>
                </div>
                <div class="clear"></div>
            </li>
            <div id="app">
            <li>
                <div class="liLeft">订单金额：</div>
                <div class="liRight">
                    <?php echo Form::number('unit_price',old('unit_price'),['placeholder'=>'订单金额',"class"=>'checkNull unit_price','readonly',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单数量：</div>
                <div class="liRight">
                    <?php echo Form::text('num',old('num'),['placeholder'=>'订单金额',"class"=>'checkNull order_num OneNumber',':readonly'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">总金额：</div>
                <div class="liRight">
                    <?php echo Form::number('total_prices',old('total_prices'),['placeholder'=>'总金额',"class"=>'checkNull total_prices',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">开票类型：</div>
                <div class="liRight">
                    <?php echo Form::select('invoice_type',$parameters['invoice'],old('invoice_type'),["class"=>'checkNull invoice_type',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="invoice_infos">
                <div class="liLeft">开票信息：</div>
                <div class="liRight">
                    <?php echo Form::select('invoice_info',array_prepend($order->user->user_company()->pluck('name','id')->toArray(),'请选择开票信息',''),old('invoice_info'),["class"=>'checkNull invoice_info',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单状态：</div>
                <div class="liRight">

                    <?php switch($order->order_status):
                        case ('placing_orders'): ?>
                        <?php echo Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders','order_acceptance']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']); ?>

                        <?php break; ?>
                        <?php case ('order_acceptance'): ?>
                        <?php echo Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders','order_acceptance','in_transportation']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']); ?>

                        <?php break; ?>
                        <?php case ('in_transportation'): ?>
                        <?php echo Form::select('order_status',$parameters['order_status'],old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']); ?>

                        <?php break; ?>
                        <?php case ('arrival_of_goods'): ?>
                        <?php echo Form::select('order_status',$parameters['order_status'],old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']); ?>

                        <?php break; ?>
                        <?php default: ?>
                        <?php echo Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']); ?>

                    <?php endswitch; ?>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">款项状态：</div>
                <div class="liRight">
                    <?php if($order->payment_status == 'account_paid' ): ?>
                    <?php echo Form::select('payment_status',array_prepend($parameters['payment_status'],'请选择款项状态',''),old('payment_status'),['placeholder'=>'款项状态',"class"=>'checkNull',':disabled'=>'isDisabled']); ?>

                    <?php else: ?>
                        <?php echo Form::select('payment_status',array_except(array_prepend($parameters['payment_status'],'请选择款项状态',''),['account_paid']),old('payment_status'),['placeholder'=>'款项状态',"class"=>'checkNull',':disabled'=>'isDisabled']); ?>

                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务模式：</div>
                <div class="liRight">
                    <?php echo Form::select('service_status',$parameters['service'],old('service_status'),['placeholder'=>'服务模式',"class"=>'checkNull service_status',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>

            <li>
                <div class="liLeft">销售人员：</div>
                <div class="liRight">
                    <?php echo Form::text('market',old('market',$parameters['admins'][$order->market] ?? ''),['placeholder'=>'销售人员',"class"=>'checkNull','disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">受理配货：</div>
                <div class="liRight">
                    <?php echo Form::select('participation_admin[acceptance][]',$parameters['admins'],old('participation_admin[acceptance][]'),["class"=>'checkNull select2','multiple',':disabled'=>'acceptance']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">技术验证：</div>
                <div class="liRight">
                    <?php echo Form::select('participation_admin[skill][]',$parameters['admins'],old('participation_admin[skill][]'),["class"=>'checkNull select2','multiple',':disabled'=>'skill']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">打包物流：</div>
                <div class="liRight">
                    <?php echo Form::select('participation_admin[pack][]',$parameters['admins'],old('participation_admin[pack][]'),["class"=>'checkNull select2','multiple',':disabled'=>'pack']); ?>

                </div>
                <div class="clear"></div>
            </li>
                <li>
                    <div class="liLeft">物流地址：</div>
                    <div class="liRight">
                        <?php echo Form::select('logistics_id',array_prepend($order->user->user_address()->pluck('address','id')->toArray(),'无需物流',0),old('logistics_id'),['placeholder'=>'无需物流',"class"=>'checkNull select2',':disabled'=>'pack']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li>
                    <div class="liLeft">物流信息：</div>
                    <div class="liRight">
                        <?php echo Form::text('logistics_info',old('logistics_info'),['placeholder'=>'物流信息',"class"=>'checkNull',':disabled'=>'pack']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li>
                    <div class="liLeft">包裹件数：</div>
                    <div class="liRight">
                        <?php echo Form::number('parcel_count',old('parcel_count'),['placeholder'=>'包裹件数',"class"=>'checkNull OneNumber',':disabled'=>'pack']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
            <li>
                <div class="liLeft">客户要求：</div>
                <div class="liRight">
                    <?php echo Form::textarea('user_remark',old('user_remark'),['placeholder'=>'客户要求',"class"=>'',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">公司备注：</div>
                <div class="liRight">
                    <?php echo Form::textarea('company_remark',old('company_remark'),['placeholder'=>'公司备注',"class"=>'',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">是否加急：</div>
                <div class="liRight">
                    <?php echo Form::checkbox('urgent',$order->urgent,old('urgent'),['placeholder'=>'是否加急',"class"=>'radio',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">装机流程图：</div>
                <div class="liRight">
                    <?php echo Form::checkbox('flow_pic',$order->flow_pic,old('flow_pic'),['placeholder'=>'应用说明',"class"=>'radio']); ?>

                </div>
                <div class="clear"></div>
            </li>
                <li>
                    <div class="liLeft">上传流程图：</div>
                    <div class="liRight">
                        <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>

                    </div>
                    <div class="clear"></div>
                </li>
            </div>
            <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>



