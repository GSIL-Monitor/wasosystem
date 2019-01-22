<div class="headBg"></div>
<div class="body ITEasy">
    <div class="big_bg big_bgActive">
        <div class="blackBG"></div>
        <div class="wrap">
            <div class="bgTXT">
                <img src="<?php echo e(asset('pic/IT/it_txt.png')); ?>">
                <p>可为非我司销售的产品或已无质保产品提供升级维护、服务支持！</p>
            </div>
            <div class="mobileBlack"></div>
        </div>
    </div>


    <div class="designAD">
        <div class="SJStxt1 txtCon picBg"></div>
    </div>


    <!-- 选择  -->
    <div class="disignDiy">
        <div class="serverBox txtCon">
            <div class="wrap">
                <h5 class="serverName">IT技术服务</h5>
                <?php $__currentLoopData = $it_outsourcings->groupBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h5 class="tit"><?php echo e($key); ?></h5>
                    <div class='UlBox'>
                        <ul>
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="liBox">
                                        <div class="liPic"><img src="<?php echo e(pic($item2->pic)[0]['url'] ?? ''); ?>"></div>
                                        <div class="induce">
                                            <div class="inducePage">
                                                <h5><?php echo e($item2->details['cooperation_types']); ?></h5>
                                                <p class="detail"><?php echo e($item2->details['description']); ?></p>
                                                <?php if(auth()->guard('user')->guest()): ?>
                                                          <?php $unit_price=$item2->price['retail_price'];   ?>
                                                    <?php else: ?>
                                                        <?php $unit_price=$item2->price[user()->grades->identifying];   ?>
                                                        <?php endif; ?>
                                                        <?php
                                                                 $product_base=!empty($item2->details['product_base']) ? $item2->details['product_base'] : 1;
                                                        ?>
                                                        <div class="priceBox">
                                                            <p>基数：<b><?php echo e($product_base); ?>台起</b></p>
                                                            <?php if(auth()->guard('user')->guest()): ?>
                                                                <p>更多请联系在线客服</p>
                                                                <p>&nbsp;</p>
                                                                <?php else: ?>

                                                                    <p>
                                                                        单价：<b><?php echo e($unit_price); ?><?php echo e($item2->details['tally']); ?></b>
                                                                    </p>
                                                                    <p>
                                                                        总价：<b><?php echo e($unit_price * $product_base); ?><?php echo e($item2->details['tally']); ?></b>
                                                                    </p>
                                                                    <?php endif; ?>
                                                        </div>
                                                        <button <?php if(auth()->guard('user')->guest()): ?>
                                                                onclick="location.href='<?php echo e(route('login')); ?>'"
                                                                <?php else: ?>
                                                                class="it_save"
                                                                data_title="<?php echo e($item2->details['cooperation_types']); ?>"
                                                                data_num="<?php echo e($item2->details['product_base']); ?>"
                                                                data_price="<?php echo e($unit_price); ?>"
                                                                data_total_price="<?php echo e($unit_price * $product_base); ?>"
                                                                data_url="<?php echo e(route('it_outsourcing.save',$item2->id)); ?>"
                                                                <?php endif; ?>
                                                        >意向保存
                                                        </button>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="clear"></div>
                        </ul>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>


        <?php $__currentLoopData = $its; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->iteration !=1): ?>
                <div class="serverBox serverBox2 txtCon"
                     data_phone="<?php echo e(asset('pic/IT/IT_page'.$loop->iteration.'_p.jpg')); ?>"
                     style="background-image:url(<?php echo e(asset('pic/IT/IT_page'.$loop->iteration.'.jpg')); ?>);">
                    <div class="wrap">
                        <div class="serverName">
                            <?php $details=explode('|',$it->description)?>
                            <?php echo e($it->name); ?>

                            <h5><?php echo e($details[3]); ?><?php echo e($details[4]); ?></h5>
                        </div>
                        <div class="sPage">
                            <div class="pageTxt">
                                <p><?php echo e($details[0]); ?></p>
                                <div class="contact"><?php echo e($details[1]); ?><?php echo e($details[2]); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>