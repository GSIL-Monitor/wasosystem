@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="alertWeb Btn" data_url="{{ route('admin.roles.create') }}">添加角色</button>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="{{ url('/waso/roles/destory') }}">删除</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">角色名</th>
                    <th >角色</th>
                    <th class="tableMoreHide">权限</th>
                </tr>

                @foreach($roles as $role)
                    <tr>
                        <td class="tableInfoDel">
                            @if($role->id === 1)
                                 --
                                @else
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $role->id }}">
                            @endif
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="{{ route('admin.roles.edit',$role->id) }}">{{ $role->title }}</a></td>
                        <td>{{ $role->name }}</td>
                        <td class="tableMoreHide">{!!  $role->permissions->implode('title',',') !!}  </td>{{-- 检索与角色相关的权限数组，并将其转换为字符串。 --}}
                    </tr>
                @endforeach
            </table>
            {{ $roles->links() }}
        </div>
    </div>

@endsection