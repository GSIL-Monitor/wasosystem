<ul class="halfTwoUl">

            <li>
                <div class="liLeft">预购序列号：</div>
                <div class="liRight">
                    <?php echo Form::text('serial_number',old('serial_number',$put_in_storage_management->serial_number ?? 'RK'.date('YmdHis',time())),['placeholder'=>'procurement_plan',"class"=>'checkNull','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">采购类型：</div>
            <div class="liRight">
                <?php echo Form::select('procurement_type',config('status.procurement_plans_type'),old('procurement_type'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">供货单位：</div>
            <div class="liRight">
                <?php echo Form::select('supplier_managements_id',$parameters['supplier_managements'],old('supplier_managements_id'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品类型：</div>
            <div class="liRight">
                <?php echo Form::select('product_id',$parameters['product'],old('product_id'),['placeholder'=>'请选择产品类型',"class"=>'checkNull select2 product',':disabled'=>'isDisabled']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight product_good" >
                <?php if(isset($put_in_storage_management)): ?>
                    <?php echo Form::select('product_good_id',$parameters['product_goods'],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good',':disabled'=>'isDisabled']); ?>

                <?php else: ?>
                    <?php echo Form::select('product_good_id',[],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good']); ?>

                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">采购数量：</div>
            <div class="liRight">
                <?php echo Form::text('procurement_number',old('procurement_number'),['placeholder'=>'采购数量',"class"=>'checkNull OneNumber',':readonly'=>'isDisabled',"v-model"=>'procurement_number']); ?>

            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">已录入数量：</div>
                <div class="liRight">
                    <?php echo Form::text('finish_procurement_number',old('finish_procurement_number'),['placeholder'=>'录入条目',"class"=>'checkNull',':readonly'=>'isDisabled','v-model'=>'finish_procurement_number_count']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">条码录入：</div>
                <div class="liRight">
                    <?php echo Form::text(null,null,['placeholder'=>'条码录入',"class"=>'finish_procurement_number','v-model'=>'code','v-on:keyup.enter'=>"entering()",':disabled'=>'disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">产品成色：</div>
            <div class="liRight">
                <?php $arr=config('status.procurement_plans_colour'); array_pull($arr,'bad')?>
                <?php echo Form::select('product_colour',$arr,old('product_colour'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">质保时间：</div>
            <div class="liRight">
                <?php echo Form::text('quality_time',old('quality_time'),['placeholder'=>'质保时间',"class"=>' OneNumber',':disabled'=>'isDisabled']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">采购人员：</div>
            <div class="liRight">
                <?php echo Form::hidden('purchase',old('purchase',$put_in_storage_management->purchase ?? auth('admin')->user()->id),['placeholder'=>'采购人员',"class"=>'checkNull']); ?>

                <?php echo Form::text(null,$put_in_storage_management->purchases->name ?? auth('admin')->user()->name,['placeholder'=>'采购人员',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">操作人员：</div>
                <div class="liRight">
                    <?php echo Form::hidden('admin',old('admin',auth('admin')->user()->id),['placeholder'=>'操作人员',"class"=>'checkNull ']); ?>

                    <?php echo Form::text(null, auth('admin')->user()->name,['placeholder'=>'操作人员',"class"=>'checkNull','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
       <li class="allLi">
            <div class="liLeft">备注信息：</div>
            <div class="liRight">

                <?php echo Form::textarea('postscript',old('postscript'),['placeholder'=>'备注信息',"class"=>'',":disabled"=>'finish']); ?>

            </div>
            <div class="clear"></div>
        </li>
           <li class="TiaoMaList">
                <div class="liLeft">条码：</div>
                <div class="liRight">
                    一级<textarea name="code" v-model="codes" readonly></textarea>
                    二级<textarea  v-model="two_code" readonly></textarea>
                <table class="listTable">
                    <tr>
                        <th>条码</th>
                        <th v-show="show">操作</th>
                    </tr>

                    <tr v-for="(item,index) in codes">
                        <td>{{ item }}</td>
                        <td v-show="show"><Poptip
                                    confirm
                                    title="你确定删除这个条码吗?"
                                    @on-ok="del(index)"
                                    ok-text="删除"
                                   >
                                <Button class="Btn red">删除</Button>
                            </Poptip></td>
                    </tr>
                </table>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
    </ul>




