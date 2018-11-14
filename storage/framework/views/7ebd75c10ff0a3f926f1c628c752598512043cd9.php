<li>
    <div class="liLeft">图片</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="redWord">第一张PC端图片  第二张手机端图片</span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">背景颜色</div>
    <div class="liRight">
        <?php echo Form::hidden('type',old('type',Request::get('type'))); ?>

        <?php echo Form::text('field[color]',old('field[color]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">链接地址</div>
    <div class="liRight">
        <?php echo Form::text('field[url]',old('field[url]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">大体字</div>
    <div class="liRight">
        <?php echo Form::text('field[max_font]',old('field[max_font]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">小体字</div>
    <div class="liRight">
        <?php echo Form::text('field[min_font]',old('field[min_font]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">文字对齐方向</div>
    <div class="liRight">
        <?php echo Form::select('field[font_float]',config('status.banner_font_float'),old('field[font_float]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">字体颜色</div>
    <div class="liRight">
        <?php echo Form::select('field[font_color]',config('status.banner_font_color'),old('field[font_color]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">“了解更多”</div>
    <div class="liRight">
        <?php echo Form::checkbox('field[more]',$business_management->field['more'] ?? 1,old('field[more]',$business_management->field['more'] ?? 1),['class'=>'radio']); ?>

    </div>
    <div class="clear"></div>
</li>
