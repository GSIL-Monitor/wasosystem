<?php $ProductParamenterPresenter = app('App\Presenters\ProductParamenterPresenter'); ?>
<?php $pinyin=$ProductParamenterPresenter->showPinyin();?>
<div class="JJList" >
    <ul class="maxUl"  >
        <?php if(Route::is('admin.complete_machines.create')): ?>
            <?php echo Form::open(['route'=>'admin.complete_machines.store','method'=>'post','id'=>'complete_machines','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($complete_machine,['route'=>['admin.complete_machines.update',$complete_machine->id],'id'=>'complete_machines','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">产品型号：</div>
                <div class="liRight">

                    <?php echo Form::text('name',old('name'),['placeholder'=>'产品型号',"class"=>'checkNull name','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">配置代码：</div>
                <div class="liRight">
                    <?php echo Form::hidden('null',Request::get('parent_id')==1 ? 3 :4,["class"=>'code']); ?>

                    <?php echo Form::hidden('parent_id',old('parent_id')); ?>

                    <?php echo Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']); ?>

                    <div class="codeBox">
                        <div id="qrcode"></div>
                        <button class="Btn OpenCode">显示二维码</button>
                        <button class="Btn CloseCode" style="display: none;">隐藏二维码</button>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">整机明细：</div>
                <div class="liRight">
                    <table class="listTable">
                        <tr>
                            <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                            <th class="">类型</th>
                            <th class="tableInfoDel">名称</th>
                            <th class="">数量</th>
                            <th class="">成本</th>
                            <th class="">金额</th>
                        </tr>
                        <?php if(!Route::is('admin.complete_machines.create')): ?>
                            <?php $complete_machine_product_goods=$complete_machine->complete_machine_product_goods()->orderBy('product_number','asc')->get();
                            ?>
                        <?php else: ?>
                            <?php $complete_machine_product_goods=Auth::user()->temporary_product_goods()->orderBy('product_number','asc')->get();?>

                        <?php endif; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $complete_machine_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                        <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="<?php echo e($product_good->pivot->product_good_num); ?>"  product-name="<?php echo e($product_good->product->title); ?>"  product-bianhao="<?php echo e($product_good->product->bianhao); ?>" good-id="<?php echo e($product_good->id); ?>" good-framework="<?php echo e($product_good->framework->name); ?>" good-jianma="<?php echo e($product_good->jianma); ?>" >
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
                                        <input class="red AllDel Btn" data_url="<?php echo e(url('/waso/complete_machines/destory')); ?>?goodDel=<?php echo e($complete_machine->id ?? 'admins'); ?>&complete_machine_id=<?php echo e($complete_machine->id ?? Auth::user()->id); ?>"  type="button" value="删除">

                                    </div>
                                </td>
                            </tr>
                            <tfoot/>

                    </table>
                </div>
                <div class="clear"></div>
            </li>

            <li class="sevenLi">
                <div class="liLeft">价格管理：</div>
                <div class="liRight">
                    
                    <?php $priceSun=priceSum($complete_machine_product_goods->pluck('price')) ;?>
                    <?php $__currentLoopData = config('status.complete_machine_prices'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key=='balance'): ?>
                            <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']',$complete_machine->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]); ?></label>
                        <?php else: ?>
                            <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]); ?></div></label>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">整机质保(年)：</div>
                <div class="liRight">
                    <?php echo Form::number('quality_time',old('quality_time'),['placeholder'=>'整机质保(年)','class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>

            <li class="halfLi">
                <div class="liLeft">架构类型：</div>
                <div class="liRight">
                    <?php $__currentLoopData = $arguments['framework']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$framework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php   $frameworkPinYin=strtolower($pinyin->permalink($framework,'_')); ?>
                        <label class="checkBoxLabel" for="jiagou<?php echo e($key); ?>">
                            <?php echo e(Form::checkbox('jiagou['.$frameworkPinYin.']',$framework,old('details['.$frameworkPinYin.']'),['id'=>"jiagou".$key])); ?><?php echo e($framework); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
            <li class="halfLi">
                <div class="liLeft">应用类型：</div>
                <div class="liRight">

                    <?php $__currentLoopData = $arguments['application']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php   $applicationPinYin=strtolower($pinyin->permalink($application,'_'));$childrens=$application->children ?? []; ?>
                        <?php if(count($childrens) > 0): ?>
                            <dl>
                                <dt><?php echo e($application->name); ?>：</dt>
                                <dd>
                                    <?php if(count($childrens) > 0): ?>
                                        <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php   $applicationPinYin=strtolower($pinyin->permalink($children->name ,'_')); ?>
                                            <label class="checkBoxLabel" for="application<?php echo e($applicationPinYin); ?>">
                                                <?php echo e(Form::checkbox('application['.$applicationPinYin.']',$children->name,old('details['.$applicationPinYin.']'),['id'=>"application".$applicationPinYin])); ?><?php echo e($children->name); ?>

                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </dd>
                                <div class="clear"></div>
                            </dl>
                            <?php else: ?>
                            <label class="checkBoxLabel" for="application<?php echo e($applicationPinYin); ?>">
                                <?php echo e(Form::checkbox('application['.$applicationPinYin.']',$application,old('details['.$applicationPinYin.']'),['id'=>"application".$applicationPinYin])); ?><?php echo e($application); ?>

                            </label>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">外形规格：</div>
                <div class="liRight">
                    <?php echo Form::text('additional_arguments[mm]',old('additional_arguments[mm]'),['placeholder'=>'外形规格']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">重量(Kg)：</div>
                <div class="liRight">
                    <?php echo Form::number('weight',old('weight'),['placeholder'=>'重量(Kg)']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">宣传单页描述：</div>
                <div class="liRight">
                    <?php echo Form::text('additional_arguments[page_description]',old('additional_arguments[page_description]'),['placeholder'=>'宣传单页描述']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品描述：</div>
                <div class="liRight">
                    <?php echo Form::text('additional_arguments[product_description]',old('additional_arguments[product_description]'),['placeholder'=>'产品描述']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">支持系统：</div>
                <div class="liRight">
                    <?php echo Form::text('additional_arguments[system]',old('additional_arguments[system]','Windows®  2008/2012/win7/win10; Linux;Unix'),['placeholder'=>'支持系统']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">温度湿度：</div>
                <div class="liRight">
                    <?php echo Form::text('additional_arguments[humidity]',old('additional_arguments[humidity]','工作温度及相对湿度：5°C - 35°C，8% - 90%（非凝结）；储存温度及相对湿度：-40°C - 70°C，5% - 95%（非凝结）'),['placeholder'=>'温度湿度']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">机型介绍：</div>
                <div class="liRight">
                    <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <script id="container" name="details"   type="text/plain">
                        <?php if(!Route::is('admin.complete_machines.create')): ?>
                            <?php echo $complete_machine->details; ?>

                        <?php endif; ?>
                    </script>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<?php echo $__env->make('admin.common._addProduct',['model'=>'complete_machines','id'=>$complete_machine->id ?? Auth::user()->id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

