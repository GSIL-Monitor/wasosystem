<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="javascript:page('<?php echo e(str_after($paginator->previousPageUrl(),'page=')); ?>')" rel="prev">&lsaquo;</a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-item disabled"><span class="page-link"><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active"><span class="page-link"><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="javascript:page('<?php echo e($page); ?>')"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="javascript:page('<?php echo e(str_after($paginator->nextPageUrl(),'page=')); ?>')" rel="next">&rsaquo;</a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
        <?php endif; ?>
        
    </ul>
<?php endif; ?>