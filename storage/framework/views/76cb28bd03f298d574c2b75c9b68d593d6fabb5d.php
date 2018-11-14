<div class="JJList">
    <ul class="halfTwoUl" id="app">
        <?php echo Form::model($barcode_associated['barcode_associated'],['route'=>['admin.barcode_associateds.update',$barcode_associated['barcode_associated']->id],'id'=>'barcode_associateds','method'=>'put','onsubmit'=>'return false']); ?>

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
                <?php echo Form::text(null,$barcode_associated['barcode_associated']->product_good->product->title,['placeholder'=>'产品类型',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight">
                <?php echo Form::hidden('product_good_id',old('product_good_id',$barcode_associated['barcode_associated']->product_good->id),['placeholder'=>'产品规格',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::text(null,$barcode_associated['barcode_associated']->product_good->name,['placeholder'=>'产品规格',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">入库时间：</div>
            <div class="liRight">
                <?php echo Form::text(null,optional($barcode_associated['barcode_associated']->procurement_plans)->updated_at ?? $barcode_associated['barcode_associated']->updated_at,['placeholder'=>'入库时间',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">供货单位：</div>
            <div class="liRight">
                <?php echo Form::text(null,$barcode_associated['barcode_associated']->supplier_managements->name,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">关联客户：</div>
            <div class="liRight">
                <?php echo Form::hidden('user_id',old('user_id',$barcode_associated['barcode_associated']->user->id),['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::text(null,$barcode_associated['barcode_associated']->user->username . ' ' .$barcode_associated['barcode_associated']->user->nickname,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">当前事件：</div>
            <div class="liRight">
                <?php echo Form::text(null,config('status.barcode_associateds_type')[$barcode_associated['barcode_associated']->current_state],['placeholder'=>'当前事件',"class"=>'checkNull','readonly']); ?>

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
                    <?php echo Form::select('current_state',array_only(config('status.barcode_associateds_type'),['returned_to_the_factory','models_to_replace','stock_returns','breakage']),old('current_state'),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected','@change'=>'changeSelect()']); ?>

                    <?php endif; ?>
            </div>
            <div class="clear"></div>
        </li>
        <?php endif; ?>
            <li v-if="showSelect">
                <div class="liLeft">产品新类型：</div>
                <div class="liRight">
                    <?php echo Form::select('new_product_id',product()->pluck('title','id'),old('new_product_id'),['placeholder'=>'产品新类型',"class"=>'checkNull product']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li v-if="showSelect">
                <div class="liLeft">产品新规格：</div>
                <div class="liRight product_good">
                    <?php echo Form::select('new_product_good_id',[],old('new_product_good_id'),['placeholder'=>'产品新规格',"class"=>'checkNull good']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">经办人：</div>
            <div class="liRight">
                <?php
                    $admin_account=$barcode_associated['admin']->pluck('name','account');
                    $admin_id=$barcode_associated['admin']->pluck('name','id');
                    $order=$barcode_associated['barcode_associated']->order;
                ?>
                <?php echo Form::text(null,$order->markets->name  ?? $admin_id[$barcode_associated['barcode_associated']->user->administrator] ,['placeholder'=>'当前事件',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">采购人员：</div>
            <div class="liRight">
                <?php echo Form::text(null,$admin_id[$barcode_associated['barcode_associated']->procurement_plans->purchase ?? admin()->id],['placeholder'=>'采购人员',"class"=>'checkNull','readonly']); ?>

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
                <?php echo Form::hidden('product_colour',old('product_colour')); ?>

                <?php echo Form::hidden('two_code',old('two_code')); ?>

                <?php echo Form::hidden('supplier_managements_id',old('supplier_managements_id',$barcode_associated['barcode_associated']->procurement_plans->supplier_managements->id ?? 0),['placeholder'=>'供应商id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('order_id',old('order_id',$barcode_associated['barcode_associated']->order->id ?? 0),['placeholder'=>'订单id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('procurement_plans_id',old('procurement_plans_id',$barcode_associated['barcode_associated']->procurement_plans->id ?? 0),['placeholder'=>'入库id',"class"=>'','readonly']); ?>

                <?php echo Form::hidden('warehouse_out_management_id',old('warehouse_out_management_id',$barcode_associated['barcode_associated']->warehouse_out_management->id ?? 0),['placeholder'=>'出库id',"class"=>'','readonly']); ?>

                <?php echo Form::textarea('postscript',old('postscript',$barcode_associated['barcode_associated']->postscript),['placeholder'=>'信息备注',"class"=>'']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>