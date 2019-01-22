<form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">供货商</th>
            <th class="">关联客户</th>
            <th class="">经办人</th>
            <th class="">操作员</th>
            <th class="">受理时间</th>

        </tr>

        <?php $__empty_1 = true; $__currentLoopData = $barcode_associateds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barcode_associated): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            
                
                 
                
                
                                                                       
                
                
                
                
                
                
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        <?php endif; ?>
    </table>
</form>