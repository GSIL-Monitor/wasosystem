
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create information_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.information_managements.create')); ?>?type=<?php echo e($type); ?>">添加<?php echo e(config('status.information_managements_type')[$type]); ?></button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit information_managements')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete information_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/information_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
           'url'=>route('admin.information_managements.index'),
           'status'=>array_except(Request::all(),['keyword','_token']),
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.information_managements_type'),'duiBiCanShu'=>$type,'url'=>route('admin.information_managements.index'),'canshu'=>'type'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="information_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">展示</th>
                    <th class="">标签</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $information_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $information_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($information_management->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.information_managements.edit',$information_management->id)); ?>"><?php echo e($information_management->name); ?></a>
                        </td>
                        <td class="">
                            <label for="show<?php echo e($information_management->id); ?>">
                                <?php echo e(Form::checkbox('edit['.$information_management->id.'][marketing->show]',$information_management->marketing['show'],old('edit['.$information_management->id.'][marketing->show]',$information_management->marketing['show']),['class'=>'radio','id'=>'show'.$information_management->id])); ?>

                                展示</label>
                        </td>
                        <td class="">
                            <?php $__currentLoopData = config('status.information_management_marketing'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="marketing<?php echo e($information_management->id.$key); ?>">
                                        <?php echo e(Form::checkbox('edit['.$information_management->id.'][marketing->'.$key.']',$information_management->marketing[$key],old('edit['.$information_management->id.'][marketing->'.$key.']',$information_management->marketing[$key]),['class'=>'radio','id'=>'marketing'.$information_management->id.$key])); ?>

                                    <?php echo e($status); ?></label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="tableMoreHide"><?php echo e($information_management->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($information_management->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
                <?php echo e($information_managements->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>