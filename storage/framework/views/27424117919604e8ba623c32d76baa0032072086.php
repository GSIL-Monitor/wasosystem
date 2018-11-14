
<?php $__env->startSection('content'); ?>
    <?php $ProductParamenterPresenter = app('App\Presenters\ProductParamenterPresenter'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product_paramenters')): ?>
                    <button class="alertWeb Btn" data_url="<?php echo e(route('admin.product_paramenters.create')); ?>?product_id=<?php echo e($product_id); ?>">添加参数</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_paramenters')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_paramenters')): ?>

                    <button  class="red Btn AllDel"
                            data_url="<?php echo e(url('/waso/product_paramenters/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_paramenters.index'),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="product_paramenters">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>排序</th>
                    <th class="tableInfoDel">参数名称</th>
                    <th class="">参数单位</th>
                    <th class="">前台/后台（显示）</th>
                    <th class="">参数值</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="tableInfoDel">操作</th>
                </tr>
                <?php $__currentLoopData = $product_paramenters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_paramenter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product_paramenter->id); ?>">
                        </td>
                        <td><input type="text" style="width:60px;" name="edit[<?php echo e($product_paramenter->id); ?>][order]" value="<?php echo e($product_paramenter->order); ?>"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[<?php echo e($product_paramenter->id); ?>][name]"
                                                                                   value="<?php echo e($product_paramenter->name); ?>">
                            <a class="alertWeb" data_url="<?php echo e(route('admin.product_paramenters.edit',$product_paramenter->id)); ?>"><?php echo e($product_paramenter->name); ?></a>
                        </td>
                        <td><input type="text"  name="edit[<?php echo e($product_paramenter->id); ?>][danwei]"
                                   value="<?php echo e($product_paramenter->danwei); ?>"></td>
                        <td class="">
                            <label for="qiantai_show<?php echo e($product_paramenter->id); ?>"><?php echo e(Form::checkbox('edit['.$product_paramenter->id.'][qiantai_show]',$product_paramenter->qiantai_show,old('edit['.$product_paramenter->id.'][qiantai_show]',$product_paramenter->qiantai_show),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'qiantai_show'.$product_paramenter->id])); ?>前台显示</label>/
                            <label for="admin_show<?php echo e($product_paramenter->id); ?>"><?php echo e(Form::checkbox('edit['.$product_paramenter->id.'][admin_show]',$product_paramenter->admin_show,old('edit['.$product_paramenter->id.'][admin_show]',$product_paramenter->admin_show),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'admin_show'.$product_paramenter->id])); ?>后台显示</label>
                        </td>
                        <td>
                            <?php echo e(config('status.procuctParamentselectShow')[$product_paramenter->type]); ?>

                            <?php $ZDCanShu=$ProductParamenterPresenter->showCanShu($product_paramenter);?>
                            <?php if(count($ZDCanShu) > 0): ?>
                                
                                <?php echo e(Form::select('',$ZDCanShu,null,['class'=>'select2'])); ?>

                            <?php endif; ?>
                        </td>
                        <td class="tableMoreHide"><?php echo e($product_paramenter->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($product_paramenter->updated_at->format('Y-m-d')); ?></td>
                        <td><a class="alertWeb" data_url="<?php echo e(route('admin.product_paramenters.show',$product_paramenter->id)); ?>">添加参数值</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>