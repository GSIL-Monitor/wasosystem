<div class="body">
    <div class="wrap">
        <div class="search">
            <h5>您想寻找什么内容？</h5>
            <?php echo Form::open(['route'=>'search','method'=>'get']); ?>

            <?php echo Form::text('key',old('key',Request::get('key')),['class'=>'search_text']); ?>

            <?php echo Form::submit('搜索',['class'=>'search_btn','onclick'=>'layer.load(0, {shade: false});']); ?>

            <?php echo Form::close(); ?>

            <div class="clear"></div>
        </div>
    </div>

    <div class="result_div">
        <div class="wrap">

            <?php if($integrations->isNotEmpty() || $informationManagements->isNotEmpty()  || $completeMachines->isNotEmpty() ): ?>
                <div class="searchTypePage">
                    <ul>
                        <?php if($completeMachines->isNotEmpty()): ?>
                            <li>产品<span>(<?php echo e($completeMachines->count()); ?>)</span></li>
                        <?php endif; ?>
                            <?php if($informationManagements->isNotEmpty()): ?>
                            <li>资讯<span>(<?php echo e($informationManagements->count()); ?>)</span></li>
                        <?php endif; ?>
                            <?php if($integrations->isNotEmpty()): ?>

                                <li>解决方案<span>(<?php echo e($integrations->count()); ?>)</span></li>
                       <?php endif; ?>
                        <div class="clear"></div>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="searchResultBox">
                <?php if($integrations->isNotEmpty() || $informationManagements->isNotEmpty()  || $completeMachines->isNotEmpty() ): ?>
                    <?php if ($__env->exists('site.searchs.search_machine')) echo $__env->make('site.searchs.search_machine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php if ($__env->exists('site.searchs.search_inforation')) echo $__env->make('site.searchs.search_inforation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php if ($__env->exists('site.searchs.search_integration')) echo $__env->make('site.searchs.search_integration', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    <div class="error">没有您要查询的内容</div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
