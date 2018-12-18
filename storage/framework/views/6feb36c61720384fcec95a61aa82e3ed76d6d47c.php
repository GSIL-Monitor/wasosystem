<?php if(!Route::is('admin.self_build_terraces.create')): ?>
    <?php $self_build_terrace_product_goods=$self_build_terrace->product_goods_self_build_terrace()->with('product')->orderBy('product_number','asc')->get(); ?>
<?php else: ?>
    <?php $self_build_terrace_product_goods=Auth::user()->temporary_product_goods()->orderBy('product_number','asc')->get();?>
<?php endif; ?>
<div class="JJList zyw">
    <div class="zyw_left">
        <ul class="zywUl">
            <?php if(Route::is('admin.self_build_terraces.create')): ?>
                <?php echo Form::open(['route'=>'admin.self_build_terraces.store','method'=>'post','id'=>'self_build_terraces','onsubmit'=>'return false']); ?>

            <?php else: ?>
                <?php echo Form::model($self_build_terrace,['route'=>['admin.self_build_terraces.update',$self_build_terrace->id],'id'=>'self_build_terraces','method'=>'put','onsubmit'=>'return false']); ?>

            <?php endif; ?>
            <li>
                <div class="liLeft">产品架构：</div>
                <div class="liRight">
                    <?php echo Form::hidden('product_id',old('product_id',23)); ?>

                    <?php echo Form::select('jiagou_id',$arguments['terrace_framework'],old('jiagou_id'),['class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品系列：</div>
                <div class="liRight">
                    <?php echo Form::select('xilie_id',$arguments['terrace_series'],old('xilie_id'),['class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">平台类型：</div>
                <div class="liRight">
                    <?php echo Form::select('details[ping_tai_lei_xing]',$arguments['terrace_type'],old('details[ping_tai_lei_xing]'),['placeholder'=>'请选择平台类型','class'=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入名称','class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品简称：</div>
                <div class="liRight">
                    <?php echo Form::text('jiancheng',old('jiancheng'),['placeholder'=>'请输入产品简称','class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
                <li>
                    <div class="liLeft">质保时间：</div>
                    <div class="liRight">
                        <?php echo Form::number('quality_time',old('quality_time',3),['placeholder'=>'请输入质保时间','class'=>'checkNull']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
            <li class="allLi">
                <div class="liLeft">平台物料：</div>
                <div class="liRight">
                    <?php echo Form::text('jianma',old('jianma'),['placeholder'=>'请输入产品简码','class'=>'checkNull']); ?>

                    <span class="redWord"><?php echo e($arguments['terrace']->jianma); ?></span>
                </div>
                <div class="clear"></div>
            </li>
                <li class="allLi">
                    <div class="liLeft">产品简码：</div>
                    <div class="liRight">
                        <table class="listTable">
                            <tr>
                                <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                                <th class="">类型</th>
                                <th class="">名称</th>
                                <th class="">数量</th>
                                <th class="">成本</th>
                                <th class="">金额</th>
                            </tr>

                            <?php $__empty_1 = true; $__currentLoopData = $self_build_terrace_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan']): ?>
                                    <?php $power=$product_good->find($product_good->details['kun_bang_dian_yuan']);?>
                                <?php endif; ?>

                                <tr>
                                    <td class="tableInfoDel">
                                        <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product_good->id); ?>">
                                    </td>
                                    <td class="">
                                        <?php echo e($product_good->product->title); ?>

                                    </td>
                                    <td class="tableInfoDel  tablePhoneShow  tableName">
                                        <?php echo e($product_good->name); ?>

                                    </td>
                                    <td class="num">
                                        <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="<?php echo e($product_good->pivot->product_good_num); ?>" >
                                    </td>
                                    <td><?php echo e($product_good->price['cost_price']); ?></td>
                                    <td class="total_prices">
                                        
                                        <?php echo e($product_good->price['cost_price'] * $product_good->pivot->product_good_num); ?>

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

                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="addPro" id="app">
                                        <?php echo Form::select('product',$arguments['product'],old('product'),['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']); ?>

                                        <select2 :good-list="goodList" ref="Child"></select2>
                                        <input type="number"  value="" v-model="good_num">
                                        <input class="Btn" type="button" @click="add_good()" value="添加">
                                        <input class="red AllDel Btn" data_url="<?php echo e(url('/waso/self_build_terraces/destory')); ?>?goodDel=<?php echo e($self_build_terrace->id ?? 'admins'); ?>&self_build_terrace_id=<?php echo e($self_build_terrace->id ?? Auth::user()->id); ?>"  type="button" value="删除">

                                    </div>
                                </td>
                            </tr>
                            <tfoot/>

                        </table>
                    </div>
                    <div class="clear"></div>
                </li>

            <li class="allLi">
                <div class="liLeft">价格管理：</div>
                <div class="liRight">
                    
                    <?php $priceSun=priceSum($self_build_terrace_product_goods->pluck('price')); ?>
                    <?php $__currentLoopData = config('status.procuctGoodPrices'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key=='cost_price' || $key=='taobao_price'): ?>
                            <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]); ?></div></label>
                        <?php else: ?>
                            <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]); ?></div></label>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo Form::hidden('float',old('float',$productGood->float ?? 'smooth'),['id'=>'float']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <div class="clear"></div>
            <?php echo Form::close(); ?>

        </ul>
    </div>


</div>
<script src="<?php echo e(asset('admin/js/goodPrice.js')); ?>"></script>
<?php echo $__env->make('admin.common._addProduct',['model'=>'self_build_terraces','id'=>$self_build_terrace->id ?? Auth::user()->id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

