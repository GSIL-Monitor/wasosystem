
<table class="listTable">
    <tr>

        <th class="tableInfoDel" <?php if($cate != 'parts' && $productGoods->isNotEmpty()): ?> hidden <?php endif; ?>><input type="checkbox" class="selectBox SelectAll"></th>
        <th class="tableInfoDel">配件类型</th>
        <th class="">配件名称</th>
        <th  class="">数量</th>
        <th  class="">质保(年)</th>
        <th  class="">单价</th>
        <th  class="">合计</th>
    </tr>
    <?php $__empty_1 = true; $__currentLoopData = $productGoods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productGood): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($productGood->product->title == '机箱' && $productGood->details['kun_bang_dian_yuan']): ?>
            <?php $power=$productGood->find($productGood->details['kun_bang_dian_yuan']);?>
        <?php endif; ?>
        <tr>
            <td class="tableInfoDel"  <?php if($cate != 'parts' && $productGoods->isNotEmpty()): ?> hidden <?php endif; ?>>  <input class="selectBox selectIds" <?php if($cate != 'parts' && $productGoods->isNotEmpty()): ?> checked <?php endif; ?> type="checkbox" name="id[]" value="<?php echo e($productGood->id); ?>"></td>
            <td><?php echo e($productGood->product->title); ?></td>
            <td class="tableInfoDel  tablePhoneShow  tableName"><?php echo e($productGood->name); ?></td>
            <td class="num">
                <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="<?php echo e($productGood->pivot->product_good_num); ?>"  product-name="<?php echo e($productGood->product->title); ?>"  product-bianhao="<?php echo e($productGood->product->bianhao); ?>" good-id="<?php echo e($productGood->id); ?>" good-framework="<?php echo e($productGood->framework->name); ?>" good-jianma="<?php echo e($productGood->jianma); ?>" >
                <?php echo e($productGood->pivot->product_good_raid); ?>

            </td>
            <td><?php echo e($productGood->quality_time); ?></td>
            <td data-price="<?php echo e($productGood->pivot->product_good_price); ?>" class="product_good_price"><?php echo e($productGood->pivot->product_good_price); ?></td>
            <td class="total_price">
                <?php echo e($productGood->pivot->product_good_price * $productGood->pivot->product_good_num); ?>

            </td>
        </tr>
        <?php if(isset($power)): ?>
            <tr >
                <td class="num">
                    <input type="hidden"  class="PJnum good_num"  product-name="<?php echo e($power->product->title); ?>"  product-bianhao="<?php echo e($power->product->bianhao); ?>" good-id="<?php echo e($power->id); ?>" good-framework="<?php echo e($power->framework->name); ?>" good-jianma="<?php echo e($power->jianma); ?>">
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7">暂时没有物料！</td>
        </tr>
    <?php endif; ?>
    <tfoot>
    <tr class="tit">
        <td colspan="7">
            <div class="addPro" id="app" >
                <?php if($cate == 'parts'): ?>
                    <?php echo $__env->make('admin.demand_managements.table.parts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    <?php if($productGoods->isEmpty()): ?>
                    <?php echo $__env->make('admin.demand_managements.table.complete_machine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </td>
    </tr>
    <tfoot/>
</table>
