<li>
    <div class="liLeft">所属分类</div>
    <div class="liRight">
        {!! Form::hidden('type',old('type',Request::get('type'))) !!}
        {!! Form::select('field[type]',config('status.service_directory_type'),old('field[type]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">名称</div>
    <div class="liRight">
        {!! Form::text('field[name]',old('field[name]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>

<li class="sevenLi">
    <div class="liLeft">内容</div>
    <div class="liRight">
        @include('vendor.ueditor.assets')
        <script id="container" name="field[content]"   type="text/plain">
            {!! optional($business_management)->field['content'] !!}
        </script>
    </div>
    <div class="clear"></div>
</li>