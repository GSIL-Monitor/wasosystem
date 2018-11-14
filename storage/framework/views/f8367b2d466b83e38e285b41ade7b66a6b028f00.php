
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit inventory_managements')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
          'url'=>route('admin.inventory_managements.index'),
          'status'=>array_except(Request::all(),['keyword','_token'])
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.inventory_managements.index'),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="inventory_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">产品规格</th>
                    <th class="">库存数量</th>
                    <th class="">良品</th>
                    <th class="">坏货</th>
                    <th class="">返厂在途</th>
                    <th class="">代管</th>
                    <th class="">测试品</th>
                    <th class="">库存报警</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $inventory_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>

                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <?php echo e($inventory_management->product_good->name); ?>

                        </td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][new]" value="<?php echo e($inventory_management->new); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][good]" value="<?php echo e($inventory_management->good); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][bad]" value="<?php echo e($inventory_management->bad); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][return_factory]" value="<?php echo e($inventory_management->return_factory); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][proxies]" value="<?php echo e($inventory_management->proxies); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][test]" value="<?php echo e($inventory_management->test); ?>"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[<?php echo e($inventory_management->id); ?>][warning]" value="<?php echo e($inventory_management->warning); ?>"></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
             <?php echo e($inventory_managements->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>