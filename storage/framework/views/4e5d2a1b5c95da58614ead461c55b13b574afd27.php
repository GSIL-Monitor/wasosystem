
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create menus')): ?>
                <button class="alertWeb Btn" data_url="<?php echo e(route('admin.menus.create')); ?>?parent_id=0">添加菜单</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit menus')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete menus')): ?>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="<?php echo e(url('/waso/menus/destory')); ?>">删除</button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
            <div class="clear"></div>
        </div>

        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.menus_cats'),'duiBiCanShu'=>$cat,'url'=>route('admin.menus.index'),'canshu'=>'cat'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(count($menus) > 0): ?>
           <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
            <table class="listTable" id="sort">
                <thead>
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>栏目</th>
                    <th>排序</th>
                    <th class="tableInfoDel">菜单名称</th>
                    <th class="">菜单简称</th>
                    <th class="">菜单链接</th>
                    <th>添加时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="table" value="menus">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($menu->id); ?>"></td>
                        <td><?php echo e(config('status.menus_cats')[$menu->cats]); ?></td>
                        <td><input type="text" value="<?php echo e($menu->order); ?>" name="edit[<?php echo e($menu->id); ?>][order]"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="<?php echo e(route('admin.menus.edit',$menu->id)); ?>"><?php echo e($menu->name); ?></a></td>
                        <td><?php echo e($menu->sulg); ?></td>
                        <td><?php echo e($menu->url); ?></td>
                        <td><?php echo e($menu->created_at->format('Y-m-d')); ?></td>
                        <td><?php echo e($menu->updated_at->format('Y-m-d')); ?></td>
                        <td><a data_url="<?php echo e(route('admin.menus.create')); ?>?parent_id=<?php echo e($menu->id); ?>&cats=<?php echo e($menu->cats); ?>" class="alertWeb">添加下级</a></td>
                    </tr>
                     <?php $childMenus=$menu->childMenus;?>
                      <?php if(count($childMenus) >0): ?>
                        <?php $__currentLoopData = $childMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($childMenu->id); ?>"></td>
                                <td><?php echo e(config('status.menus_cats')[$childMenu->cats]); ?></td>
                                <td><input type="text" value="<?php echo e($childMenu->order); ?>" name="edit[<?php echo e($childMenu->id); ?>][order]"></td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">&nbsp;&nbsp;&nbsp;<a class="alertWeb" data_url="<?php echo e(route('admin.menus.edit',$childMenu->id)); ?>"><?php echo e($childMenu->name); ?></a></td>
                                <td><?php echo e($childMenu->sulg); ?></td>
                                <td><?php echo e($childMenu->url); ?></td>
                                <td><?php echo e($childMenu->created_at->format('Y-m-d')); ?></td>
                                <td><?php echo e($childMenu->updated_at->format('Y-m-d')); ?></td>
                                <td>--</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
           </form>
            <?php echo e($menus->links()); ?>

                <?php else: ?>
                <div class="empty">没有数据</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>