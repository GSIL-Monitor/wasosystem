@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create we_chat_application_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.we_chat_application_managements.create') }}">添加应用</button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="we_chat_application_managements">
            <table class="listTable">
                <tr>
                    <th class="">应用ID</th>
                    <th  class="tableInfoDel">应用名</th>
                    <th class="">应用secret</th>
                    <th class="">关联群组</th>
                    <th class="">操作</th>
                </tr>

                @forelse($we_chat_application_managements as $we_chat_application_management)

                    <tr>
                        <td class="">{{ $we_chat_application_management->agentId }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="{{ route('admin.we_chat_application_managements.edit',$we_chat_application_management->id) }}">{{ $we_chat_application_management->name }}</a></td>
                        <td class="">{{ $we_chat_application_management->secret }}</td>
                        <td class="">
                            @if(!empty($we_chat_application_management->group_chat_array))
                            @forelse($we_chat_application_management->group_chat_array as $arrayKey=>$group_chat_array)
                                群聊Id：{{ $arrayKey }} &nbsp; &nbsp;&nbsp; 群聊名：{{ $group_chat_array }}
                            @empty
                            <td><div class='error'>没有群聊</div></td>
                            @endforelse
                            @endif
                        </td>
                        <td class="">
                            @if(!empty($we_chat_application_management->group_chat_array))
                                --
                                @else
                                <a class="changeWeb" data_url="{{ route('admin.we_chat_application_managements.show',$we_chat_application_management->id) }}">创建群聊</a>
                            @endif


                        </td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $we_chat_application_managements->links() }}
        </div>
    </div>

@endsection