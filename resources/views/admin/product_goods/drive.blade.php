@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit product_frameworks')
                    <button type="submit" class="Btn common_add" form_id="product_frameworks"
                            location="top">上传/修改</button>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete product_frameworks')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/product_drives/destory') }}">删除
                    </button>
                @endcan
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <ul class="maxUl" id="app">
                    {!! Form::model($productGood,['route'=>['admin.product_goods.drive_add',$productGood->id],'id'=>'product_frameworks','method'=>'put']) !!}
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
                    @forelse($productGood->series->drive as $framework_drive)
                        <tr>
                            <td class="tableInfoDel">
                              --
                            </td>
                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                {{ $framework_drive->file['name'] }}
                            </td>
                            <td class="tableInfoDel ">
                                {{ $framework_drive->file['url'] }}
                            </td>
                            <td class="tableMoreHide">{{ $framework_drive->created_at->format('Y-m-d') }}</td>
                            <td class="">{{ $framework_drive->updated_at->format('Y-m-d') }}</td>

                        </tr>
                        @empty
                    @endforelse
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


        </div>
    </div>

@endsection