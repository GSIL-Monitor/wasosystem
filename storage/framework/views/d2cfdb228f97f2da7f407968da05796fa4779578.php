<div class="zyw">
    <?php if(Route::is('admin.product_goods.create')): ?>
        <?php echo Form::open(['route'=>'admin.product_goods.store','method'=>'post','id'=>'product_goods']); ?>

    <?php else: ?>
        <?php echo Form::model($productGood,['route'=>['admin.product_goods.update',$productGood->id],'id'=>'product_goods','method'=>'put']); ?>

    <?php endif; ?>
    <div class="zyw_left " id="app">
        <ul class="zywUl">

            <Tabs>
                <tab-pane label="产品基本信息" icon="clipboard">
                    <li>
                        <div class="liLeft">架构类型：</div>
                        <div class="liRight">
                            <?php echo Form::hidden('product_id',old('product_id',$product->id)); ?>

                            <?php echo Form::hidden('series_name',old('series_name'),['v-model'=>'series_name']); ?>

                            <?php echo Form::hidden('framework_name',old('framework_name'),['v-model'=>'framework_name']); ?>

                            <?php if(Route::is('admin.product_goods.create')): ?>
                            <?php $frameworks=$product->framework()->whereParentId(0)->where('id','<>','279')->order('name','asc')->pluck('name', 'id');?>
                            <?php else: ?>
                                <?php $frameworks=$product->framework()->whereParentId(0)->order('name','asc')->pluck('name', 'id');?>
                            <?php endif; ?>
                            <?php echo Form::select('jiagou_id',$frameworks,old('jiagou_id'),['placeholder'=>'请选择架构类型','class'=>'checkNull framework_name','v-model'=>'typed','@change'=>'getCanshus()']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">产品系列：</div>
                        <div class="liRight">
                            <select v-model="xilied" name="xilie_id" class='checkNull series_name' @change="series_names()">
                                <option value="">请先择产品系列</option>
                                <option v-for="(item,index) in series" :value="item.id">{{ item.name }}</option>
                            </select>
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
                        <div class="liLeft">原厂代码：</div>
                        <div class="liRight">
                            <?php echo Form::text('daima',old('daima'),['placeholder'=>'请输入原厂代码','class'=>'']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">质保时间：</div>
                        <div class="liRight">
                            <?php echo Form::text('quality_time',old('quality_time'),['placeholder'=>'请输入质保时间','class'=>'checkNull OneNumber']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">产品简码：</div>
                        <div class="liRight">
                            <?php echo Form::text('jianma',old('jianma'),['placeholder'=>'请输入产品简码','class'=>'checkNull']); ?>

                            <span class="redWord"><?php echo e($product->jianma); ?></span>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">价格管理：</div>
                        <div class="liRight">
                            <?php $__currentLoopData = config('status.procuctGoodPrices'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key=='cost_price' || $key=='taobao_price'): ?>
                                    <label class="priceLabel">
                                        <div class="priceTit"><?php echo e($value); ?>：</div>
                                        <div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]); ?></div>
                                    </label>
                                <?php else: ?>
                                    <label class="priceLabel">
                                        <div class="priceTit"><?php echo e($value); ?>：</div>
                                        <div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]); ?></div>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo Form::hidden('float',old('float',$productGood->float ?? 'smooth'),['id'=>'float']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>

                    <li class="allLi">
                        <div class="liLeft">产品状态：</div>
                        <div class="liRight">
                            <?php $__currentLoopData = config('status.procuctGoodStatus'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="checkBoxLabel" for="<?php echo e($key); ?>">
                                    <?php if($key=='show'): ?>
                                        <?php echo e(Form::checkbox('status['.$key.']',1,old('status['.$key.']',true),['onclick'=>'this.value=(this.value==0)?1:0','id'=>$key])); ?>

                                    <?php else: ?>
                                        <?php echo e(Form::checkbox('status['.$key.']',0,old('status['.$key.']'),['onclick'=>'this.value=(this.value==0)?1:0','id'=>$key])); ?>

                                    <?php endif; ?>
                                    <?php echo e($status); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <?php if($product->id==20 || $product->id==23): ?>
                        <li class="allLi">
                            <div class="liLeft">产品图片：</div>
                            <div class="liRight">
                                <upload-images :file-count="fileCount" :default-list="defaultList"
                                               :action-image-url="actionImageUrl" :image-url="imageUrl"
                                               :delete-image-url="deleteImageUrl"></upload-images>
                            </div>
                            <div class="clear"></div>
                        </li>
                    <?php endif; ?>
                </tab-pane>
                <tab-pane label="产品参数" icon="ios-settings">
                    <?php if(count($product->Childrens) > 0): ?>
                        <?php echo $__env->make('admin.product_goods.details',$product, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </tab-pane>
            </Tabs>

        </ul>
    </div>

    

    <?php echo Form::close(); ?>

</div>

    <script src="<?php echo e(asset('admin/js/goodPrice.js')); ?>"></script>





