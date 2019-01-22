<?php $WarehouseOutManagementParamenter = app('App\Presenters\WarehouseOutManagementParamenter'); ?>
<li>
    <div class="liLeft">出库类型：</div>
    <div class="liRight">
        <?php echo Form::hidden('user_id',old('user_id'),['placeholder'=>'user_id',"class"=>'checkNull ']); ?>

        <?php echo Form::hidden('order_id',old('order_id'),['placeholder'=>'order_id',"class"=>'checkNull ']); ?>

        <?php echo Form::select('out_type',config('status.warehouse_out_managements_type'),old('out_type'),['placeholder'=>'出库类型',"class"=>'checkNull select2']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">序列号：</div>
    <div class="liRight">
        <?php echo Form::text('serial_number',old('serial_number'),['placeholder'=>'序列号',"class"=>'checkNull','readonly']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">出库时间：</div>
    <div class="liRight">
        <?php echo Form::text(null,\Carbon\Carbon::createFromDate(),['placeholder'=>'序列号',"class"=>'checkNull','readonly']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">收货单位：</div>
    <div class="liRight">
        <?php echo Form::text(null,$warehouse_out_management->user->username.' - '.$warehouse_out_management->user->nickname,['placeholder'=>'收货单位',"class"=>'checkNull','readonly']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">已出库数：</div>
    <div class="liRight">
    <?php echo Form::text('finish_out_number',old('finish_out_number'),['placeholder'=>'已出库数',"class"=>'checkNull','readonly','v-model'=>'out_storage_count']); ?>

</div>
<div class="clear"></div>
</li>
<li>
    <div class="liLeft">确认数目：</div>
    <div class="liRight">
        <?php echo Form::text('out_number',old('out_number'),['placeholder'=>'确认数目',"class"=>'checkNull','readonly','v-model'=>'out_storage_storage_counts']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">条码录入：</div>
    <div class="liRight">
        <?php echo Form::text(null,null,['placeholder'=>'条码录入',"class"=>'out_storage','v-model'=>'code','v-on:keyup.enter'=>"entering()",':disabled'=>'disabled']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">经办人：</div>
    <div class="liRight">
        <?php echo Form::text(null,$warehouse_out_management->order->markets->name ?? $warehouse_out_management->admins->name ?? '',['placeholder'=>'经办人',"class"=>'checkNull','readonly']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">操作人：</div>
    <div class="liRight">
        <?php echo Form::hidden('admin',$warehouse_out_management->admins->id ?? auth('admin')->user()->id,['placeholder'=>'经办人',"class"=>'checkNull','readonly']); ?>

        <?php echo Form::text(null,$warehouse_out_management->admins->name ?? auth('admin')->user()->name,['placeholder'=>'经办人',"class"=>'checkNull','readonly']); ?>

    </div>
    <div class="clear"></div>
</li>
<li class="allLi">
    <div class="liLeft">备注信息：</div>
    <div class="liRight">
        <?php echo Form::textarea('postscript',old('postscript'),['placeholder'=>'备注信息',"class"=>'']); ?>

    </div>
    <div class="clear"></div>
</li>
<li class="TiaoMaList">
    <div class="liLeft">条码：</div>
    <div class="liRight">
        <?php echo Form::textarea('code',old('code'),['placeholder'=>'备注信息',"class"=>'codes','readonly']); ?>

        <table class="listTable"  ref="good">
            <tr>
                <th>产品条码</th>
                <th>产品类型</th>
                <th>产品名</th>
                <th>清除条码</th>
            </tr>
        <?php echo $WarehouseOutManagementParamenter->CodeTable($warehouse_out_management->codes); ?>

        </table>
    </div>
    <div class="clear"></div>
</li>
