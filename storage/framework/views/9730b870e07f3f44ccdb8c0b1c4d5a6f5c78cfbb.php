<?php $complete_machine_paramenter = app('App\Presenters\CompleteMachineParamenter'); ?>

<div class="detail" name="detail">
    <div class="wrap">
        <h6 class="tit">相关参数</h6>
        <div class="detail_info">
            <dl>
                <dd><span class="infoT">产品型号</span><span
                            class="infoC">网烁<?php echo e(str_before($completeMachine->name,'-')); ?>

                        基础配置</span>
                    <div class="clear"></div>
                </dd>
                <dd><span class="infoT">产品类别</span><span class="infoC"><?php echo e($parent->name); ?></span>
                    <div class="clear"></div>
                </dd>
                <dd><span class="infoT">外形规格</span><span class="infoC"><?php echo e($completeMachine->additional_arguments['mm']); ?></span>
                    <div class="clear"></div>
                </dd>
                <dd><span class="infoT">更新时间</span><span class="infoC"><?php echo e($completeMachine->updated_at->format('Y-m-d')); ?></span>
                    <div class="clear"></div>
                </dd>
                <?php $__currentLoopData = $complete_machine_paramenter->material_detail($completeMachine,'one'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $comparison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty(implode('',$comparison))): ?>
                        <dd><span class="infoT"><?php echo e($key); ?></span><span class="infoC"><?php echo e(implode('',$comparison)); ?></span>
                            <div class="clear"></div>
                        </dd>
                          <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <dd><span class="infoT">温馨提示</span><span class="infoC"><em style="color: red">*以上内容仅供参考，不构成任何约束和承诺，详情及价格请联系客服！</em></span>
                    <div class="clear"></div>
                </dd>
            </dl>
        </div>
    </div>
</div>