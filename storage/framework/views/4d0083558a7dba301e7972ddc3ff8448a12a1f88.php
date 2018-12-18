<div id="<?php echo e($chart->id); ?>" <?php echo $chart->formatContainerOptions('css'); ?>>
    <?php echo $__env->make('charts::loader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>