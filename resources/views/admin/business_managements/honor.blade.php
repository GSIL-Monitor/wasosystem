@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create business_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.business_managements.create') }}?type=honor">添加</button>
                @endcan
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @can('delete business_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/business_managements/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="business_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">排序</th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">缩略图</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                </tr>

                @forelse($honors as $honor)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $honor->id }}">
                        </td>
                        <td>
                            <input  type="text" name="edit[{{ $honor->id }}][sort]" value="{{ $honor->sort }}" style="width:40px;">
                        </td>

                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="{{ route('admin.business_managements.edit',$honor->id) }}?type=honor">{{ $honor->field['name'] }}</a>
                        </td>
                        <td>
                            <img src="{{ json_decode($honor->pic,true)[0]['url'] ?? asset('admin/pic/personPic.jpg') }}" alt="" style="width: 50px;height: 50px">
                        </td>
                        <td class="tableMoreHide">{{ $honor->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $honor->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                {{ $honors->links() }}
            </form>
        </div>
    </div>

@endsection