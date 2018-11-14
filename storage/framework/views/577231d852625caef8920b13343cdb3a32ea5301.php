
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_frameworks')): ?>
                    <button type="submit" class="Btn common_add" form_id="product_frameworks"
                            location="top">上传/修改</button>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_frameworks')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/product_drives/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <ul class="maxUl" id="app">
                    <?php echo Form::model($productGood,['route'=>['admin.product_goods.drive_add',$productGood->id],'id'=>'product_frameworks','method'=>'put']); ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $productGood->series->drive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $framework_drive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="tableInfoDel">
                              --
                            </td>
                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                <?php echo e($framework_drive->file['name']); ?>

                            </td>
                            <td class="tableInfoDel ">
                                <?php echo e($framework_drive->file['url']); ?>

                            </td>
                            <td class="tableMoreHide"><?php echo e($framework_drive->created_at->format('Y-m-d')); ?></td>
                            <td class=""><?php echo e($framework_drive->updated_at->format('Y-m-d')); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
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


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>