<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>常用配置</h5>
                    </div>

                    <div class="RefreshBtn">
                        <a class="Refresh common_update" form_id="AllEdit"><i></i>更新价格</a>
                        <form action="<?php echo e(route('common_equipments.update_prices')); ?>" method="post" id="AllEdit" onsubmit="return false">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        </form>
                    </div>

                    <ul class="PZList">
                      <?php $__empty_1 = true; $__currentLoopData = $common_equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $common_equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <div class="PZTable">
                                    <div class="PZInfo">
                                        <div class="infoT">
                                            <h5 class="PZName"><a href="<?php echo e(route('common_equipments.edit',$common_equipment->id)); ?>"><?php echo e($common_equipment->name); ?></a></h5><input class="PZNameInput" type="text" value="<?php echo e($common_equipment->name); ?>">
                                            <h5 class="PZTime"><?php echo e($common_equipment->updated_at->format('Y-m-d')); ?></h5>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="infoL">
                                            <h5 class="PZType">
                                                <span>
                                                 <?php if($common_equipment->order_type == 'designer_computer' ): ?>
                                                     <?php switch($common_equipment->machine_model):
                                                             case (starts_with($common_equipment->machine_model,'ND7')): ?>
                                                                ND7000系列
                                                             <?php break; ?>;
                                                            <?php case (starts_with($common_equipment->machine_model,'ND8')): ?>
                                                            ND8000系列
                                                            <?php break; ?>;
                                                            <?php case (starts_with($common_equipment->machine_model,'ND9')): ?>
                                                            ND9000系列
                                                            <?php break; ?>;
                                                            <?php case (starts_with($common_equipment->machine_model,'NP')): ?>
                                                            办公电脑系列
                                                            <?php break; ?>;
                                                            <?php case (starts_with($common_equipment->machine_model,'NW')): ?>
                                                            图形工作站
                                                            <?php break; ?>;
                                                     <?php endswitch; ?>
                                                     <?php else: ?>
                                                        <?php echo e($parameters['order_type'][$common_equipment->order_type]); ?>

                                                     <?php endif; ?>

                                                </span>
                                                <span class="PZCode">（<?php echo e($common_equipment->machine_model); ?> ）</span>
                                            </h5>
                                        </div>

                                        <div class="infoR">

                                            <h5 class="PZPrice">
                                                <em></em>
                                                <?php if($common_equipment->total_prices > $common_equipment->old_prices): ?>
                                                <img src="<?php echo e(asset('pic/upPrice.png')); ?>">
                                                <?php elseif($common_equipment->total_prices < $common_equipment->old_prices): ?>
                                                <img src="<?php echo e(asset('pic/downPrice.png')); ?>">
                                                <?php endif; ?>
                                                <?php echo e($common_equipment->total_prices); ?>.00元</h5>
                                            <h5 class="PZPrice PZOldPrice"><em>更新前：</em><?php echo e($common_equipment->old_prices); ?>.00元</h5>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="PZBtn">
                                        <span class="edit" >修改配置名</span>
                                        <a class="Del" data_title="<?php echo e($common_equipment->name); ?>" data_id="<?php echo e($common_equipment->id); ?>" data_url="<?php echo e(url('common_equipments/destroy')); ?>">删除</a>
                                        <a class="place_an_order" href="javascript:void(0)" data_url="<?php echo e(route('common_equipments.update',$common_equipment->id)); ?>" data_title="确定将（<?php echo e($common_equipment->name); ?>）这个配置下单吗?">意向下单</a>
                                        <a class="lookInfo" href="<?php echo e(route('common_equipments.edit',$common_equipment->id)); ?>">配置详情</a>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="PZEditBtn">
                                        <span class="sure" data_url="<?php echo e(route('common_equipments.update',$common_equipment->id)); ?>">确定</span>
                                        <span class="cancel">取消</span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <li>没有常用配置</li>
                     <?php endif; ?>
                        <div class="clear"></div>
                    </ul>


                </div>
                <div id="page">
                    <?php echo e($common_equipments->links()); ?>

                </div>
            </div>
