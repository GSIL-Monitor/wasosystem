@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create integration_categories')
                    <button class="changeWeb Btn" data_url="{{ route('admin.integration_categories.create') }}">添加分类</button>
                @endcan
                @can('delete integration_categories')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/integration_categories/destory') }}">删除
                    </button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="integration_categories">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @foreach($integration_categories as $integration_category)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $integration_category->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.integration_categories.edit',$integration_category->id) }}">{{ $integration_category->name }}</a>
                        </td>
                        <th class="tableMoreHide">{{ $integration_category->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $integration_category->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
            </form>
             {{ $integration_categories->links() }}
        </div>
    </div>

@endsection