<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.videos.create')): ?>
            <?php echo Form::open(['route'=>'admin.videos.store','method'=>'post','id'=>'videos','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($video,['route'=>['admin.videos.update',$video->id],'id'=>'videos','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">视频名：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'视频名',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">跳转链接：</div>
                <div class="liRight">
                    <?php echo Form::text('url',old('url'),['placeholder'=>'跳转链接',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">整机分类：</div>
                <div class="liRight">
                    <?php echo Form::select('complete_category[]',$complete_categorys,old('complete_category[]'),["class"=>'checkNull select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">整机产品：</div>
                <div class="liRight">
                    <?php echo Form::select('complete_machine[]',$complete_machines,old('complete_machine[]'),["class"=>'checkNull select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">添加视频：</div>
                <div class="liRight">
                    <upload-files :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-files>
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
            defaultList: [],
            <?php if(!Route::is('admin.videos.create')): ?>
                    defaultList: <?php echo json_encode($video->mp4,true); ?>,
            <?php endif; ?>
            actionImageUrl: "<?php echo env('ActionFileUrl'); ?>",
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

