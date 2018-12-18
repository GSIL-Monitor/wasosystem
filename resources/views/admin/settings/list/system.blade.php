<li>
    <div class="liLeft">网站Logo：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="logo.name" :pic-url="logo.url" :default-list="logo.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('{{ $type }}_logo') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站标题：</div>
    <div class="liRight">
        <input type="text" name="{{ $type }}_title" value="{{ old($type.'_title',setting($type.'_title')) }}" >
        <span class="greenWord">用法: setting('{{ $type }}_title') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站关键字：</div>
    <div class="liRight">
        <textarea   name="{{ $type }}_keyWord" >{{ old($type.'_keyWord',setting($type.'_keyWord')) }}</textarea>
        <span class="greenWord">用法: setting('{{ $type }}_keyWord') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站描述：</div>
    <div class="liRight">
        <textarea  name="{{ $type }}_description"> {{ old($type.'_description',setting($type.'_description')) }} </textarea>
        <span class="greenWord">用法: setting('{{ $type }}_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">网站备案：</div>
    <div class="liRight">
        <input type="text" name="{{ $type }}_website_records" value="{{ old($type.'_website_records',setting($type.'_website_records')) }}">
        <span class="greenWord">用法: setting('{{ $type }}_website_records') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">公安部备案：</div>
    <div class="liRight">
        <input type="text"  name="{{ $type }}_ministry_public_security_records" value="{{ old($type.'_ministry_public_security_records',setting($type.'_ministry_public_security_records')) }} ">
        <span class="greenWord">用法: setting('{{ $type }}_ministry_public_security_records') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">百度统计代码：</div>
    <div class="liRight"><textarea name="{{ $type }}_baidu_statistics" >{{ old($type.'_baidu_statistics',setting($type.'_baidu_statistics')) }}</textarea>
        <span class="greenWord">用法: setting('{{ $type }}_baidu_statistics') </span>
    </div>
    <div class="clear"></div>
</li>
