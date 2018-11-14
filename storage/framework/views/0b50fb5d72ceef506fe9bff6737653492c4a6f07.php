<div class="JJList">
    <ul class="maxUl" >
        <?php if(Route::is('admin.common_equipments.create')): ?>
            <?php echo Form::open(['route'=>'admin.common_equipments.store','method'=>'post','id'=>'common_equipments','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($common_equipment,['route'=>['admin.common_equipments.update',$common_equipment->id],'id'=>'common_equipments','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>

        <li>
            <div class="liLeft">配置名称：</div>
            <div class="liRight">
                <?php echo Form::hidden('null',$parameters['order_type_code'][$common_equipment->order_type],["class"=>'code']); ?>

                <?php echo Form::hidden('null',$common_equipment->user->tax_rates->identifying,["class"=>'tax_point']); ?>

                <?php echo Form::hidden('price_spread',old('price_spread',0),["class"=>'price_spread']); ?>

                <?php echo Form::text('name',old('name'),["class"=>'checkNull']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">上一次更新时间：</div>
            <div class="liRight">
                <?php echo Form::text(null,$common_equipment->updated_at,['readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">客户账户：</div>
            <div class="liRight">
                <input type="text" value="<?php echo e($common_equipment->user->username); ?>" readonly="">
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">整机型号：</div>
                <div class="liRight">
                    <?php echo Form::text('machine_model',old('machine_model'),['placeholder'=>'整机型号',"class"=>'checkNull name','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">配置代码：</div>
            <div class="liRight">
                <?php echo Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']); ?>

                <div class="codeBox">
                    <div id="qrcode"></div>
                    <?php if(auth('admin')->user()->can('super edit')): ?>
                        <button class="Btn alertWeb" data_url="<?php echo e(route('admin.common_equipments.show',$common_equipment->id)); ?>">修改配置</button>
                    <?php endif; ?>
                    <button class="Btn OpenCode">显示二维码</button>
                    <button class="Btn CloseCode" style="display: none;">隐藏二维码</button>
                </div>
            </div>
            <div class="clear"></div>
        </li>
        <li class="sevenLi">
            <div class="liLeft">物料列表：</div>
            <div class="liRight">
                <table class="listTable">
                    <tr>
                        <th class="">类型</th>
                        <th class="tableInfoDel">名称</th>
                        <th class="">数量</th>
                        <th class="">成本</th>
                        <th class="">金额</th>
                    </tr>
                    <?php $common_equipment_product_goods=$common_equipment->common_equipment_product_goods()->with(['product','framework'])->orderBy('product_number','asc')->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $common_equipment_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan']): ?>
                            <?php $power=$product_good->find($product_good->details['kun_bang_dian_yuan']);?>
                        <?php endif; ?>
                        <tr>
                            <td class="">
                                <?php echo e($product_good->product->title); ?>

                            </td>
                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                <?php echo e($product_good->name); ?>

                            </td>
                            <td class="num">
                                <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="<?php echo e($product_good->pivot->product_good_num / $common_equipment->num); ?>"  product-name="<?php echo e($product_good->product->title); ?>"  product-bianhao="<?php echo e($product_good->product->bianhao); ?>" good-id="<?php echo e($product_good->id); ?>" good-framework="<?php echo e($product_good->framework->name); ?>" good-jianma="<?php echo e($product_good->jianma); ?>" >
                                <?php echo e($product_good->pivot->product_good_raid); ?>

                            </td>
                            <td data-price="<?php echo e($product_good->pivot->product_good_price); ?>" class="product_good_price"><?php echo e($product_good->pivot->product_good_price); ?></td>
                            <td class="total_price">
                                
                                <?php echo e($product_good->pivot->product_good_price * $product_good->pivot->product_good_num); ?>

                            </td>
                        </tr>
                        <?php if(isset($power)): ?>
                            <tr >
                                <td class="num">
                                    <input type="hidden"  class="PJnum good_num"  product-name="<?php echo e($power->product->title); ?>"  product-bianhao="<?php echo e($power->product->bianhao); ?>" good-id="<?php echo e($power->id); ?>" good-framework="<?php echo e($power->framework->name); ?>" good-jianma="<?php echo e($power->jianma); ?>">
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6"><div class="empty">没有数据</div></td>
                        </tr>
                    <?php endif; ?>
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
                    <?php echo Form::number('num',old('num'),['placeholder'=>'订单金额',"class"=>'checkNull order_num OneNumber',':disabled'=>'isDisabled']); ?>

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
                    <?php echo Form::select('invoice_type',$parameters['invoice'],old('invoice_type'),['placeholder'=>'开票类型',"class"=>'checkNull invoice_type',':disabled'=>'isDisabled']); ?>

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
                    <?php echo Form::hidden('market',old('market',$common_equipment->market),['placeholder'=>'销售人员',"class"=>'checkNull','readonly']); ?>

                    <?php echo Form::text(null,$parameters['admins'][$common_equipment->market] ?? '',['placeholder'=>'销售人员',"class"=>'checkNull','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户要求：</div>
                <div class="liRight">
                    <?php echo Form::textarea('user_remark',old('user_remark'),['placeholder'=>'客户要求',"class"=>'checkNull',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">公司备注：</div>
                <div class="liRight">
                    <?php echo Form::textarea('company_remark',old('company_remark'),['placeholder'=>'公司备注',"class"=>'checkNull',':disabled'=>'isDisabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
        </div>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


