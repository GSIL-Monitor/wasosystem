<div class="JJList">
    <ul class="maxUl" >
        @if(Route::is('admin.integrations.create'))
            {!! Form::open(['route'=>'admin.integrations.store','method'=>'post','id'=>'integrations','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($integration,['route'=>['admin.integrations.update',$integration->id],'id'=>'integrations','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">所属分类：</div>
                <div class="liRight">
                    {!!  Form::select('parent_id',$category,old('parent_id'),['placeholder'=>'所属分类',"class"=>'checkNull select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入方案名称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案描述：</div>
                <div class="liRight">
                    {!!  Form::textarea('description',old('description'),['placeholder'=>'请输入方案描述',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">方案图片：</div>
                <div class="liRight" id="app">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">相关整机：</div>
                <div class="liRight">
                {!!  Form::select('complete_machines[]',$complete_machines,old('complete_machines[]',$complete_machine),['相关整机'=>'所属分类',"class"=>' select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">方案描述：</div>
                <div class="liRight">
                    @include('vendor.ueditor.assets')
                    <script id="container" name="details"   type="text/plain">
                        @if(!Route::is('admin.integrations.create'))
                            {!! $integration->details !!}
                        @endif
                    </script>
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
            @if(Route::is('admin.integrations.create'))
            defaultList: [],
            @else
            defaultList:{!! $integration->pic !!},
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



