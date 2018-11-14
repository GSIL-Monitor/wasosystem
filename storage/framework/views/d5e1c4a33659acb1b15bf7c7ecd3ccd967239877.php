<div class="fixLinks">
    <h5>关于我们</h5>
    <ul>
        <li class="<?php if(Route::is('about')): ?> active <?php endif; ?>"><a href="<?php echo e(route('about')); ?>"><i></i>公司介绍</a></li>
        <li class="<?php if(Route::is('honor')): ?> active <?php endif; ?>"><a href="<?php echo e(route('honor')); ?>"><i></i>荣誉资质</a></li>
        <li><a name="F_news" target="_blank" href="<?php echo e(url('/news_gongsi.html')); ?>"><i></i>网烁新闻</a></li>
        <li ><a target="_blank" href="<?php echo e(route('job.index')); ?>"><i></i>加入网烁</a></li>
        <li class="<?php if(Route::is('contact')): ?> active <?php endif; ?>"><a href="<?php echo e(route('contact')); ?>"><i></i>联系我们</a></li>
    </ul>
</div>