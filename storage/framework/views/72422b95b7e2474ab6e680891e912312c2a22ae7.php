<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.notifications.create')): ?>
            <?php echo Form::open(['route'=>'admin.notifications.store','method'=>'post','id'=>'notifications','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($notification,['route'=>['admin.notifications.update',$notification->id],'id'=>'notifications','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li >
                <div class="liLeft">公告标题：</div>
                <div class="liRight">
                    <?php echo Form::text('title',old('title'),['placeholder'=>'请填写公告标题']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">发送组：</div>
                <div class="liRight">
                    <?php $__currentLoopData = $userGrades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$userGrade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label for="<?php echo e($key); ?>">
                    <?php echo Form::checkbox('to_user[]',$key,old('to_user[]'),["class"=>'grades','id'=>$key]); ?>

                    <?php echo e($userGrade); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">指定用户：</div>
                <div class="liRight">
                    <?php echo Form::select('user[]',$users,old('user[]',$notification->to_user ?? []),["class"=>' select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">公告内容：</div>
                <div class="liRight">
                    <?php echo Form::textarea('content',old('content'),["class"=>'content','placeholder'=>'请填写公告内容']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>



