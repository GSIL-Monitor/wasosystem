<li>
    <div class="liLeft">标题</div>
    <div class="liRight">
        <?php echo Form::hidden('type',old('type',Request::get('type'))); ?>

        <?php echo Form::text('field[name]',old('field[name]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">年份</div>
    <div class="liRight">
        <?php echo Form::text('field[year]',old('field[year]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">置顶</div>
    <div class="liRight">
        <?php echo Form::checkbox('top',0,old('top'),['class'=>'radio']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">图片</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
    </div>
    <div class="clear"></div>
</li>