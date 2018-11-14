<div class="JJList">
    <ul class="maxUl" id="app" >
        @if(Route::is('admin.integration_categories.create'))
            {!! Form::open(['route'=>'admin.integration_categories.store','method'=>'post','id'=>'integration_categories','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($integration_category,['route'=>['admin.integration_categories.update',$integration_category->id],'id'=>'integration_categories','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">分类名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入分类名称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">分类图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
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
            @if(Route::is('admin.integration_categories.create'))
            defaultList: [],
            @else
            defaultList:{!! $integration_category->pic !!},
            @endif
            actionImageUrl: "{!! env('ActionImageUrl') !!}",
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

