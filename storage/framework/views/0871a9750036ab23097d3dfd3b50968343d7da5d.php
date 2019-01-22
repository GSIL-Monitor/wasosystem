<?php $ProductParamenterPresenter = app('App\Presenters\ProductParamenterPresenter'); ?>
<?php $pinyin=$ProductParamenterPresenter->showPinyin();$childs=$product->Childrens()->whereParentId(0)->oldest('order')->get();?>
<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCanShu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $ZDCanShus=$ProductParamenterPresenter->showCanShu($childCanShu);
        $detailsPinYin=strtolower($pinyin->permalink($childCanShu->name,'_'));
    ?>
    <li class=" <?php if($childCanShu->type === 'checkbox'): ?> allLi <?php endif; ?>">
        
        <div class="liLeft"><?php echo e($childCanShu->name); ?>：</div>

        <div class="liRight">
            <?php if($childCanShu->type === 'input'): ?>
                <?php echo e(Form::text('details['.$detailsPinYin.']',old('details['.$detailsPinYin.']'),['placeholder'=>'请输入'.$childCanShu->name])); ?>

            <?php endif; ?>
            <?php if($childCanShu->type === 'select'): ?>
                <?php if(count($ZDCanShus) > 0): ?>
                    <?php echo e(Form::select('details['.$detailsPinYin.']',$ZDCanShus,old('details['.$detailsPinYin.']'),['class'=>'select2','placeholder'=>'请选择'.$childCanShu->name])); ?>

                <?php endif; ?>
            <?php endif; ?>
            <?php if($childCanShu->type === 'checkbox'): ?>
                <?php if(count($ZDCanShus) > 0): ?>
                    <?php $__currentLoopData = $ZDCanShus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$ZDCanShu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label for="details<?php echo e($childCanShu->id); ?><?php echo e($key); ?>">
                                <?php echo e(Form::checkbox('details['.$detailsPinYin.'][]',$key,old('details['.$detailsPinYin.']'),['id'=>"details".$childCanShu->id.$key])); ?><?php echo e($ZDCanShu); ?>

                            </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($childCanShu->type === 'radio'): ?>
                        <label for="details<?php echo e($detailsPinYin); ?>">
                            <?php echo e(Form::checkbox('details['.$detailsPinYin.']',$key,old('details['.$detailsPinYin.']'),['id'=>"details".$detailsPinYin])); ?>

                        </label>
        <?php endif; ?>
        </div>
        <div class="clear"></div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>