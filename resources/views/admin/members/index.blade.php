@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create members')
                    <button class="changeWeb Btn" data_url="{{ route('admin.members.create') }}">添加</button>
                @endcan
                @can('delete members')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/members/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.member'),'duiBiCanShu'=>$status,'url'=>route('admin.members.index'),'canshu'=>'status'])

            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="members">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">账号</th>
                    <th class="">姓名</th>
                    <th class="">单位简称</th>
                    <th class="">默认单位</th>
                    <th class="">单位简码</th>
                    <th class="">配件选购</th>
                    <th class="">级别</th>
                    <th class="">账期(天)</th>
                    <th class="">管理员</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">最后登陆时间</th>
                    <th class="">操作</th>
                </tr>

                @foreach($members as $member)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $member->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                       data_url="{{ route('admin.members.edit',$member->id) }}">{{ $member->username }}</a>
                        </td>
                        <td>{{ $member->nickname }}</td>
                        <td>{{ $member->unit }}</td>
                        <td></td>
                        <td></td>
                        <td>
                            <label for="{{ 'parts_buy'.$member->id }}">
                                {{ Form::checkbox('edit['.$member->id.'][parts_buy]',$member->parts_buy,old('edit['.$member->id.'][parts_buy]',$member->parts_buy),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'parts_buy'.$member->id]) }}
                            </label>
                        </td>
                        <td>{{ $member->grades->name }}</td>
                        <td>{{ $member->payment_days }}</td>
                        <td>{{ $member->admins->name ?? '' }}</td>
                        <th class="tableMoreHide">{{ $member->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $member->last_login_time }}</td>
                        <td class=""></td>
                    </tr>
                @endforeach
            </table>
            </form>
             {{ $members->links() }}
        </div>
    </div>

@endsection