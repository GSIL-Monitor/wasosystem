
<div class="JJList">
    <div  id="app">
        <?php if(Route::is('admin.put_in_storage_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.put_in_storage_managements.store','method'=>'post','id'=>'put_in_storage_managements','onsubmit'=>'return false']); ?>

        <?php echo $__env->make('admin.put_in_storage_managements.form.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo Form::model($put_in_storage_management,['route'=>['admin.put_in_storage_managements.update',$put_in_storage_management->id],'id'=>'put_in_storage_managements','method'=>'put','onsubmit'=>'return false']); ?>

           <?php echo $__env->make('admin.put_in_storage_managements.form.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php echo Form::close(); ?>

        </ul>
    </div>






