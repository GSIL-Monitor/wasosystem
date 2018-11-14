
<?php $__env->startSection('title','密码修改'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/pwd.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="right">
        <div class="info">
            <div class="tit bigTit">
                <h5>修改密码</h5>
                <p>定期修改密码可以有效的防止陌生人盗取您的帐号，保证您的账户安全。</p>
            </div>
            <div class="safe">
                <?php echo Form::model($user,['route'=>['personal_details.update',$user->id],'id'=>'personal_details','method'=>'put','onsubmit'=>'return false']); ?>


                <ul>
                    <li>
                        <span class="tit">原密码：</span>
                        <span class="con">
                                          <div class="liRight">
                                                   <?php echo Form::text('old_password',old('old_password'),['placeholder'=>'请输入旧密码','class'=>'checkNull']); ?>

                                         </div>
                                    </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="tit">新密码：</span>
                        <span class="con">
                                        <div class="liRight">
                                            <input type="text" name="password" value="<?php echo e(old('password')); ?>"
                                                   placeholder="6-20位数字、英文" class="checkNull">
                                            </div>

                                </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="tit">再次确认：</span>
                        <span class="con">
                                                <div class="liRight">
                                        <?php echo Form::text('password_confirmation',old('password_confirmation'),['placeholder'=>'6-20位数字、英文','class'=>'checkNull']); ?>

                                                </div>

                                </span>
                        <div class="clear"></div>
                    </li>
                    <li class="check_info_box"><p></p></li>
                </ul>
                <?php echo Form::close(); ?>

                <button class=" common_add" form_id="personal_details">修改</button>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>