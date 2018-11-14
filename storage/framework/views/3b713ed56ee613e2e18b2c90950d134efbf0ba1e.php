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
        <notempty name="chanpin">
            <p><b>应用领域：</b><?php echo e(implode(',',optional($complate_machine)->application  ?? [])); ?></p>
            <p><b>产品优势：</b><?php echo e(optional($complate_machine)->additional_arguments['product_description'] ?? '占位'); ?></p>
        </notempty>
        <div class="pics">
            <notempty name="pic">
                <volist name="pic" id="v" offset="0" length="3">
                    <img src="__PUBLIC__/Uploads/{$v}">
                </volist>
            </notempty>
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