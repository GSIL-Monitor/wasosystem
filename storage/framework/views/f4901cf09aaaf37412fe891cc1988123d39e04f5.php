
<?php $__env->startSection('css'); ?>
    <style>
        .listTable tr td input {width: 60px; border:1px solid #ddd; line-height:25px;}
        .listTable tr td input[readonly]{background:none; border:none;}

        .listTable tr td i{display: inline-block; width:15px; height:15px; vertical-align: middle;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/js/goodPriceUpdate.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit updatePrices')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.product_goods.search',['url'=>route('admin.product_goods.updatePrices')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.updatePrices'),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="product_goods">
            <table class="listTable">

                <tr>
                    <th >序号</th>
                    <th class="tableInfoDel">产品型号</th>
                    <th class="tableMoreHide">销量</th>
                    <th class="tableMoreHide">新品</th>
                    <th class="tableMoreHide">良品</th>
                    <th class="tableMoreHide">坏货</th>
                    <th>零售价格</th>
                    <th>会员价格</th>
                    <th>合作价格</th>
                    <th>核心价格</th>
                    <th>成本价格</th>
                    <th>淘宝价格</th>
                    <th>价格浮动</th>
                    <th>更新时间</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php echo e($loop->iteration); ?>

                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><?php echo e($product_good->name); ?></td>
                        <td class="tableMoreHide">0</td>
                        <td class="tableMoreHide">0</td>
                        <td class="tableMoreHide">0</td>
                        <td class="tableMoreHide">0</td>
                        <?php $__currentLoopData = config('status.procuctGoodPrices'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key=='cost_price' || $key=='taobao_price'): ?>
                                <td><?php echo Form::number('edit['.$product_good->id.'][price->'.$key.']',old('edit['.$product_good->id.'][price->'.$key.']',$product_good->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'class'=>'checkNull cost_price','original_price'=>$product_good->price[$key],'data-id'=>$product_good->id,'id'=>$key.$product_good->id,'onkeyup'=>'this.value=(this.value>0)?this.value:0','original_price'=>$product_good->price[$key] ?? 0]); ?>   </td>
                            <?php else: ?>
                                <td><?php echo Form::number('edit['.$product_good->id.'][price->'.$key.']',old('edit['.$product_good->id.'][price->'.$key.']',$product_good->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key.$product_good->id]); ?>   </td>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td> <?php echo Form::hidden('edit['.$product_good->id.'][float]',old('edit['.$product_good->id.'][float]',$product_good->float),['readonly','class'=>'checkNull','id'=>'float'.$product_good->id]); ?>

                            <?php switch($product_good->float):
                                case ("come-up"): ?>
                               <i class="UP"></i>
                                <?php break; ?>
                                <?php case ("lower"): ?>
                                <i class="HOLD"></i>
                                <?php break; ?>
                                <?php default: ?>
                                <i class="DOWN"></i>
                            <?php endswitch; ?>
                        </td>
                        <td class=""><?php echo e($product_good->updated_at->diffForHumans()); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty">没有数据</div>
                <?php endif; ?>
            </table>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>