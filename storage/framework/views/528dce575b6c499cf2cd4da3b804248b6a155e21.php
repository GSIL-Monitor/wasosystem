
<?php $__env->startSection('title',$complete_machine_framework->name ?? '全部'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/server.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/product.js')); ?>"></script>
    <script src="<?php echo e(asset('js/server.js')); ?>"></script>
    <script>

        function checkSit(){
            var con_sit = $("#con_sit").val();
            var Wwidth =$(window).width() ;
            if(Wwidth>900){
                if(con_sit == '0'){
                    $('.hide_condition').removeClass("opend");
                }else if(con_sit == '1'){
                    $('.hide_condition').addClass("opend");
                }
            }
        }
        /*隐藏筛选*/
        $(".choosed dl .condition_list li span").each(function () {
            var key = $(this).attr('name');
            $("a[name=" + key + "]").parents('dd').parents('dl').parents('.condition_box').hide();
        });
        checkSit();
        var url="<?php echo e(route('server.search',$id)); ?>";

        $(function () {
            $(".type_box li:nth-child(4n)").addClass("lastLi");
           $(document).on('click','.page-item:not(".disabled")',function () {
               var lastPage=$(this).attr('data-total')
               $(this).addClass('active').siblings().removeClass('active')
           })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.servers.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>