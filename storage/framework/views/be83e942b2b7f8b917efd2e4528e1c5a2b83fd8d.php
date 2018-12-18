<li>
    <div class="liLeft">网站Logo：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="logo.name" :pic-url="logo.url" :default-list="logo.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_logo') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站标题：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_title" value="<?php echo e(old($type.'_title',setting($type.'_title'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_title') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站关键字：</div>
    <div class="liRight">
        <textarea   name="<?php echo e($type); ?>_keyWord" ><?php echo e(old($type.'_keyWord',setting($type.'_keyWord'))); ?></textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_keyWord') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站描述：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_description"> <?php echo e(old($type.'_description',setting($type.'_description'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站备案：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_website_records" value="<?php echo e(old($type.'_website_records',setting($type.'_website_records'))); ?>">
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_website_records') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">公安部备案：</div>
    <div class="liRight">
        <input type="text"  name="<?php echo e($type); ?>_ministry_public_security_records" value="<?php echo e(old($type.'_ministry_public_security_records',setting($type.'_ministry_public_security_records'))); ?> ">
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_ministry_public_security_records') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">百度统计代码：</div>
    <div class="liRight"><textarea name="<?php echo e($type); ?>_baidu_statistics" ><?php echo e(old($type.'_baidu_statistics',setting($type.'_baidu_statistics'))); ?></textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_baidu_statistics') </span>
    </div>
    <div class="clear"></div>
</li>
