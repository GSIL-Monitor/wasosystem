

<?php $__env->startSection('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('admin/css/indexPage.css')); ?>" type="text/css">
    <script>
        $(document).ready(function () {
            $(document).on("click", ".mobile_show dl", function () {
                if ($(this).hasClass("opend")) {
                    $(this).removeClass("opend");
                    $(this).children("dd").hide();
                } else {
                    $(this).addClass("opend").siblings("dl").removeClass("opend");
                    $(this).children("dd").show();
                    $(this).siblings("dl").children("dd").hide();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="PageBox">
        <div class="WEB">
            <div class="indexL">
                <div class="faxtLinks index_links">
                    <dl>
                        <div class="linksHide">
                            <dd>
                                <a href="<?php echo e(route('admin.demand_managements.index')); ?>"><em>需求管理</em></a>
                                <a href="<?php echo e(route('admin.orders.index')); ?>"><em>全部订单</em></a>
                                <a href="<?php echo e(route('admin.users.index')); ?>"><em>会员管理</em></a>
                                <a href="<?php echo e(route('admin.services.index')); ?>"><em>服务管理</em></a>
                                <a href="<?php echo e(route('admin.barcodes.index')); ?>"><em>条码查询</em></a>
                                <div class="clear"></div>
                            </dd>
                        </div>
                    </dl>
                    <dl>

                            <dd>

                                <div class="chart">
                                    <h4>本月综合统计</h4>
                                    <iframe src="<?php echo e(url('/waso/all_data_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('show self_user')): ?>
                                    <div class="chart">
                                        <h4>全部会员统计</h4>
                                        <iframe src="<?php echo e(url('/waso/user_chart')); ?>" style="border: none"></iframe>
                                    </div>
                                <?php endif; ?>

                                <div class="chart">
                                    <h4>所属会员统计</h4>
                                    <iframe src="<?php echo e(url('/waso/self_user_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('show self_orders')): ?>
                                    <div class="chart">
                                        <h4>全部交易统计</h4>
                                        <iframe src="<?php echo e(url('/waso/order_price_chart')); ?>"
                                                style="border: none"></iframe>
                                    </div>
                                <?php endif; ?>
                                <div class="chart">
                                    <h4>所属交易统计</h4>
                                    <iframe src="<?php echo e(url('/waso/self_order_price_chart')); ?>"
                                            style="border: none"></iframe>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('show self_orders')): ?>
                                    <div class="chart">
                                        <h4>全部订单统计</h4>
                                        <iframe src="<?php echo e(url('/waso/order_chart')); ?>" style="border: none"></iframe>
                                    </div>
                                <?php endif; ?>
                                <div class="chart">
                                    <h4>所属订单统计</h4>
                                    <iframe src="<?php echo e(url('/waso/self_order_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="chart">
                                    <h4>文章统计</h4>
                                    <iframe src="<?php echo e(url('/waso/articles_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="chart" style="width: 620px;">
                                    <h4>全部产品统计</h4>
                                    <iframe src="<?php echo e(url('/waso/product_goods_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="clear"></div>
                            </dd>
                    </dl>

                    
                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>