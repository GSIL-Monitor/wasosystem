<li>
    <div class="liLeft">智造基地成员：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="members_base.name" :pic-url="members_base.url" :default-list="members_base.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_members_base') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">智造基地成员描述：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_members_base_description"> <?php echo e(old($type.'_members_base_description',setting($type.'_members_base_description'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_members_base_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">委员会成员：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="committeeman.name" :pic-url="committeeman.url" :default-list="committeeman.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_committeeman') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">委员会成员描述：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_committeeman_description"> <?php echo e(old($type.'_committeeman_description',setting($type.'_committeeman_description'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_committeeman_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">SOEM体系成员：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="soem.name" :pic-url="soem.url" :default-list="soem.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_soem') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">SOEM体系成员描述：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_soem_description"> <?php echo e(old($type.'_soem_description',setting($type.'_soem_description'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_soem_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">菁英系统商：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="stap.name" :pic-url="stap.url" :default-list="stap.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_stap') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">菁英系统商描述：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_stap_description"> <?php echo e(old($type.'_stap_description',setting($type.'_stap_description'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_stap_description') </span>
    </div>
    <div class="clear"></div>
</li>
