 <li v-if="showColor || showTable">
        <div class="liLeft">产品成色：</div>
        <div class="liRight">
            <?php echo Form::select('product_colour',array_only(config('status.barcode_associateds_type'),['new','good','bad']),old('product_colour',''),['placeholder'=>'请选择产品成色',"class"=>'checkNull select2']); ?>

        </div>
        <div class="clear"></div>
    </li>
    <li v-if="showInput">
        <div class="liLeft">条码录入：</div>
        <div class="liRight">
            <?php echo Form::text(null,null,['placeholder'=>'条码录入',"class"=>'code','v-model'=>'code','v-on:keyup.enter'=>"entering()"]); ?>

        </div>
        <div class="clear"></div>
    </li>
    <li v-if="showInput">
        <div class="liLeft">新条码：</div>
        <div class="liRight">
            <?php echo Form::text('two_code',old('two_code'),['placeholder'=>'新条码',"class"=>'','v-model'=>'new_code','readonly']); ?>

        </div>
        <div class="clear"></div>
    </li>
 <li v-if="showTable">
     <div class="liLeft">更换条码：</div>
     <div class="liRight">
         <?php echo Form::select('two_code',$loan_outs,old('two_code'),['placeholder'=>'请选择要更换的条码',"class"=>'checkNull']); ?>


     </div>
     <div class="clear"></div>
 </li>