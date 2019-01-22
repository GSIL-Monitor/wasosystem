<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($pdf_title); ?></title>
    <link href="<?php echo e(asset('admin/css/pdf.css')); ?>" rel="stylesheet" type="text/css">
</head>


<body>

<div class="bg" style="page-break-inside:avoid;">
    <div class="tit">
        <h5><?php echo e($order->machine_model); ?></h5>
        <p><?php echo e(optional($complate_machine)->additional_arguments['page_description'] ?? '占位'); ?></p>
    </div>
    <div class="ling">
            <p><b>应用领域：</b><?php echo e(implode(',',optional($complate_machine)->application  ?? [])); ?></p>
            <p><b>产品优势：</b><?php echo e(optional($complate_machine)->additional_arguments['product_description'] ?? '占位'); ?></p>
        <div class="pics">
            <?php $pics=order_complete_machine_pic($complate_machine->complete_machine_product_goods,'all') ?? [];?>
            <?php $__empty_1 = true; $__currentLoopData = $pics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <img src="<?php echo e($item['url']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
           <?php endif; ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="canshu">

        <ul>

            <?php $__currentLoopData = \App\Exports\BaseSheetExport::material_details($order)['complete_machine_detailed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><span class="liT"><?php echo e($key); ?></span><span class="liC"><?php echo e($item); ?></span><div class="clear"></div></li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<div class='<?php echo e($bgImage); ?>' style="page-break-inside:avoid;">

</div>


</body>
</html>