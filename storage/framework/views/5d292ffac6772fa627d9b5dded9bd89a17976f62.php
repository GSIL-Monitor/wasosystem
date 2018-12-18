<!-- 配置文件 -->
<script type="text/javascript" src="<?php echo e(asset('vendor/ueditor/ueditor.config.js')); ?>"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo e(asset('vendor/ueditor/ueditor.all.js')); ?>"></script>
<script type="text/javascript">
    window.UEDITOR_CONFIG.serverUrl = '<?php echo e(config('ueditor.route.name')); ?>'
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '<?php echo e(csrf_token()); ?>'); // 设置 CSRF token.
        ue.setHeight(350);//设置高度
    });
</script>
