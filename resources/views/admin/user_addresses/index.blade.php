@extends('admin.layout.default')
@section('js')
    <script>
        $(function(){
            $(document).on('click','.default',function () {
               $(this).val(1).prop('checked',true).parents('tr').siblings('tr').find('.default').val(0).prop('checked',false);
            });
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create user_addresses')
                    <button class="changeWeb Btn" data_url="{{ route('admin.user_addresses.create') }}?user_id={{ Request::get('user_id') }}">添加物流</button>
                @endcan
                @can('edit user_addresses')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete user_addresses')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/user_addresses/destory') }}">删除
                    </button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="user_addresses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">序号</th>
                    <th class="tableInfoDel">收货人</th>
                    <th class="">收货地址</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">默认</th>
                </tr>

                @forelse($user_addresses as $user_address)
                    <tr>
                        <td class="tableInfoDel">
                            @if(!$user_address->default)
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $user_address->id }}">
                             @endif
                        </td>
                        <td>{{ $user_address->number }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.user_addresses.edit',$user_address->id) }}">{{ $user_address->name }}</a>
                        </td>
                        <td>{{ $user_address->address }}</td>
                        <th class="tableMoreHide">{{ $user_address->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $user_address->updated_at->format('Y-m-d') }}</td>
                        <td class="">
                            @if($user_address->default)
                                @php $default=1;@endphp
                                @else
                                @php $default=0;@endphp
                            @endif

                            {{ Form::checkbox('edit['.$user_address->id.'][default]',$default ,old('edit['.$user_address->id.'][default]',$default),['class'=>'default']) }}
                        </td>
                    </tr>
                        @empty
                    <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $user_addresses->links() }}
        </div>
    </div>

@endsection