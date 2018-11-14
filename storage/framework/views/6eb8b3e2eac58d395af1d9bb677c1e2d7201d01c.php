<div class="body">
    <div id="crumbs">
        <div class="wrap"><a href="/">首页</a> > 加入我们</div>
    </div>

    <div class="big_pic"><div class="wrap"><img src="<?php echo e(asset('pic/job_bg.jpg')); ?>"></div></div>


    <div class="wrap">
        <div class="jobBox">
            <dl class="job_type">
                <dt>职位类别：</dt>
                <dd>
                    <ul>
                        <li  class="<?php if(!request()->has('type')): ?> li2  <?php endif; ?>"><a href="<?php echo e(route('job.index')); ?>">全部</a></li>
                        <?php $__currentLoopData = config('status.job_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="<?php if(request()->has('type') && request()->get('type') == $key): ?> li2  <?php endif; ?>"><a href="<?php echo e(route('job.index')); ?>?type=<?php echo e($key); ?>"><?php echo e($item); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="clear"></div>
                    </ul>
                </dd>

            </dl>

            <dl class="jobs">
                <dt>
                    <span class="name">职位名称</span>
                    <span class="type">职位类别</span>
                    <span class="addr">工作地点</span>
                    <span class="num">招聘人数</span>
                    <span class="time">发布时间</span>
                    <div class="clear"></div>
                </dt>

                <?php if($jobs->isEmpty()): ?>
                    <dd>
                        <span >没有招聘信息！</span>
                    </dd>
                <?php else: ?>
               <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <dd class="<?php if($job->field['over']): ?> del_through <?php endif; ?>">
                        <a href="<?php if($job->field['over']): ?> javascript:void(0) <?php else: ?> <?php echo e(route('job.show',$job->id)); ?>  <?php endif; ?>">
                            <span class="name" ><?php echo e($job->field['position']); ?></span>
                            <div class="phoneBox">
                                <span class="type"><?php echo e($job->field['position_type']); ?></span>
                                <span class="addr"><?php echo e($job->field['workplace']); ?></span>
                                <span class="num"><?php echo e($job->field['recruiting_numbers']); ?>人</span>
                            </div>
                            <span class="time">
                                 <?php echo e($job->created_at->format('Y-m-d')); ?>

                             </span>
                            <div class="clear"></div>
                        </a>
                    </dd>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

            </dl>
        </div>
    </div>
</div>
</div>