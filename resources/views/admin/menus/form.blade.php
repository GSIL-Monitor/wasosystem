<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.menus.create'))
            {!! Form::open(['route'=>'admin.menus.store','method'=>'post','id'=>'menus']) !!}
            {!!  Form::hidden('parent_id',old('parent_id',Request::get('parent_id'))) !!}
        @else
            {!! Form::model($menu,['route'=>['admin.menus.update',$menu->id],'id'=>'menus','method'=>'put']) !!}
            {!!  Form::hidden('parent_id',old('parent_id')) !!}
        @endif

            <li>
                <div class="liLeft">栏目：</div>
                <div class="liRight">
                    @if(!Request::has('cats'))
                        {!!  Form::select('cats',config('status.menus_cats'),old('cats'),['placeholder'=>'请选择栏目','class'=>'checkNull']) !!}
                        @else
                        {!!  Form::select('cats',config('status.menus_cats'),old('cats',Request::get('cats')),['placeholder'=>'请选择栏目','onchange'=>'this.selectedIndex=1','class'=>'checkNull']) !!}
                    @endif
                </div>
                <div class="clear"></div>
            </li>

        <li>
            <div class="liLeft">菜单名称：</div>
            <div class="liRight">
                {!!  Form::text('name',old('name'),['placeholder'=>'请输入菜单名称','class'=>'checkNull']) !!}
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">菜单简码：</div>
                <div class="liRight">
                    {!!  Form::text('slug',old('slug'),['placeholder'=>'请输入菜单简码','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">菜单链接：</div>
                <div class="liRight">
                    {!!  Form::text('url',old('url'),['placeholder'=>'请输入菜单链接','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">图标：</div>
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
            @if(Route::is('admin.menus.create'))
            defaultList: [],
            @else
            defaultList:{!! $menu->pic !!},
            @endif
            actionImageUrl: "{!! env('ActionImageUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount:1,
        },
        methods: {
        },
        mounted: function () {
            console.log(111);
        },
    });

</script>


