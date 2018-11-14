
<?php $__env->startSection('title','我的消息('.user()->notification_count.')'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/notifications.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-ui-1.9.2.custom.js')); ?>"></script>
    <script>
        $(function () {
                $(document).on("click",".check_read",function(){
                    var url=$(this).attr('data_url');
                    var txt = $(this).find("p");
                    if(txt.is(":visible")){
                        txt.slideUp();
                    }else{
                        if($(this).hasClass('noread')){
                            axios.get(url);
                            $(this).find('.notRead').removeClass('notRead').addClass('readed').text('[已读]');
                        }
                        txt.slideDown();
                    }
                });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.notifications.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>