@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('show integration_categories')
                    <button class="changeWeb Btn" data_url="{{ route('admin.integration_categories.index') }}">分类管理</button>
                @endcan
                @can('create integrations')
                    <button class="changeWeb Btn" data_url="{{ route('admin.integrations.create') }}">添加</button>
                @endcan
                @can('delete integrations')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/integrations/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="integrations">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @foreach($integrations as $integration)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $integration->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.integrations.edit',$integration->id) }}">{{ $integration->name }}</a>
                        </td>
                        <th class="tableMoreHide">{{ $integration->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $integration->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
            </form>
             {{ $integrations->links() }}
        </div>
    </div>

@endsection