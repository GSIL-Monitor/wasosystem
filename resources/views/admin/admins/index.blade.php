@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create admins')
                <button class="alertWeb Btn" data_url="{{ route('admin.admins.create') }}">添加管理员</button>
                @endcan
                @can('edit admins')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete admins')
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="{{ url('/waso/admins/destory') }}">删除</button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="admins">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">禁用</th>
                    <th class="tableInfoDel">账号</th>
                    <th class="">角色</th>
                    <th>名称</th>
                    <th>电话</th>
                    <th>邮箱</th>
                    <th>QQ</th>
                    <th>登陆次数</th>
                </tr>
                @foreach($admins as $admin)
                    <tr>
                        <td class="tableInfoDel">
                            @if($admin->id !==1)
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $admin->id }}">
                                @else
                                --
                                @endif
                        </td>
                        <td>
                            <label for="{{ $admin->id }}">
                                {{ Form::checkbox('edit['.$admin->id.'][disabled]',$admin->disabled,old('edit['.$admin->id.'][disabled]',$admin->disabled),['class'=>'radio','id'=>$admin->id]) }}
                            </label>
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="{{ route('admin.admins.edit',$admin->id) }}">{{ $admin->account }}</a></td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->roles->implode('title',',') }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->qq }}</td>
                        <td>{{ $admin->login_count }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $admins->links() }}
            </form>
        </div>
    </div>

@endsection