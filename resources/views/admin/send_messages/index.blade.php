@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create send_messages')
                    {{--<button class="changeWeb Btn" data_url="{{ route('admin.send_messages.create') }}">添加</button>--}}
                @endcan
                @can('delete send_messages')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/send_messages/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>['email'=>'邮箱','phone'=>'手机'],'duiBiCanShu'=>$type,'url'=>route('admin.send_messages.index'),'canshu'=>'type'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="send_messages">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class=""> @if($type=='email')发送邮箱号 @else 发送手机号 @endif</th>
                    <th  class="tableMoreHide">发送的内容</th>
                    <th class="">发送时间</th>

                </tr>

                @forelse($send_messages as $send_message)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $send_message->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            {{ $send_message->user->username }}      {{ $send_message->user->nickname }}
                        </td>
                        <td class="">
                            @if($send_message->type=='email')
                                {{ $send_message->user->email }}
                            @else
                                {{ $send_message->user->phone }}
                            @endif

                        </td>
                        <td class="tableMoreHide">{!! $send_message->content !!}</td>
                        <td class="">{{ $send_message->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $send_messages->links() }}
        </div>
    </div>

@endsection