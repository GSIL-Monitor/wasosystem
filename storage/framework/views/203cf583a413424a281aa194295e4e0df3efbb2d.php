<dl>
    <dd>
        <div class="proBoxes">
            <ul>
                <?php $__currentLoopData = $storage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="pro_pic">
                            <a href="<?php echo e(route('server.index','storage')); ?>">
                                <h5><?php echo e($key); ?></h5>
                                <img src="<?php echo e(order_complete_machine_pic($item->first()->complete_machine_product_goods)); ?>">
                            </a>
                        </div>
                        <div class="proLinks">
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span>
                                                                      <a href="<?php if($item2->parent_id ==1 ): ?>
                                                                      <?php echo e(route('server.show',$item2->id)); ?>

                                                                      <?php else: ?>
                                                                      <?php echo e(route('server.designer',$item2->id)); ?>

                                                                      <?php endif; ?>">
                                                                          <?php echo e($item2->name); ?>

                                                                          <?php switch($item2->marketing):
                                                                              case ('new'): ?>
                                                                              <i class="saleIcon newP">新品</i>
                                                                              <?php break; ?>;
                                                                              <?php case ('hot'): ?>
                                                                              <i class="saleIcon hotP">热卖</i>
                                                                              <?php break; ?>;
                                                                              <?php case ('moods'): ?>
                                                                              <i class="saleIcon popP">人气</i>
                                                                              <?php break; ?>;
                                                                              <?php case ('sale'): ?>
                                                                              <i class="saleIcon saleP">折扣</i>
                                                                              <?php break; ?>;
                                                                          <?php endswitch; ?>
                                                                      </a>
                                                                  </span>
                                <?php if($loop->index == 4) break; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>
            <a href="<?php echo e(route('server.index','storage')); ?>" class="lookMore"><i></i>查看全部</a>
        </div>
    </dd>
    <div class="clear"></div>
</dl>