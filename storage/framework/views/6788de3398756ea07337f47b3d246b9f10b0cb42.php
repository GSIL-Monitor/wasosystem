<fieldset>
    <legend>开放平台</legend>
<li>
    <div class="liLeft">AppID：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_open_appid" value="<?php echo e(old($type.'_open_appid',setting($type.'_open_appid'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_open_appid') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">AppSecret：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_open_secret" value="<?php echo e(old($type.'_open_secret',setting($type.'_open_secret'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_open_secret') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">RedirectUri：</div>
    <div class="liRight">
        <input type="text" name="<?php echo e($type); ?>_open_redirect_uri" value="<?php echo e(old($type.'_open_redirect_uri',setting($type.'_open_redirect_uri'))); ?>" >
        <span class="greenWord">用法: setting('<?php echo e($type); ?>_open_redirect_uri') </span>
    </div>
    <div class="clear"></div>
</li>
</fieldset>
