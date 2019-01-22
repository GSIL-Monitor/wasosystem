<?php $DemandManagementParamenter = app('App\Presenters\DemandManagementParamenter'); ?>
<div class="JJList">

    <ul class="maxUl editInfo" >
        <?php if(Route::is('admin.demand_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.demand_managements.store','method'=>'post','id'=>'demand_managements','onsubmit'=>'return false']); ?>

            <?php if(is_mobile()): ?>
                <?php echo $__env->make('admin.demand_managements.form.mobile_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('admin.demand_managements.form.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

        <?php else: ?>
            <?php echo Form::model($demand_management,['route'=>['admin.demand_managements.update',$demand_management->id],'id'=>'demand_managements','method'=>'put','onsubmit'=>'return false']); ?>

            <?php if(is_mobile()): ?>
                <?php echo $__env->make('admin.demand_managements.form.mobile_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('admin.demand_managements.form.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>

            <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>



