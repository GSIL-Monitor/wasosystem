
<?php $complete_machine_paramenter = app('App\Presenters\CompleteMachineParamenter'); ?>

<?php $__env->startSection('title',$comparisons->implode('name',' - ').' - 产品对比'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/comparision.css')); ?>" rel="stylesheet" type="text/css">
    <style>
        .addComparisonBox{
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
             function checkComparisons(){
                if($('.comparisons').length < 4){
                    $('.addComparisonBox').show();
                }else{
                    $('.addComparisonBox').hide();
                }
            }
            checkComparisons();
            $(document).on("click", ".remove", function () {
                var url = $(this).attr('data_url');
                var id= $(this).attr('data_id');
                var self=$(this);
                var proLength = $(".remove").length;
                if (proLength < 3) {
                    swal('最少2个产品对比', '', 'warning');
                    return false;
                }
                axios.get(url)
                    .then(function () { // 请求成功会执行这个回调
                        self.parents('td').remove();
                        $('.remove'+id).remove();
                        checkComparisons();
                    }, function (error) { // 请求失败会执行这个回调
                        swal('系统错误', '', 'error');
                    });

            });
            $(document).on("change", ".addComparison", function () {
                var id=$(this).val();
                axios.get("/completeMachine/"+id+"/comparison")
                    .then(function () { // 请求成功会执行这个回调
                        location.reload();
                    }, function (error) { // 请求失败会执行这个回调
                        swal('系统错误', '', 'error');
                    });

            });

        });

    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div id="crumbs"><div class="wrap"><a href="#">首页</a> > <a href="{:U('Products/products')}">产品中心</a> > 产品对比</div></div>

        <div class="wrap">
            <div class="detail_box">
                <table>
                    <tr id="add">
                        <td class="big_tit"></td>

                        <?php if($comparisons->count() <= 4): ?>
                            <?php $__currentLoopData = $comparisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comparison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $pics=order_complete_machine_pic($comparison->complete_machine_product_goods,'all');?>
                                <td class="comparisons">
                                    <a href="<?php echo e(route('server.show',$comparison->id)); ?>" target="_blank"><img
                                                class='lazy' data-original="<?php echo e($pics[0]['url'] ?? ''); ?>"  alt="" width="250px" height="200px"/></a>
                                    <a class="name" href="<?php echo e(route('server.show',$comparison->id)); ?>" target="_blank"><?php echo e($comparison->name); ?></a>
                                    <div class="control">
                                            <a class="remove" data_id="<?php echo e($comparison->id); ?>" data_url="<?php echo e(route('server.comparisonRemove',$comparison->id)); ?>">删除</a>
                                            <a class="shop" href="<?php echo e(route('server.show',$comparison->id)); ?>">购买</a>
                                    </div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td class="addComparisonBox" >
                                        <?php echo Form::select(null,$complete_machines,null,['class'=>'select2 addComparison','placeholder'=>'请选择对比整机']); ?>

                                    </td>
                        <?php endif; ?>
                    </tr>
                    <?php $__currentLoopData = $complete_machine_paramenter->material_details($comparisons); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $comparison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="details"><td class="big_tit"><?php echo e($key); ?></td>
                        <?php $__currentLoopData = $comparison; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="remove<?php echo e($key2); ?>"><?php echo e(empty($detail) ? '----' : $detail); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </table>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>