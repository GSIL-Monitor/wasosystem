<?php $__empty_1 = true; $__currentLoopData = $goodss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($good['good']->product->title == '机箱' && $good['good']->details['kun_bang_dian_yuan']): ?>
        <?php $power=$good['good']->find($good['good']->details['kun_bang_dian_yuan']);?>
    <?php endif; ?>
    <?php $all_goods=$good['good']->product->good;?>
    <tr class="<?php echo e($good['good']->product->bianhao); ?>">
        <td class="A_caozuo">
            <?php echo $good['good']->checkProduct['del_button']; ?>

            <?php echo $good['good']->parameters['html_hidden'] ?? ''; ?>

            <?php echo $good['good']->addiator['adiator'] ?? ''; ?>

        </td>
        <td class="A_type">
            <?php echo e($good['good']->product->title); ?>

        </td>
        <td class="tableInfoDel  tablePhoneShow  tableName A_name">
            <?php $goods=$good['good']->product->good; ?>
            <?php if(str_contains($good['good']->product_id, [13,20,21,23]) && !auth('admin')->user()->can('super edit')): ?>
                <?php echo e($good['good']->name); ?>

            <?php else: ?>
                <?php echo e(Form::select('name',$good['good']->parameters['list'] ?? $all_goods->pluck('name','id'),old('name',$good['good']->id),['class'=>'select2 product_select','data_url'=>route('admin.common_equipments.add_modified_temporary_materials',$common_equipment->id),'old_id'=>$good['good']->id])); ?>

            <?php endif; ?>
        </td>
        <td class="A_price" data-id="<?php echo $good['good']->addiator['terrace_price'] ?? ''; ?>"><?php echo e($good['good']->pivot->product_good_price); ?></td>
        <td class="A_num num">
            <div class="A_numbox" maxNum="<?php echo e($good['good']->parameters['max_num'] ??  $good['good']->checkProduct['max_num']); ?>" >
                <button class="canshunum <?php echo e($good['good']->checkProduct['del_class']); ?>"><?php echo e($good['good']->checkProduct['del_symbol']); ?></button>
                <input type="number"  class="PJnum good_num OneNumber" style="text-align: center;padding: 0" <?php echo e($good['good']->checkProduct['readonly']); ?> value="<?php echo e($good['good']->pivot->product_good_num); ?>"  product-name="<?php echo e($good['good']->product->title); ?>"  product-bianhao="<?php echo e($good['good']->product->bianhao); ?>" good-id="<?php echo e($good['good']->id); ?>" good-framework="<?php echo e($good['good']->framework->name); ?>" good-jianma="<?php echo e($good['good']->jianma); ?>" >
                <button class="canshunum <?php echo e($good['good']->checkProduct['add_class']); ?>"><?php echo e($good['good']->checkProduct['add_symbol']); ?></button>
                <div class="clear"></div>
            </div>
        </td>

        <td class="raids">
            <?php echo e(Form::select('raid1',$raids['raid1'],old('raid1',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid1 raid'])); ?>

            <?php echo e(Form::select('raid2',$raids['raid2'],old('raid2',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid2 raid'])); ?>

            <?php echo e(Form::select('raid3',$raids['raid3'],old('raid3',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid3 raid'])); ?>

            <?php echo e(Form::select('raid4',$raids['raid4'],old('raid4',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid4 raid'])); ?>

        </td>
        <td class="A_prices">
            
            <?php echo e($good['good']->pivot->product_good_price * $good['good']->pivot->product_good_num); ?>

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