<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.complete_machine_frameworks.create')): ?>
            <?php echo Form::open(['route'=>'admin.complete_machine_frameworks.store','method'=>'post','id'=>'complete_machine_frameworks']); ?>

        <?php else: ?>
            <?php echo Form::model($completeMachineFrameworks,['route'=>['admin.complete_machine_frameworks.update',$completeMachineFrameworks->id],'id'=>'complete_machine_frameworks','method'=>'put']); ?>

        <?php endif; ?>
        <li>
            <div class="liLeft">所属父级：</div>
            <div class="liRight">
                <?php echo e($parent->name); ?>

                <?php echo Form::hidden('parent_id',old('parent_id',$parent->id )); ?>

                <?php echo Form::hidden('category',old('category',$category)); ?>

            </div>
            <div class="clear"></div>
        </li>
        <?php if(!Request::has('parent')): ?>
            <li>
                <div class="liLeft">名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('complete_machine_framework_radio_type'),['placeholder'=>'请输入名称','class'=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <div v-if="is_filtrate == 'filtrate'">
                <?php if(!Request::has('select')): ?>
                    <li>
                        <div class="liLeft">筛选类型：</div>
                        <div class="liRight">
                            <?php echo Form::select('select_type',config('status.complete_machine_framework_select_type'),old('select_type'),['placeholder'=>'请选择筛选类型','class'=>'select2 checkNull']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">描述：</div>
                        <div class="liRight">
                            <?php echo Form::textarea('description',old('description'),['placeholder'=>'请输描述']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                <?php endif; ?>
            </div>
            <li>
                <div class="liLeft">图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList"
                                   :action-image-url="actionImageUrl"
                                   :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
        <?php else: ?>
            <?php if(Request::get('parent') != 252): ?>
                <li>
                    <div class="liLeft">分类：</div>
                    <div class="liRight">
                        <?php echo Form::select('child_category',config('status.complete_machine_framework_radio_type'),old('child_category'),['placeholder'=>'请选择一个分类','class'=>'checkNull','v-model'=>'category']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'filtrate'">
                    <div class="liLeft">问题：</div>
                    <div class="liRight ">
                        <div class="checkboxs">

                            <?php $__currentLoopData = $listArr['filtrate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filtrate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="answer<?php echo e($filtrate->id); ?>">
                                    <?php echo Form::checkbox('name['.$filtrate->id.']',$filtrate->name,old('name['.$filtrate->id.']'),['id'=>'answer'.$filtrate->id,'class'=>'checkNull']); ?>

                                    <?php echo e($filtrate->name); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'answer'">
                    <div class="liLeft">答案：</div>
                    <div class="liRight">
                        <div class="checkboxs">
                            <?php $__currentLoopData = $listArr['answer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="answer<?php echo e($answer->id); ?>">
                                    <?php echo Form::checkbox('name['.$answer->id.']',$answer->name,old('name['.$answer->id.']'),['id'=>'answer'.$answer->id,'class'=>'checkNull']); ?>

                                    <?php echo e($answer->name); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'product'">
                    <div class="liLeft">答案：</div>
                    <div class="liRight">
                        <div class="checkboxs">
                            <?php $__currentLoopData = $listArr['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="product<?php echo e($product->id); ?>">
                                    <?php echo Form::checkbox('name['.$product->id.']',$product->name,old('name['.$product->id.']'),['id'=>'product'.$product->id,'class'=>'checkNull']); ?>

                                    <?php echo e($product->name); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php else: ?>
                <li>
                    <div class="liLeft"></div>
                    <div class="liRight">
                        <div class="checkboxs">
                            <?php $__currentLoopData = $listArr['it_service']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="answer<?php echo e($answer->id); ?>">
                                    <?php echo Form::checkbox('name['.$answer->id.']',$answer->name.'/'.$answer->details['cooperation_types'],old('name['.$answer->id.']'),['id'=>'answer'.$answer->id,'class'=>'checkNull']); ?>

                                    <?php echo e($answer->name); ?> / <?php echo e($answer->details['cooperation_types']); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php endif; ?>
        <?php endif; ?>


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
            is_filtrate: '<?php echo e($category); ?>',
            category: '',
            <?php if(Route::is('admin.complete_machine_frameworks.create')): ?>
            defaultList: [],
            <?php else: ?>
            defaultList:<?php echo $completeMachineFrameworks->pic; ?>,
            <?php endif; ?>
            actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
            imageUrl: "<?php echo env('IMAGES_URL'); ?>",
            deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
            fileCount: 1,
        },
        methods: {},
        mounted: function () {
        },
    });

</script>


