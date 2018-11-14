<li>
    <div class="liLeft">招聘分类</div>
    <div class="liRight">
        {!! Form::hidden('type',old('type',Request::get('type'))) !!}
        {!! Form::select('field[type]',config('status.job_type'),old('field[type]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">职位类别</div>
    <div class="liRight">
        {!! Form::text('field[position_type]',old('field[position_type]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">职位名称</div>
    <div class="liRight">
        {!! Form::text('field[position]',old('field[position]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">薪资待遇</div>
    <div class="liRight">
        {!! Form::text('field[salary]',old('field[salary]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">工作地点</div>
    <div class="liRight">
        {!! Form::text('field[workplace]',old('field[workplace]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">招聘人数</div>
    <div class="liRight">
        {!! Form::number('field[recruiting_numbers]',old('field[recruiting_numbers]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">是否过期：</div>
    <div class="liRight">
        <label for="show">{{ Form::checkbox('field[over]',0,old('field[over]'),['id'=>'show','class'=>'radio']) }}过期</label>
    </div>
    <div class="clear"></div>
</li>
<li class="sevenLi">
    <div class="liLeft">职位描述</div>
    <div class="liRight">
        @include('vendor.ueditor.assets')
        <script id="container" name="field[job_description]"   type="text/plain">
            {!! optional($business_management)->field['job_description'] !!}
        </script>
    </div>
    <div class="clear"></div>
</li>