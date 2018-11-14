<li class="allLi">
    <div class="liLeft">信息备注：</div>
    <div class="liRight">
        <?php echo Form::text('supplier_managements_id',
        old('supplier_managements_id',
        $barcode_associated['supplier_managements']->id ?? ''
        ),
        ['placeholder'=>'供应商id',"class"=>'','readonly']); ?>

        <?php echo Form::text('order_id',
        old('order_id',
        $barcode_associated['order']->id ?? 0
        ),['placeholder'=>'订单id',"class"=>'','readonly']); ?>

        <?php echo Form::text('procurement_plans_id',
        old('procurement_plans_id',
        $barcode_associated['procurement_plan']->id ?? 0
        ),['placeholder'=>'入库id',"class"=>'','readonly']); ?>

        <?php echo Form::text('warehouse_out_management_id',
        old('warehouse_out_management_id',
           $barcode_associated['warehouse_out_management']->id ??  0
        ),['placeholder'=>'出库id',"class"=>'','readonly']); ?>

           <?php echo Form::text('barcode_associated_id',
        old('barcode_associated_id',
           $barcode_associated['barcode_associated']->id ??  0
        )
        ,['placeholder'=>'关联id',"class"=>'','readonly']); ?>

        入库备注:<?php echo Form::textarea(null,  $barcode_associated['procurement_plan']->postscript ?? '',['placeholder'=>'入库备注',"class"=>'','disabled']); ?>

        出库备注:<?php echo Form::textarea(null, $barcode_associated['warehouse_out_management']->postscript ?? '',['placeholder'=>'出库备注',"class"=>'','disabled']); ?>

        信息备注:<?php echo Form::textarea('postscript',old('postscript', $barcode_associated['barcode_associated']->postscript ?? ''),['placeholder'=>'信息备注',"class"=>'']); ?>

    </div>
    <div class="clear"></div>
</li>