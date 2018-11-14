<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.product_frameworks.create')): ?>
            <?php echo Form::open(['route'=>'admin.product_frameworks.store','method'=>'post','id'=>'product_frameworks']); ?>

        <?php else: ?>
            <?php echo Form::model($productFramework,['route'=>['admin.product_frameworks.update',$productFramework->id],'id'=>'product_frameworks','method'=>'put']); ?>

        <?php endif; ?>
        <li>
                <div class="liLeft">添加驱动：</div>
                <div class="liRight">
                    <upload-files :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-files>
                </div>
                <div class="clear"></div>
        </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>

</div>
<form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" name="table" value="product_drives">
    <table class="listTable">
        <tr>
            <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
            <th class="tableInfoDel">驱动名称</th>
            <th class="tableInfoDel">驱动链接</th>
            <th class="tableMoreHide">添加时间</th>
            <th class="">修改时间</th>
        </tr>
        <?php $__currentLoopData = $drives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="tableInfoDel">
                    <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($drive->id); ?>">
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName">
                    <input type="text" name="edit[<?php echo e($drive->id); ?>][file->name]"
                           value="<?php echo e($drive->file['name']); ?>">
                </td>
                <td class="tableInfoDel ">
                    <input type="text" name="edit[<?php echo e($drive->id); ?>][file->url]"
                           value="<?php echo e($drive->file['url']); ?>">
                </td>
                <td class="tableMoreHide"><?php echo e($drive->created_at->format('Y-m-d')); ?></td>
                <td class=""><?php echo e($drive->updated_at->format('Y-m-d')); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</form>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            defaultList: [],
            actionImageUrl: "<?php echo env('ActionFileUrl'); ?>",
            imageUrl: "<?php echo env('IMAGES_URL'); ?>",
            deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
            fileCount:5,
        },
        methods: {

        },
        mounted: function () {

        },
    });
</script>

