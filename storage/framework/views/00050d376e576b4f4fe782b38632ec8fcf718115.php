
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create users')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.users.create')); ?>">添加会员</button>
                <?php endif; ?>

                <?php if(Request::has('source')): ?>
                    <button class="changeWebClose Btn">返回</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit users')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if($status!='VerifiedUser'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete users')): ?>
                        <button type="submit" class="red Btn AllDel" form="AllDel"
                                data_url="<?php echo e(url('/waso/users/destory')); ?>">删除
                        </button>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <?php if($status=='VerifiedUser'): ?>
                <?php echo $__env->make('admin.common._search',[
              'url'=>route('admin.users.index'),
              'status'=>array_except(Request::all(),['type','keyword','_token','page']),
              'condition'=>['username'=>'账号',
                    'nickname'=>'姓名',
                    'unit'=>'单位',
                    'phone'=>'电话'
                 ]
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.user'),'duiBiCanShu'=>$status,'url'=>route('admin.users.index'),'canshu'=>'status','link'=>Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="users">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                        <?php if(Request::has('source')): ?>
                        <th class="">需求</th>
                        <?php endif; ?>
                        <th class="tableInfoDel">账号</th>
                        <th class="">姓名</th>
                        <th class="">单位简称</th>
                        <th class="">默认单位</th>
                        <th class="">单位简码</th>
                        <th class="">配件选购</th>
                        <th class="">级别</th>
                        <th class="">账期(天)</th>
                        <th class="">管理员</th>
                        <th class="tableMoreHide">添加时间</th>
                        <th class="">最后登陆时间</th>
                        <th class="">操作</th>

                    </tr>

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $company=$user->user_company->firstWhere('default','=',1);
                        ?>
                        <tr>
                            <td class="tableInfoDel">
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($user->id); ?>">
                            </td>
                            <?php if(Request::has('source')): ?>
                                <td class=""><a class="changeWeb" data_url="<?php echo e(route('admin.demand_managements.create')); ?>?user_id=<?php echo e($user->id); ?>">添加</a></td>
                            <?php endif; ?>
                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                <a class="changeWeb " data_url="<?php echo e(route('admin.users.edit',$user->id)); ?>">
                                    <?php echo e($user->username); ?>

                                    <?php if($user->newUser()): ?>  <i class="newOrder"></i> <?php endif; ?>
                                </a>
                            </td>
                            <td><?php echo e($user->nickname); ?></td>
                            <td><?php echo e($user->unit); ?></td>
                            <td><?php echo e($company->name ?? ''); ?></td>
                            <td><?php echo e($company->unit_code ?? ''); ?></td>
                            <td>
                                <label for="<?php echo e('parts_buy'.$user->id); ?>">
                                    <?php echo e(Form::checkbox('edit['.$user->id.'][parts_buy]',$user->parts_buy,old('edit['.$user->id.'][parts_buy]',$user->parts_buy),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'parts_buy'.$user->id])); ?>

                                </label>
                            </td>
                            <td><?php echo e($user->grades->name); ?></td>
                            <td><?php echo e($user->payment_days); ?></td>
                            <td><?php echo e($user->admins->name ?? ''); ?></td>
                            <td class="tableMoreHide"><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                            <td><?php echo e($user->last_login_time); ?></td>
                            <td>
                                    <a class="changeWeb"
                                       data_url="<?php echo e(route('admin.user_addresses.index')); ?>?user_id=<?php echo e($user->id); ?>">物流</a>
                                    <a class="changeWeb"
                                       data_url="<?php echo e(route('admin.user_companies.index')); ?>?user_id=<?php echo e($user->id); ?>">单位</a>
                                    <a class="changeWeb"
                                       data_url="<?php echo e(route('admin.common_equipments.index')); ?>?user_id=<?php echo e($user->id); ?>">常用</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php echo e($users->appends(Request::except('page'))->links()); ?>


            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>