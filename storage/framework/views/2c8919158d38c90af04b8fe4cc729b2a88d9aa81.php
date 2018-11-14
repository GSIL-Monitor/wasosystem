<div class="body FWEasy">
    <div class="big_bg big_bgActive">
        <div class="wrap">
            <div class="bgTXT">
                <h5>服务器、存储选型</h5>
                <p>根据自身需求快速匹配合适配置 随需而选 深度定制</p>
            </div>
        </div>
    </div>


    <!-- 选择  -->
    <div class="SDisignDiy checkDiy">
        <div class="wrap check_dl">
           <?php if ($__env->exists('site.model_selections.filter.server_selection_filter')) echo $__env->make('site.model_selections.filter.server_selection_filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="disignDiyBtn">
                <div class="errorMsg"></div>
                <span class="gotoNEXT" >提交</span>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <!-- 匹配结果  -->
    <div class="proShowList">
        <div class="wrap">
            <div class="waitPro"><img src="<?php echo e(asset('pic/witPro.gif')); ?>"><h5>正在使用大数据匹配中，请稍后...</h5></div>
            <div class="proList">
                <div id="server"></div>
            </div>
        </div>
    </div>



</div>

