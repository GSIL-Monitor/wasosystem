<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.product_frameworks.create'))
            {!! Form::open(['route'=>'admin.product_frameworks.store','method'=>'post','id'=>'product_frameworks']) !!}
        @else
            {!! Form::model($productFramework,['route'=>['admin.product_frameworks.update',$productFramework->id],'id'=>'product_frameworks','method'=>'put']) !!}
        @endif
        <li>
                <div class="liLeft">添加驱动：</div>
                <div class="liRight">
                    <upload-files :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-files>
                </div>
                <div class="clear"></div>
        </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>

</div>
<form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="table" value="product_drives">
    <table class="listTable">
        <tr>
            <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
            <th class="tableInfoDel">驱动名称</th>
            <th class="tableInfoDel">驱动链接</th>
            <th class="tableMoreHide">添加时间</th>
            <th class="">修改时间</th>
        </tr>
        @foreach($drives as $drive)
            <tr>
                <td class="tableInfoDel">
                    <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $drive->id }}">
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName">
                    <input type="text" name="edit[{{ $drive->id }}][file->name]"
                           value="{{ $drive->file['name'] }}">
                </td>
                <td class="tableInfoDel ">
                    <input type="text" name="edit[{{ $drive->id }}][file->url]"
                           value="{{ $drive->file['url'] }}">
                </td>
                <td class="tableMoreHide">{{ $drive->created_at->format('Y-m-d') }}</td>
                <td class="">{{ $drive->updated_at->format('Y-m-d') }}</td>

            </tr>
        @endforeach
    </table>
</form>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            defaultList: [],
            actionImageUrl: "{!! env('ActionFileUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount:5,
        },
        methods: {

        },
        mounted: function () {

        },
    });
</script>

