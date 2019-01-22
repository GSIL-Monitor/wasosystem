
<div class="condition">
        <div :class="{hide_condition:true,opend:condition_more}">
             <?php $__currentLoopData = $designer_filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$server_filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div :class="{condition_box:true,'<?php echo e($key); ?>':true}">
                    <?php if(count($server_filter) > 1): ?>
                    <dl>
                        <dt><?php echo e($key); ?>：</dt>
                        <?php $__currentLoopData = $server_filter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($key2)): ?>
                                <?php switch($key):
                                    case ('类型'): ?>
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('<?php echo e($key); ?>','<?php echo e($key2); ?>')"><?php echo e($key2); ?></a>
                                    </dd>
                                    <?php break; ?>;
                                    <?php case ('价格'): ?>
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('<?php echo e($key); ?>','<?php echo e($item); ?>')"><?php echo e($item); ?></a>
                                    </dd>
                                    <?php break; ?>;
                                    <?php case ('内存容量'): ?>
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('<?php echo e($key); ?>','<?php echo e($key2); ?>')"><?php echo e($key2); ?>G</a>
                                    </dd>
                                    <?php break; ?>;
                                    <?php case ('硬盘容量'): ?>
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('<?php echo e($key); ?>','<?php echo e($key2); ?>')"><?php echo e($key2); ?>G</a>
                                    </dd>
                                    <?php break; ?>;
                                    <?php default: ?>
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('<?php echo e($key); ?>','<?php echo e($key2); ?>')"><?php echo e($key2); ?></a>
                                    </dd>
                                <?php endswitch; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="clear"></div>
                    </dl>
                    <?php endif; ?>
                    <div class="clear"></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</div>

