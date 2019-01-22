
<?php $__env->startSection('js'); ?>
    <script>

        var vm = new Vue({
            el: "#app",
            data: {
                <?php if(Route::is('admin.information_managements.create')): ?>
                defaultList: [],
                <?php else: ?>
                defaultList:<?php echo $information_management->pic; ?>,
                <?php endif; ?>
                actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
                imageUrl: "<?php echo env('IMAGES_URL'); ?>",
                deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
                fileCount:1,
            },
            methods: {

            },
            mounted: function () {
            },
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.information_managements.create')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create information_managements')): ?>
                    <button type="submit" class="Btn common_add" form_id="information_managements"
                            location="top">添加</button>
                 <?php endif; ?>
                <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit information_managements')): ?>
                    <button type="submit" class="Btn common_add" form_id="information_managements"
                            location="top">修改</button>
                <?php endif; ?>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.information_managements.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>