<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(!optional($copyright)->id): ?>
            <?php echo Form::open(['route'=>'admin.business_managements.store','method'=>'post','id'=>'business_managements','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($copyright,['route'=>['admin.business_managements.update',$copyright->id],'id'=>'business_managements','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li class="sevenLi">
                <div class="liLeft">版权声明</div>
                <div class="liRight">
                    <input type="hidden" name="type" value="copyright">
                    <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <script id="container" name="field[content]"   type="text/plain">
                        <?php echo optional($copyright)->field['content']; ?>

                    </script>
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


