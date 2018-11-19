<li>
    <div class="liLeft">产品成色：</div>
    <div class="liRight">
        <?php echo Form::select('product_colour',array_only(config('status.barcode_associateds_type'),['new','good','bad']),old('product_colour',$barcode_associated['barcode_associated']->product_colour),['placeholder'=>'产品成色',"class"=>'','disabled']); ?>

    </div>
    <div class="clear"></div>
</li>
<?php if($barcode_associated['barcode_associated']->two_code): ?>
    <li>
        <div class="liLeft">关联条码：</div>
        <div class="liRight">
            <?php echo Form::text('two_code',old('two_code',$barcode_associated['barcode_associated']->two_code),['placeholder'=>'关联条码',"class"=>'','disabled']); ?>

        </div>
        <div class="clear"></div>
    </li>
<?php endif; ?>