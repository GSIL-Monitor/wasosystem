<?php
    $admin_account=$barcode_associated['admin']->pluck('name','account');
    $admin_id=$barcode_associated['admin']->pluck('name','id');

    $order=$barcode_associated['warehouse_out_management']->order;
?>
<?php echo $__env->make('admin.common.field._input',['title'=>'产品条码','field'=>'code','field_val'=>$barcode_associated['code'],'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._input',['title'=>'产品类型','field'=>null,'field_val'=>$barcode_associated['product_good']->product->title,'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::hidden('product_good_id',$barcode_associated['product_good']->id); ?>

<?php echo $__env->make('admin.common.field._input',['title'=>'产品规格','field'=>null,'field_val'=>$barcode_associated['product_good']->name,'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._input',['title'=>'借出时间','field'=>null,'field_val'=>$barcode_associated['warehouse_out_management']->created_at,'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::hidden('user_id',$barcode_associated['warehouse_out_management']->user->id); ?>

<?php echo $__env->make('admin.common.field._input',['title'=>'关联客户','field'=>null,'field_val'=>$barcode_associated['warehouse_out_management']->user->username,'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._input',['title'=>'当前事件','field'=>null,'field_val'=>config('status.barcode_associateds_type')[$barcode_associated['warehouse_out_management']->out_type],'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._select',['title'=>'选择事件','field'=>'current_state','field_list'=>array_only(config('status.barcode_associateds_type'),['borrow_to_sales','loan_out_return']),'other'=>['placeholder'=>'请选择事件','class'=>'checkNull','v-model'=>'selected','@change'=>'changeSelect()']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._input',['title'=>'经办人','field'=>null,'field_val'=>$order->markets->name ?? $admin_id[$barcode_associated['warehouse_out_management']->user->administrator],'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._select',['title'=>'产品成色','field'=>'product_colour','field_list'=>array_only(config('status.barcode_associateds_type'),['new','good','bad']),'other'=>['placeholder'=>'请选择产品成色','class'=>'checkNull',':disabled'=>'showColor']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::hidden('admin',admin()->id,["class"=>'checkNull','readonly']); ?>

<?php echo $__env->make('admin.common.field._input',['title'=>'操作人员','field'=>null,'field_val'=>admin()->name,'other'=>['class'=>'checkNull','readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._textarea',['title'=>'借出备注','field'=>null,'field_val'=>$barcode_associated['warehouse_out_management']->postscript,'other'=>['readonly']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.common.field._textarea',['title'=>'备注信息','field'=>'postscript','field_val'=>null,'other'=>[]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::hidden('warehouse_out_management_id',$barcode_associated['warehouse_out_management']->id ?? 0,["class"=>'checkNull','readonly']); ?>

<?php echo Form::hidden('order_id',$barcode_associated['warehouse_out_management']->order->id ?? 0,["class"=>'checkNull','readonly']); ?>

<?php echo Form::hidden('procurement_plans_id',$barcode_associated['procurement_plan']->id ?? 0,["class"=>'checkNull','readonly']); ?>

<?php echo Form::hidden('supplier_managements_id',$barcode_associated['procurement_plan']->supplier_managements->id ?? 0,["class"=>'checkNull','readonly']); ?>

<?php echo Form::hidden('barcode_associated_id',$barcode_associated['barcode_associated']->id ?? 0,["class"=>'checkNull','readonly']); ?>





