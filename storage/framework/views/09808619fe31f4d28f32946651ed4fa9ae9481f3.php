<li>
    <div class="liLeft">招聘分类</div>
    <div class="liRight">
        <?php echo Form::hidden('type',old('type',Request::get('type'))); ?>

        <?php echo Form::select('field[type]',config('status.job_type'),old('field[type]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">职位类别</div>
    <div class="liRight">
        <?php echo Form::text('field[position_type]',old('field[position_type]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">职位名称</div>
    <div class="liRight">
        <?php echo Form::text('field[position]',old('field[position]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">薪资待遇</div>
    <div class="liRight">
        <?php echo Form::text('field[salary]',old('field[salary]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">工作地点</div>
    <div class="liRight">
        <?php echo Form::text('field[workplace]',old('field[workplace]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">招聘人数</div>
    <div class="liRight">
        <?php echo Form::number('field[recruiting_numbers]',old('field[recruiting_numbers]'),['class'=>'checkNull']); ?>

    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">是否过期：</div>
    <div class="liRight">
        <label for="show"><?php echo e(Form::checkbox('field[over]',0,old('field[over]'),['id'=>'show','class'=>'radio'])); ?>过期</label>
    </div>
    <div class="clear"></div>
</li>
<li class="sevenLi">
    <div class="liLeft">职位描述</div>
    <div class="liRight">
        <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <script id="container" name="field[job_description]"   type="text/plain">
            <?php echo optional($business_management)->field['job_description']; ?>

        </script>
    </div>
    <div class="clear"></div>
</li>