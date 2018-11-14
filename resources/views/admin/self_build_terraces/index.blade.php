@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create self_build_terraces')
                    <button class="changeWeb Btn" data_url="{{ route('admin.self_build_terraces.create') }}">添加</button>
                @endcan
                @can('delete self_build_terraces')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/self_build_terraces/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="self_build_terraces">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @foreach($self_build_terraces as $self_build_terrace)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $self_build_terrace->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.self_build_terraces.edit',$self_build_terrace->id) }}">{{ $self_build_terrace->name }}</a>
                        </td>
                        <th class="tableMoreHide">{{ $self_build_terrace->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $self_build_terrace->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $self_build_terraces->links() }}
            </form>
        </div>
    </div>

@endsection