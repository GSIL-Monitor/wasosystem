
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
                    <dl>
                        <div class="">
                            <dd>
                                <div class="chart">
                                    <h4>供货商统计</h4>
                                    <iframe src="<?php echo e(url('/waso/supplie_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="chart">
                                        <h4>采购统计</h4>
                                        <iframe src="<?php echo e(url('/waso/procurement_plans_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="chart">
                                    <h4>出库统计</h4>
                                    <iframe src="<?php echo e(url('/waso/out_chart')); ?>" style="border: none"></iframe>
                                </div>
                                <div class="chart" style="height:380px">
                                    <h4>库存统计</h4>
                                    <iframe src="<?php echo e(url('/waso/inventory_chart')); ?>" style="border: none;width: 1050px;"></iframe>
                                </div>
                                <div class="clear"></div>
                            </dd>
                        </div>
                    </dl>
                    
                        
                            
                                
                                
                                    
                                    
                                        
                                            
                                                
                                                    
                                                    
                                                
                                            
                                            
                                        

                                    
                                
                            
                        
                    
                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>