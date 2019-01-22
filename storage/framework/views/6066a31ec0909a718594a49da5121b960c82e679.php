<form action="<?php echo e($url); ?>" method="get">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="search">
        <select name="type" id="" >
            <option value="name">产品型号</option>
            <option value="jiancheng">产品简称</option>
        </select>
        <input type="text" name="keyword" value="<?php echo e(old('keyword')); ?>" required placeholder="请输入关键字">
        <input type="hidden" name="product_id" value="<?php echo e($product_id); ?>" placeholder="">
        <input type="submit" class="Btn green"  value="搜索">
    </div>
</form>