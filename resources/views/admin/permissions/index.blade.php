@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="alertWeb Btn" data_url="{{ route('admin.permissions.create') }}">添加权限</button>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="{{ url('/waso/permissions/destory') }}">删除</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form>
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">权限名</th>
                    <th >权限</th>
                </tr>

                @foreach($permissions as $permission)
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $permission->id }}"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="{{ route('admin.permissions.edit',$permission->id) }}">{{ $permission->title }}</a></td>
                        <td>{{ $permission->name }}</td>
                    </tr>
                @endforeach
            </table>
                {{ $permissions->links() }}</form>
        </div>
    </div>

@endsection