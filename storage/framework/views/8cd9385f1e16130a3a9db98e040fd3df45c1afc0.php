<div class="JJList">
    <ul class="maxUl"  id="app">
        <?php if(Route::is('admin.roles.create')): ?>
            <?php echo Form::open(['route'=>'admin.roles.store','method'=>'post','id'=>'roles']); ?>

        <?php else: ?>
            <?php echo Form::model($role,['route'=>['admin.roles.update',$role->id],'id'=>'roles','method'=>'put']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">角色：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入角色,必须是字母',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">角色名：</div>
                <div class="liRight">
                    <?php echo Form::text('title',old('title'),['placeholder'=>'请输入角色名',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="sixLi">
                <div class="liLeft">权限 <input type="checkbox" class="checkBoxAll">：</div>
                <div class="liRight">
                    <?php $permiss=isset($role)?$role->permissions:false; ?>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="checkBoxLabel" for="<?php echo e($permission->id); ?>">
                        <?php echo e(Form::checkbox('permissions[]',$permission->id,$permiss,['id'=>$permission->id,'class'=>'checkBox'])); ?><?php echo e($permission->title); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<script>
  $(function () {
        checkBox();
    });
</script>


