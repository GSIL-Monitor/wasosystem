<li>
    <div class="liLeft">客服热线：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="custome_hotline.name" :pic-url="custome_hotline.url" :default-list="custome_hotline.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_custome_hotline') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">服务热线：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="service_hotline.name" :pic-url="service_hotline.url" :default-list="service_hotline.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_service_hotline') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">微信：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="wechat.name" :pic-url="wechat.url" :default-list="wechat.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_wechat') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">新浪微博：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_sina" value="<?php echo e(old($type.'_sina',setting($type.'_sina'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_sina') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">工作时间：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_working_time" value="<?php echo e(old($type.'_working_time',setting($type.'_working_time'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_working_time') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">传真号码：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_fax" value="<?php echo e(old($type.'_fax',setting($type.'_fax'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_fax') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">邮政编码：</div>
    <div class="liRight">
        <input type="text" value="<?php echo e(old($type.'_zip',setting($type.'_zip'))); ?>" name="<?php echo e($type); ?>_zip">
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_zip') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">联系电话：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_telephone"> <?php echo e(old($type.'_telephone',setting($type.'_telephone'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_telephone') </span>
        <span class="redWord">&nbsp;&nbsp;&nbsp;提示: 多个号码用空格分开 </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">公司地址：</div>
    <div class="liRight">
        <textarea  name="<?php echo e($type); ?>_address"> <?php echo e(old($type.'_address',setting($type.'_address'))); ?> </textarea>
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_address') </span>
    </div>
    <div class="clear"></div>
</li>
