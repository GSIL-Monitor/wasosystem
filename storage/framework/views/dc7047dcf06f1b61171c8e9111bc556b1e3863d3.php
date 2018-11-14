<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.it_services.create')): ?>
            <?php echo Form::open(['route'=>'admin.it_services.store','method'=>'post','id'=>'it_services']); ?>

        <?php else: ?>
            <?php echo Form::model($it_service,['route'=>['admin.it_services.update',$it_service->id],'id'=>'it_services','method'=>'put']); ?>

        <?php endif; ?>
        <li>
            <div class="liLeft">架构类型：</div>
            <div class="liRight">
                <?php echo Form::hidden('product_id',old('product_id',24)); ?>

                <?php echo Form::select('jiagou_id',$product_framework,old('jiagou_id',162),['placeholder'=>'请选择架构类型','class'=>'checkNull select2']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品系列：</div>
            <div class="liRight">
                <?php echo Form::select('xilie_id',$product_series,old('xilie_id'),['placeholder'=>'请选择架构类型','class'=>'checkNull select2']); ?>

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
            <div class="liLeft">合作类型：</div>
            <div class="liRight">
                <?php echo Form::text('details[cooperation_types]',old('details[cooperation_types]'),['placeholder'=>'请输入合作类型','class'=>'']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品基数：</div>
            <div class="liRight">
                <?php echo Form::number('details[product_base]',old('details[product_base]'),['placeholder'=>'产品基数','class'=>'checkNull']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">计数单位：</div>
            <div class="liRight">
                <?php echo Form::text('details[tally]',old('details[tally]'),['placeholder'=>'请输入计数单位','class'=>'']); ?>

            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">描述：</div>
                <div class="liRight">
                    <?php echo Form::textarea('details[description]',old('details[description]'),['placeholder'=>'请输入描述','class'=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li class="sevenLi">
            <div class="liLeft">价格管理：</div>
            <div class="liRight">
                <?php $__currentLoopData = config('status.procuctGoodPrices'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key=='cost_price' || $key=='taobao_price'): ?>
                        <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$it_service->price[$key] ?? 0]); ?></div></label>
                    <?php else: ?>
                        <label class="priceLabel"><div class="priceTit"><?php echo e($value); ?>：</div><div class="priceCont"><?php echo Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]); ?></div></label>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo Form::hidden('float',old('float',$it_service->float ?? 'smooth'),['id'=>'float']); ?>

            </div>
            <div class="clear"></div>
        </li>

        <li>
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
            <li>
                <div class="liLeft">产品图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>

        <?php echo Form::close(); ?>

    </ul>

</div>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
<script src="<?php echo e(asset('admin/js/goodPrice.js')); ?>"></script>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            <?php if(Route::is('admin.it_services.create')): ?>
            defaultList: [],
            <?php else: ?>
            defaultList:<?php echo $it_service->pic; ?>,
            <?php endif; ?>
            actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
            imageUrl: "<?php echo env('IMAGES_URL'); ?>",
            deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
            fileCount:1,
        },
        methods: {
        },
        mounted: function () {

        },
    });

</script>





