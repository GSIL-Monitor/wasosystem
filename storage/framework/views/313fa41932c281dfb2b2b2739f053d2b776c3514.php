<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(!optional($business_management)->id): ?>
            <?php echo Form::open(['route'=>'admin.business_managements.store','method'=>'post','id'=>'business_managements','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($business_management,['route'=>['admin.business_managements.update',$business_management->id],'id'=>'business_managements','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <?php switch(Request::get('type')):
                case ('honor'): ?>
                <?php echo $__env->make('admin.business_managements.form.honor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>
                <?php case ('job'): ?>
                <?php echo $__env->make('admin.business_managements.form.job', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>
                <?php case ('service_directory'): ?>
                <?php echo $__env->make('admin.business_managements.form.service_directory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>
                <?php case ('banner'): ?>
                <?php echo $__env->make('admin.business_managements.form.banner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>
                <?php case ('friend'): ?>
                <?php echo $__env->make('admin.business_managements.form.friend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>
                <?php default: ?>
                <?php echo e(Request::get('type')); ?>

            <?php endswitch; ?>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            <?php if(!optional($business_management)->id): ?>
            defaultList: [],
            <?php else: ?>
            defaultList:<?php echo $business_management->pic; ?>,
            <?php endif; ?>
            actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
            imageUrl: "<?php echo env('IMAGES_URL'); ?>",
            deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
            fileCount:2,
        },
        methods: {

        },
        mounted: function () {
        },
    });

</script>


