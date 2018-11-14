<div class="body">
    <div class="big_bg">
        <div class="wrap">
            <div class="bgTXT">
                <h5>解决方案</h5>
                <p>从实际需求出发，为您定制专属解决方案</p>
            </div>
        </div>
    </div>


    <div class="wrap">
        <div class="solutionType">
            <ul>
              <?php $__currentLoopData = $integrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $integration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="solBox">
                            <div class="typesPic" style="background-image:url('<?php echo e(pic($integration->pic)[0]['url']); ?>');"></div>
                            <div class="typeName"><?php echo e($integration->name); ?></div>
                            <div class="typesWords">
                                <dl>
                                    <i class="arrow round"></i>
                                    <dd>
                                      <?php $__currentLoopData = $integration->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('solution.show',$child->id)); ?>"><i></i> <?php echo e($child->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>
        </div>
    </div>



</div>
