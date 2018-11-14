<div class="JJList">
    <ul class="halfTwoUl" id="app">
        <?php echo Form::model($barcode_associated['procurement_plan'],['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']); ?>

        <li>
            <div class="liLeft">产品条码：</div>
            <div class="liRight">
                <?php echo Form::text('code',old('code',$barcode_associated['code']),['placeholder'=>'产品条码',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品类型：</div>
            <div class="liRight">
                <?php echo Form::text(null,$barcode_associated['procurement_plan']->products->title,['placeholder'=>'产品类型',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight">
                <?php echo Form::hidden('product_good_id',old('product_good_id',$barcode_associated['procurement_plan']->product_goods->id),['placeholder'=>'产品规格',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::text(null,$barcode_associated['procurement_plan']->product_goods->name,['placeholder'=>'产品规格',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">入库时间：</div>
            <div class="liRight">
                <?php echo Form::text(null,$barcode_associated['procurement_plan']->updated_at,['placeholder'=>'入库时间',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">供货单位：</div>
            <div class="liRight">
                <?php echo Form::text(null,$barcode_associated['procurement_plan']->supplier_managements->name,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>

        <li>
            <div class="liLeft">当前事件：</div>
            <div class="liRight">
                <?php echo Form::text(null,config('status.barcode_associateds_type')[$status],['placeholder'=>'当前事件',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <?php if(!Request::has('search')): ?>
        <li>
            <div class="liLeft">选择事件：</div>
            <div class="liRight">
                <?php if(Request::has('type')): ?>
                    <?php echo Form::hidden('current_state',old('current_state',config('status.barcode_associateds_type')[Request::get('type')]),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected']); ?>

                    <?php echo Form::text(null,config('status.barcode_associateds_type')[Request::get('type')],['placeholder'=>'选择事件',"class"=>'checkNull','readonly']); ?>

                <?php else: ?>
                    <?php echo Form::select('current_state',array_only(config('status.barcode_associateds_type'),['test_return','test_to_procurement']),old('current_state'),['placeholder'=>'选择事件',"class"=>'checkNull select2']); ?>

                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </li>
        <?php endif; ?>
        <li>
            <div class="liLeft">采购人员：</div>
            <div class="liRight">
                <?php
                    $admin_account=$barcode_associated['admin']->pluck('name','account');
                    $admin_id=$barcode_associated['admin']->pluck('name','id');
                ?>
                <?php echo Form::text(null,$admin_id[$barcode_associated['procurement_plan']->purchase ?? admin()->id],['placeholder'=>'采购人员',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">操作人员：</div>
            <div class="liRight">
                <?php echo Form::hidden('admin',old('admin',admin()->id),['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::text(null,admin()->name,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li class="allLi">
            <div class="liLeft">信息备注：</div>
            <div class="liRight">
                <?php echo Form::hidden('supplier_managements_id',old('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0),['placeholder'=>'供应商id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('order_id',old('order_id',0),['placeholder'=>'订单id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('procurement_plans_id',old('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0),['placeholder'=>'入库id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('warehouse_out_management_id',old('warehouse_out_management_id',0),['placeholder'=>'出库id',"class"=>'','readonly']); ?>

                <?php echo Form::textarea('postscript',old('postscript',$barcode_associated['procurement_plan']->postscript),['placeholder'=>'信息备注',"class"=>'']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>