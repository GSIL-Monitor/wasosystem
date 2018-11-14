<li>
    <?php echo e($index); ?>

    <div class="pro_pic">
        <?php if($index ==0): ?>
            <a href="">
                <h5><?php echo e($complete_machine->jiagou['tong_yong_fu_wu_qi']); ?></h5>
                <img src="<?php echo e(asset('pic/head/P_bangong.png')); ?>">
            </a>
        <?php endif; ?>
    </div>
    <div class="proLinks">
        <?php if($index <= 4): ?>
            <span>
                                                                      <a href="">
                                                                     <?php echo e($complete_machine->name); ?>1111
                                                                          <?php switch($complete_machine->marketing):
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
        <?php endif; ?>
    </div>
</li>