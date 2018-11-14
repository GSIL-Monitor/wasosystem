<?php $__currentLoopData = $server_selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server_selection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <dl>
        <dt><b><?php echo e($server_selection->name); ?>（<?php if($server_selection->select_type == 'radio'): ?>单选 <?php else: ?> 复选 <?php endif; ?>）<em> <?php echo e($server_selection->description); ?></em></b><i class="trans ModeIco"></i></dt>
        <dd class="trans">
            <ul class="<?php if($server_selection->select_type == 'radio'): ?>radioLi <?php else: ?> checkBoxLi <?php endif; ?>">
                <?php if(count($server_selection->children) > 0): ?>
                    <?php $__currentLoopData = $server_selection->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li name="<?php echo e($child->id); ?>"><img src="<?php echo e(pic($child->child->pic)[0]['url'] ??  ''); ?>"><h1><?php echo e($child->name); ?></h1></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </dd>
        <dd class="errorMSG">至少选择一项</dd>
    </dl>
    <?php if($loop->index == 0) break; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>