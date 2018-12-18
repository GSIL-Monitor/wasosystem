<li>
    <div class="liLeft">Intel：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="intel.name" :pic-url="intel.url" :default-list="intel.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('{{ $type }}_intel') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">Intel描述：</div>
    <div class="liRight">
        <textarea  name="{{ $type }}_intel_description"> {{ old($type.'_intel_description',setting($type.'_intel_description')) }} </textarea>
        <span class="greenWord">用法: setting('{{ $type }}_intel_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">IntelAD：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="intelAD.name" :pic-url="intelAD.url" :default-list="intelAD.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('{{ $type }}_intelAD') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">IntelAD描述：</div>
    <div class="liRight">
        <textarea  name="{{ $type }}_intelAD_description"> {{ old($type.'_intelAD_description',setting($type.'_intelAD_description')) }} </textarea>
        <span class="greenWord">用法: setting('{{ $type }}_intelAD_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">华硕：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="asus.name" :pic-url="asus.url" :default-list="asus.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('{{ $type }}_asus') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">华硕描述：</div>
    <div class="liRight">
        <textarea  name="{{ $type }}_asus_description"> {{ old($type.'_asus_description',setting($type.'_asus_description')) }} </textarea>
        <span class="greenWord">用法: setting('{{ $type }}_asus_description') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">超微：</div>
    <div class="liRight">
        <upload-images :file-count="fileCount" :pic-name="supermicro.name" :pic-url="supermicro.url" :default-list="supermicro.pic" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
        <span class="greenWord">用法: setting('{{ $type }}_supermicro') </span>
    </div>
    <div class="clear"></div>
</li>
<li>
    <div class="liLeft">超微描述：</div>
    <div class="liRight">
        <textarea  name="{{ $type }}_supermicro_description"> {{ old($type.'_supermicro_description',setting($type.'_supermicro_description')) }} </textarea>
        <span class="greenWord">用法: setting('{{ $type }}_supermicro_description') </span>
    </div>
    <div class="clear"></div>
</li>
