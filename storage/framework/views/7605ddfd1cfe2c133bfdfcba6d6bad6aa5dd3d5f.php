
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create visitor_details')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.visitor_details.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if($valid=='no'): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete visitor_details')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/visitor_details/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
            'url'=>route('admin.visitor_details.index'),
            'status'=>['valid'=>$valid],
            'condition'=>[
                'source'=>'来源',
                'nickname'=>'姓名',
                'phone'=>'电话',
                'email'=>'邮箱',
            ]
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.visitor_details_valid'),'duiBiCanShu'=>$valid,'url'=>route('admin.visitor_details.index'),'canshu'=>'valid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="visitor_details">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">访问时间</th>
                    <th  class="">来源</th>
                    <th  class="">姓名</th>
                    <th class="tableMoreHide">联系方式</th>
                    <th  class="tableMoreHide">位置</th>
                    <th  class="">成交情况</th>
                    <th  class="">搜索词</th>
                    <th  class="">关键词</th>
                    <th  class="">联系次数</th>
                    <th  class="">有效沟通</th>
                    <th  class="">值班客服</th>
                    <th  class="">是否会员</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $visitor_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visitor_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>
                        <td class="tableInfoDel">
                            <?php if($valid=='yes'): ?>
                                --
                                <?php else: ?>
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($visitor_detail->id); ?>">
                            <?php endif; ?>
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb "
                                                                               data_url="<?php echo e(route('admin.visitor_details.edit',$visitor_detail->id)); ?>"><?php echo e($visitor_detail->created_at); ?>

                            <?php if($visitor_detail->created_at==$visitor_detail->updated_at): ?>
                                    <i class="newOrder"></i>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td><?php echo e($visitor_detail->source); ?></td>
                        <?php if($visitor_detail->user_id): ?>
                        <td><?php echo e($visitor_detail->user->username ?? ''); ?> <?php echo e($visitor_detail->nickname ?? $visitor_detail->user->nickname ?? ''); ?> </td>
                        <td class="tableMoreHide"><?php echo e($visitor_detail->contact ?? $visitor_detail->user->contact ?? ''); ?></td>
                            <td class="tableMoreHide"><?php echo e($visitor_detail->address ?? $visitor_detail->user->address ?? ''); ?></td>
                          <td><?php echo e(isset($visitor_detail->user->deal) && $visitor_detail->user->deal==1? '已成交':'未成交'); ?></td>
                        <?php else: ?>
                            <td><?php echo e($visitor_detail->nickname); ?></td>
                            <td class="tableMoreHide"><?php echo e($visitor_detail->contact); ?></td>
                            <td class="tableMoreHide"><?php echo e($visitor_detail->address); ?></td>
                            <td>未成交</td>
                        <?php endif; ?>
                        <td><?php echo e($visitor_detail->search); ?></td>
                        <td><?php echo e($visitor_detail->key); ?></td>
                        <td><?php echo e(config('status.visitor_details_contact_count')[$visitor_detail->contact_count]); ?></td>
                        <td><?php echo e(config('status.visitor_details_valid')[$visitor_detail->valid]); ?></td>
                        <td><?php echo e($visitor_detail->admin_name->name ?? ''); ?> </td>
                        <td><?php echo $parameters['grades'][$visitor_detail->user->grade ?? ''] ?? '<span class="redWord" >非会员</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
               <?php echo e($visitor_details->links('vendor.pagination.bootstrap-4',['data'=>'&valid='.$valid])); ?>


            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>