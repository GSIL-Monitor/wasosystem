<div class="JJList">
    <ul class="maxUl" id="app" >
        <?php if(Route::is('admin.integration_categories.create')): ?>
            <?php echo Form::open(['route'=>'admin.integration_categories.store','method'=>'post','id'=>'integration_categories','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($integration_category,['route'=>['admin.integration_categories.update',$integration_category->id],'id'=>'integration_categories','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">分类名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入分类名称',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">分类图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            <?php if(Route::is('admin.integration_categories.create')): ?>
            defaultList: [],
            <?php else: ?>
            defaultList:<?php echo $integration_category->pic; ?>,
            <?php endif; ?>
            actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
            imageUrl: "<?php echo env('IMAGES_URL'); ?>",
            deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
            fileCount:1,
        },
        methods: {

        },
        mounted: function () {
        },
    });

</script>

