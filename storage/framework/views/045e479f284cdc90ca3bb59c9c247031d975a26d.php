<div class="JJList">
    <ul class="maxUl" >
        <?php if(Route::is('admin.integrations.create')): ?>
            <?php echo Form::open(['route'=>'admin.integrations.store','method'=>'post','id'=>'integrations','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($integration,['route'=>['admin.integrations.update',$integration->id],'id'=>'integrations','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">所属分类：</div>
                <div class="liRight">
                    <?php echo Form::select('parent_id',$category,old('parent_id'),['placeholder'=>'所属分类',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'请输入方案名称',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案描述：</div>
                <div class="liRight">
                    <?php echo Form::textarea('description',old('description'),['placeholder'=>'请输入方案描述',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案图片：</div>
                <div class="liRight" id="app">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">相关整机：</div>
                <div class="liRight">
                <?php echo Form::select('complete_machines[]',$complete_machines,old('complete_machines[]',$complete_machine),['相关整机'=>'所属分类',"class"=>' select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">方案描述：</div>
                <div class="liRight">
                    <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <script id="container" name="details"   type="text/plain">
                        <?php if(!Route::is('admin.integrations.create')): ?>
                            <?php echo $integration->details; ?>

                        <?php endif; ?>
                    </script>
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
            <?php if(Route::is('admin.integrations.create')): ?>
            defaultList: [],
            <?php else: ?>
            defaultList:<?php echo $integration->pic; ?>,
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



