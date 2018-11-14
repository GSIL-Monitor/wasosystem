
<?php $__env->startSection('title','图形工作站及设计师电脑选型'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/product_list.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/designer_easy.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/designer.js')); ?>"></script>
    <script>
        $(function () {
            $('.disignDiy dl').eq(0).css("display","block");
            $('.disignDiy dl:last').addClass('lastdl');
            $(".designAD .txtCon:nth-child(2n)").addClass("ConEven");

            /* 提交选项*/
            $(document).on("click",".gotoNEXT",function(){
                if(check()=="ok"){
                    $(".designAD").hide();
                    $('html,body').animate({scrollTop:0},1000);
                    $(".body .checkDiy").hide().siblings(".proShowList").show();
                    time();
                    var arr=[];
                    $.each($('.trans').find('label'),function(){
                        var str=$(this).text();
                        arr.push(str.substring(0,str.length-1));
                    });
                    axios.post("<?php echo e(route('designer_selection.designer_filter')); ?>",{
                        "_token":getToken(),
                        "filters":JSON.stringify(arr)
                    }).then(function (response) {
                        $('#server').html(response.data.html);
                    }).catch(function (err) {
                        $('#server').html(err.response.data.html);
                        if(err.response.data.message !=undefined){
                            swal(err.response.data.message,'请根据提示操作！','error');
                        }

                    })
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('site.model_selections.body.designer_selection_body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>