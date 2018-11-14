<div class="JJList">
    <ul class="halfTwoUl" >
        <?php if(Route::is('admin.warehouse_out_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.warehouse_out_managements.store','method'=>'post','id'=>'warehouse_out_managements','onsubmit'=>'return false']); ?>

            <?php echo $__env->make('admin.warehouse_out_managements.form.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo Form::model($warehouse_out_management,['route'=>['admin.warehouse_out_managements.update',$warehouse_out_management->id],'id'=>'warehouse_out_managements','method'=>'put','onsubmit'=>'return false']); ?>

            <?php echo $__env->make('admin.warehouse_out_managements.form.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>



