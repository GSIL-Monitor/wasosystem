
<?php $DivisionalManagementParamenter = app('App\Presenters\DivisionalManagementParamenter'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create divisional_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.task_managements.index')); ?>?type">任务列表</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete divisional_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/divisional_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <?php if(request()->has('type')): ?>
                    <button class="changeWebClose Btn">返回</button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="divisional_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">对象</th>
                    <th class="">模式</th>
                    <th class="">目标任务(万)</th>
                    <th class="">保底任务(万)</th>
                    <th class="">奖励系数(%)</th>
                    <th  class="tableMoreHide">目标阶段二(万)</th>
                    <th  class="tableMoreHide">奖励系数二(%)</th>
                    <th  class="tableMoreHide">目标阶段三(万)</th>
                    <th  class="tableMoreHide">奖励系数三(%)</th>
                    <th class="">单位指标(万)</th>
                    <th class="">处罚指标(元)</th>
                    <th class="">奖励标准(元)</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
                </tr>
                  <?php $__currentLoopData = $divisional_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('admin.divisional_managements.child',['management'=>$management,'level'=>0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php if($management->allChildrens->isNotEmpty()): ?>
                        <?php $__currentLoopData = $management->allChildrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('admin.divisional_managements.child',['management'=>$department,'level'=>1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php if($department->allChildrens->isNotEmpty()): ?>
                                <?php $__currentLoopData = $department->allChildrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('admin.divisional_managements.child',['management'=>$group,'level'=>2], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php if($group->allChildrens->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $group->allChildrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $__env->make('admin.divisional_managements.child',['management'=>$member,'level'=>3], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </table>
            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>