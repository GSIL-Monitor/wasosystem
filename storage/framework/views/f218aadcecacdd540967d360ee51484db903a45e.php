<div id="newsfoot">
    <div class="wrap">
        <div class="webLinks">
            <ul>
                <li><a href="/">网烁官网</a></li>
                <span>|</span>
                <li><a href="{:U('Products/Products')}">产品分类</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('server_selection')); ?>">服务器定制</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('designer_selection')); ?>">设计师电脑定制</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('solution')); ?>">解决方案</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('it_outsourcing')); ?>">服务外包</a></li>
                <span>|</span>
                <li><a href="{:U('Support/Support')}">服务支持</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('about')); ?>">关于我们</a></li>
                <div class="clear"></div>
            </ul>
        </div>

        <div class="f_down">
            <div class="wrap">
                <h5>Copyright © <span class="year"><?php echo e(today()->format('Y')); ?></span> 成都网烁信息科技有限公司 版权所有</h5>
            </div>
        </div>
    </div>
</div>


<?php if ($__env->exists('site.layouts.top')) echo $__env->make('site.layouts.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>