<?php $__empty_1 = true; $__currentLoopData = $order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($good->product->title == '机箱' && $good->details['kun_bang_dian_yuan']): ?>
        <?php $power=$good->find($good->details['kun_bang_dian_yuan']);?>
    <?php endif; ?>
    <?php $all_goods=$good->product->good;?>
    <tr class="<?php echo e($good->product->bianhao); ?>">
        <td class="A_caozuo">
            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($good->id); ?>">
        </td>
        <td class="A_type">
            <?php echo e($good->product->title); ?>

        </td>
        <td class="tableInfoDel  tablePhoneShow  tableName A_name">
            <?php echo e(Form::select('name', $all_goods->pluck('name','id'),old('name',$good->id),['class'=>'select2 product_select','data_url'=>route('admin.orders.add_modified_temporary_materials',$order->id),'old_id'=>$good->id])); ?>

        </td>
        <td class="A_price"><?php echo e($good->pivot->product_good_price); ?></td>
        <td class="A_num num">
                <div class="A_numbox">
                <input type="number"  class="PJnum good_num OneNumber" style="text-align: center;padding: 0"  value="<?php echo e($good->pivot->product_good_num); ?>"  product-name="<?php echo e($good->product->title); ?>"  product-bianhao="<?php echo e($good->product->bianhao); ?>" good-id="<?php echo e($good->id); ?>" good-framework="<?php echo e($good->framework->name); ?>" good-jianma="<?php echo e($good->jianma); ?>" >
                </div>
                <div class="clear"></div>
            </div>
        </td>
        <td class="raids">
            <?php echo e(Form::select('raid1',$raids['raid1'],old('raid1',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid1 raid'])); ?>

            <?php echo e(Form::select('raid2',$raids['raid2'],old('raid2',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid2 raid'])); ?>

            <?php echo e(Form::select('raid3',$raids['raid3'],old('raid3',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid3 raid'])); ?>

            <?php echo e(Form::select('raid4',$raids['raid4'],old('raid4',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid4 raid'])); ?>

        </td>
        <td class="A_prices">
            
            <?php echo e($good->pivot->product_good_price * $good->pivot->product_good_num); ?>

        </td>
    </tr>
    <?php if(isset($power)): ?>
        <tr >
            <td class="A_num">
                <input type="hidden"  class="PJnum good_num"  product-name="<?php echo e($power->product->title); ?>"  product-bianhao="<?php echo e($power->product->bianhao); ?>" good-id="<?php echo e($power->id); ?>" good-framework="<?php echo e($power->framework->name); ?>" good-jianma="<?php echo e($power->jianma); ?>">
            </td>
        </tr>
    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="6"><div class="empty">没有数据</div></td>
    </tr>
<?php endif; ?>