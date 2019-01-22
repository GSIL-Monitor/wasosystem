<div class="body">
    <?php if ($__env->exists('site.index.components.p_header')) echo $__env->make('site.index.components.p_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--    手机端   菜单  -->
    <?php if ($__env->exists('site.index.components.banner')) echo $__env->make('site.index.components.banner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--  banner  结束  -->
    <!--  公司优势  结束  -->
    <?php if ($__env->exists('site.index.components.advantage_AD')) echo $__env->make('site.index.components.advantage_AD', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--  服务器分类  -->
    <?php if ($__env->exists('site.index.components.application')) echo $__env->make('site.index.components.application', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--  首页推荐机型  -->
    <?php if ($__env->exists('site.index.components.machine')) echo $__env->make('site.index.components.machine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--  解决方案 -->
    <div class="solutions bgDiv">
        <div class="wrap">
            <h1>网烁行业解决方案</h1>
            <p>从实际需求出发，为您定制专属解决方案</p>
            <a href="" class="btn">查看更多</a>
        </div>
    </div>
    <!--  快捷服务  -->
    <?php if ($__env->exists('site.index.components.service')) echo $__env->make('site.index.components.service', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- 其他  -->
        <?php if ($__env->exists('site.index.components.news')) echo $__env->make('site.index.components.news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<!-- 页身 -->