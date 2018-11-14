



<?php $__env->startSection('content'); ?>
    <?php $ProductParamenterPresenter = app('App\Presenters\ProductParamenterPresenter'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product_paramenters')): ?>
                    <button class="OneAdd Btn" data_title="参数值" data_parent_id="<?php echo e($productParamenter->id); ?>"
                            data_product_id="<?php echo e($productParamenter->product_id); ?>"
                            data_url="<?php echo e(route('admin.product_paramenters.store')); ?>">添加参数
                    </button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_paramenters')): ?>
                    <button class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_paramenters')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/product_paramenters/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

          <ul class="maxUl">
            <li class="sevenLi">
               <div class="liLeft">专有参数：</div>
               <div class="liRight">
                 <?php $ZDCanShus=$ProductParamenterPresenter->showCanShu($productParamenter);?>
                     <?php if(count($ZDCanShus) > 0): ?>
                        <?php $__currentLoopData = $ZDCanShus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zdchanshu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="canshuSpan"><?php echo e($zdchanshu); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                 <?php if(count($product_paramenters) > 0): ?>
               </div>
               <div class="clear"></div>
            </li>

            <li class="nineLi">
               <div class="liLeft">产品参数：</div>
               <div class="liRight">
               <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                   <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                   <input type="hidden" name="table" value="product_paramenters">
                   <table class="listTable">
                       <tr>
                           <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                           <th>排序</th>
                           <th class="tableInfoDel">参数名称</th>
                           <th>添加时间</th>
                           <th class="">修改时间</th>
                       </tr>
                       <?php $__currentLoopData = $product_paramenters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_paramenter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                               <td class="tableInfoDel"> <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product_paramenter->id); ?>"></td>
                               <td><input style="width:60px;" type="text" class="num" name="edit[<?php echo e($product_paramenter->id); ?>][order]" value="<?php echo e($product_paramenter->order); ?>"></td>
                               <td class="tableInfoDel  tablePhoneShow  tableName"><input style="width:40%;" type="text" name="edit[<?php echo e($product_paramenter->id); ?>][name]" value="<?php echo e($product_paramenter->name); ?>">
                                   <a class="alertWeb"  data_url="<?php echo e(route('admin.product_paramenters.edit',$product_paramenter->id)); ?>"><?php echo e($product_paramenter->name); ?></a>
                               </td>
                               <td class=""><?php echo e($product_paramenter->created_at->format('Y-m-d')); ?></td>
                               <td class=""><?php echo e($product_paramenter->updated_at->format('Y-m-d')); ?></td>
                           </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </table>
               </form>
               </div>
               <div class="clear"></div>
            </li>
          </ul>


            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>