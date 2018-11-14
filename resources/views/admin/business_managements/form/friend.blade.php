<li>
    <div class="liLeft">公司名称</div>
    <div class="liRight">
        {!! Form::hidden('type',old('type',Request::get('type'))) !!}
        {!! Form::text('field[name]',old('field[name]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">公司网址</div>
    <div class="liRight">
        {!! Form::text('field[url]',old('field[url]'),['class'=>'checkNull']) !!}
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">公司Logo</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
    </div>
    <div class="clear"></div>
</li>
