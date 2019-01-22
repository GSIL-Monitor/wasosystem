
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create complete_machines')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.complete_machines.create')); ?>?parent_id=<?php echo e($parent_id); ?>">添加<?php echo e($parent_parameters[$parent_id]); ?></button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complete_machines')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete complete_machines')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/complete_machines/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.complete_machines.search',['url'=>route('admin.complete_machines.index')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>array_only($parent_parameters,[1,2]),'duiBiCanShu'=>$parent_id,'url'=>route('admin.complete_machines.index'),'canshu'=>'parent_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="complete_machines">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">产品型号</th>
                    <th class="">单页描述</th>
                    <th class="">架构</th>
                    <th class="">展示 / 推荐</th>
                    <th class="">营销</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                </tr>

                <?php $__currentLoopData = $complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($complete_machine->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.complete_machines.edit',$complete_machine->id)); ?>?parent_id=<?php echo e($parent_id); ?>"><?php echo e($complete_machine->name); ?></a>
                        </td>
                        <td class=""><?php echo e($complete_machine->additional_arguments['page_description']); ?></td>
                        <td class=""><?php echo e(implode(',',array_filter_empty($complete_machine->jiagou))); ?></td>
                        <td class="">
                            <label for="show<?php echo e($complete_machine->id); ?>">
                                <?php echo e(Form::checkbox('edit['.$complete_machine->id.'][status->show]',$complete_machine->status['show'],old('edit['.$complete_machine->id.'][status->show]',$complete_machine->status['show']),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'show'.$complete_machine->id])); ?>

                                展示</label>
                            <label for="recommend<?php echo e($complete_machine->id); ?>">
                                <?php echo e(Form::checkbox('edit['.$complete_machine->id.'][status->recommend]',$complete_machine->status['recommend'],old('edit['.$complete_machine->id.'][status->recommend]',$complete_machine->status['recommend']),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'recommend'.$complete_machine->id])); ?>

                                推荐</label>
                        <td class="">
                            <?php $__currentLoopData = config('status.complete_machine_marketing'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="marketing<?php echo e($complete_machine->id.$key); ?>">
                                    <?php if($key==$complete_machine->marketing): ?>
                                    <?php echo e(Form::radio('edit['.$complete_machine->id.'][marketing]',$key,old('edit['.$complete_machine->id.'][marketing]',true),['id'=>'marketing'.$complete_machine->id.$key])); ?>

                                   <?php else: ?>
                                        <?php echo e(Form::radio('edit['.$complete_machine->id.'][marketing]',$key,old('edit['.$complete_machine->id.'][marketing]',false),['id'=>'marketing'.$complete_machine->id.$key])); ?>

                                    <?php endif; ?>
                                    <?php echo e($status); ?></label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <th class="tableMoreHide"><?php echo e($complete_machine->created_at->format('Y-m-d')); ?></th>
                        <td class=""><?php echo e($complete_machine->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
             <?php echo e($complete_machines->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>