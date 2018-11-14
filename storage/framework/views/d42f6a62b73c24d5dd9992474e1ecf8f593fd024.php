<div class="JJList">
    <ul class="maxUl" >
        <?php if(Route::is('admin.permissions.create')): ?>
            <?php echo Form::open(['route'=>'admin.permissions.store','method'=>'post','id'=>'permissions']); ?>

        <?php else: ?>
            <?php echo Form::model($permission,['route'=>['admin.permissions.update',$permission->id],'id'=>'permissions','method'=>'put']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">权限：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入权限,必须是字母',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">权限名：</div>
                <div class="liRight">
                    <?php echo Form::text('title',old('title'),['placeholder'=>'请输入权限名',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <?php if(!$roles->isEmpty()): ?>
            <li class="sixLi">
                <div class="liLeft">分配角色：</div>
                <div class="liRight">
                    <?php $permission_roles=isset($permission)?$permission->roles:false;?>
                    <?php if(isset($permission)): ?>
                        <?php echo e(implode(',',$permission_roles->pluck('title')->toArray())); ?>

                        <?php else: ?>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($role->id !==1): ?>
                            <label class="checkBoxLabel" for="<?php echo e($role->id); ?>">
                                <?php echo e(Form::checkbox('roles[]',  $role->id,old('roles[]',$permission_roles),['id'=>$role->id])); ?><?php echo e($role->title); ?>

                            </label>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </div>
                <div class="clear"></div>
            </li>
            <?php endif; ?>


        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


