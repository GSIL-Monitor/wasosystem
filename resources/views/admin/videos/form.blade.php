<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.videos.create'))
            {!! Form::open(['route'=>'admin.videos.store','method'=>'post','id'=>'videos','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($video,['route'=>['admin.videos.update',$video->id],'id'=>'videos','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">视频名：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'视频名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">跳转链接：</div>
                <div class="liRight">
                    {!!  Form::text('url',old('url'),['placeholder'=>'跳转链接',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">整机分类：</div>
                <div class="liRight">
                    {!!  Form::select('complete_category[]',$complete_categorys,old('complete_category[]'),["class"=>'checkNull select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">整机产品：</div>
                <div class="liRight">
                    {!!  Form::select('complete_machine[]',$complete_machines,old('complete_machine[]'),["class"=>'checkNull select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">添加视频：</div>
                <div class="liRight">
                    <upload-files :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-files>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            defaultList: [],
            @if(!Route::is('admin.videos.create'))
                    defaultList: {!! json_encode($video->mp4,true) !!},
            @endif
            actionImageUrl: "{!! env('ActionFileUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount:1,
        },
        methods: {

        },
        mounted: function () {

        },
    });
</script>

