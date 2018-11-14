
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/indexPage.css')); ?>" type="text/css">
    <script>
        $(document).ready(function(){
            $(document).on("click",".mobile_show dl",function(){
                if($(this).hasClass("opend")){
                    $(this).removeClass("opend");
                    $(this).children("dd").hide();
                }else{
                    $(this).addClass("opend").siblings("dl").removeClass("opend");
                    $(this).children("dd").show();
                    $(this).siblings("dl").children("dd").hide();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="PageBox">
        <div class="WEB">
            <div class="indexL">
                <div class="faxtLinks index_links">
                    <?php $__currentLoopData = $nav['TiaoMenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$navs['url'])): ?>
                            <dl>
                                <dt><?php echo e($navs->name); ?><i></i></dt>
                                <div class="linksHide">
                                    <?php $childMenus=$navs->childMenus;?>
                                    <?php if(count($childMenus) >0): ?>
                                        <dd>
                                            <?php $__currentLoopData = $childMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$childMenu->slug)): ?>
                                                    <?php $pic=array_flatten(json_decode($childMenu->pic,true));?>
                                                    <a sys="tiao" href="javascript:;" url="<?php echo e($childMenu->slug); ?>"><em><?php echo e($childMenu->name); ?></em></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="clear"></div>
                                        </dd>

                                    <?php endif; ?>
                                </div>
                            </dl>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>