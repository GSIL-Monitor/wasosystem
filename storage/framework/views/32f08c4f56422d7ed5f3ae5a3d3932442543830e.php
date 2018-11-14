<div class="type_box">
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $pics=order_complete_machine_pic($server->complete_machine_product_goods,'all');?>
            <li>
                <?php switch($server->marketing):
                    case ('new'): ?>
                    <i class="saleIcon newP"></i>
                    <?php break; ?>;
                    <?php case ('hot'): ?>
                    <i class="saleIcon hotP"></i>
                    <?php break; ?>;
                    <?php case ('moods'): ?>
                    <i class="saleIcon popP"></i>
                    <?php break; ?>;
                    <?php case ('sale'): ?>
                    <i class="saleIcon saleP"></i>
                    <?php break; ?>;
                <?php endswitch; ?>
                <a href="<?php if($server->parent_id ==1 ): ?>
                <?php echo e(route('server.show',$server->id)); ?>

                <?php else: ?>
                <?php echo e(route('server.designer',$server->id)); ?>

                <?php endif; ?>">
                    <img  data-original="<?php echo e($pics[0]['url'] ?? ''); ?>" class="topPic lazy">
                    <img  data-original="<?php echo e($pics[1]['url'] ?? ''); ?>" class="botPic lazy">
                </a>
                <div class="txt">
                    <h3>网烁<?php echo e(explode('-',$server->name)[0]); ?><b>基础配置 </b></h3>
                    <p><?php echo e($server->additional_arguments['product_description']); ?></p>
                    <h5 class="price"></h5>
                </div>

                <div class="proEasy">

                            <span class="colBtn

                                <?php if(!empty(user()) && $falg=user()->favoriteCompleteMachines->pluck('id','name')->contains($server->id)): ?>
                                    colDel
                                <?php else: ?>
                                    colAdd
                                <?php endif; ?> ">
                             
                                <?php if(!empty(user()) && $falg): ?>
                                    <i></i><em data_url="<?php echo e(route('server.collectRemove',$server->id)); ?>">取消收藏</em>
                                <?php else: ?>
                                    <i></i><em data_url="<?php echo e(route('server.collect',$server->id)); ?>">添加收藏</em>
                                <?php endif; ?>
                            </span>
                    <span class="ComBtn    <?php if(array_has(session()->get('complete_machines'),[$server->id])): ?>
                            comDel
<?php else: ?>
                            comAdd
<?php endif; ?>">
                          <?php if(array_has(session()->get('complete_machines'),[$server->id])): ?>
                            <em data_url="<?php echo e(route('server.comparisonRemove',$server->id)); ?>">取消对比</em><i></i>
                        <?php else: ?>
                            <em data_url="<?php echo e(route('server.comparison',$server->id)); ?>">加入对比</em><i></i>
                        <?php endif; ?>
                    </span>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            暂时没有产品
        <?php endif; ?>
        <div class="clear"></div>
    </ul>
</div>


