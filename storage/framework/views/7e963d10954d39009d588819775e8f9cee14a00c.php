
<?php $__env->startSection('title',$job->field['position']); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/job.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div id="crumbs"><div class="wrap">当前位置：<a href="<?php echo e(route('job.index')); ?>">网烁招聘</a> ><?php echo e($job->field['position']); ?></div></div>

        <div class="wrap">
            <div class="job_contact">
                <h5 class="jobName"><?php echo e($job->field['position']); ?></h5>

                <ul class="jobType">
                    <li>职位类别：<?php echo e($job->field['position_type']); ?></li>
                    <li>工作地点：<?php echo e($job->field['workplace']); ?></li>
                    <li>招聘人数：<?php echo e($job->field['recruiting_numbers']); ?>人</li>
                    <div class="clear"></div>
                </ul>

                <div class="jobCon"><?php echo $job->field['job_description']; ?> </div>

                <div class="prep"><a href="<?php echo e(route('job.index')); ?>">返回列表</a></div>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>