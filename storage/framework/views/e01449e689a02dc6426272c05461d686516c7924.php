<div class="JJList">
    <ul class="maxUl" >
        <?php if(Route::is('admin.admins.create')): ?>
            <?php echo Form::open(['route'=>'admin.admins.store','method'=>'post','id'=>'admins']); ?>

        <?php else: ?>
            <?php echo Form::model($admin,['route'=>['admin.admins.update',$admin->id],'id'=>'admins','method'=>'put']); ?>

        <?php endif; ?>

            <li class="sixLi">
                <div class="liLeft">分配角色：</div>
                <div class="liRight">
                    <?php $admin_role=isset($admin)?$admin->roles:false; ?>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="checkBoxLabel" for="<?php echo e($role->id); ?>">
                        <?php echo e(Form::checkbox('roles[]',  $role->id,old('roles[]',$admin_role),['id'=> $role->id])); ?><?php echo e($role->title); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>

            <li>
                <div class="liLeft">禁用：</div>
                <div class="liRight">
                        <?php echo e(Form::checkbox('disabled',$admin->disabled ?? 0,old('disabled'),['class'=>'radio'])); ?>

                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">工号：</div>
            <div class="liRight">
                <?php echo Form::text('account',old('account'),['placeholder'=>'请输入工号',"class"=>'checkNull']); ?>

            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">工号密码：</div>
                <div class="liRight">
                    <?php echo Form::password('password',old('password'),['placeholder'=>'请输入工号密码,为空保持原密码',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号姓名：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入工号姓名',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号电话：</div>
                <div class="liRight">
                    <?php echo Form::text('phone',old('phone'),['placeholder'=>'请输入工号电话',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号邮箱：</div>
                <div class="liRight">
                    <?php echo Form::text('email',old('email'),['placeholder'=>'请输入工号邮箱',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号QQ：</div>
                <div class="liRight">
                    <?php echo Form::text('qq',old('qq'),['placeholder'=>'请输入工号QQ',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


