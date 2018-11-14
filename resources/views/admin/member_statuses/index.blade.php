@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create member_statuses')
                    <button class="changeWeb Btn" data_url="{{ route('admin.member_statuses.create') }}?type={{ $status }}">添加{{ config('status.userStatus')[$status] }}</button>
                @endcan
                @can('edit member_statuses')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete member_statuses')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/member_statuses/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            @include('admin.common._lookType',['datas'=>config('status.userStatus'),'duiBiCanShu'=>$status,'url'=>route('admin.member_statuses.index'),'canshu'=>'status'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="member_statuses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">{{ config('status.userStatus')[$status] }}标识</th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @foreach($member_statuses as $member_status)
                    <tr>
                        <td class="tableInfoDel">
                            @if($member_status->id==1 || $member_status->id==2)
                            --
                            @else
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $member_status->id }}">
                            @endif
                        </td>
                        <td>{{ $member_status->identifying }}
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text" value="{{ $member_status->name }}" name="edit[{{ $member_status->id }}][name]">
                            <a class="changeWeb" data_url="{{ route('admin.member_statuses.edit',$member_status->id) }}">{{ $member_status->name }}</a>
                        </td>
                        <th class="tableMoreHide">{{ $member_status->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $member_status->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
            </form>
             {{ $member_statuses->links() }}
        </div>
    </div>

@endsection