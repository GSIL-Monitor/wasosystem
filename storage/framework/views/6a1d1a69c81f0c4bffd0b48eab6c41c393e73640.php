<li>
    <div class="liLeft">产品成色：</div>
    <div class="liRight">
        <?php echo Form::select('product_colour',array_only(config('status.barcode_associateds_type'),['new','good','bad']),old('product_colour',''),['placeholder'=>'产品成色',"class"=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>