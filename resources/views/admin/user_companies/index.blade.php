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
                @can('create user_companies')
                    <button class="changeWeb Btn" data_url="{{ route('admin.user_companies.create') }}?user_id={{ Request::get('user_id') }}">添加单位</button>
                @endcan
                @can('edit user_companies')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete user_companies')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/user_companies/destory') }}">删除
                    </button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="user_companies">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">序号</th>
                    <th class="tableInfoDel">单位名称</th>
                    <th class="">发票模式</th>
                    <th class="">联系电话</th>
                    <th class="">单位地址</th>
                    <th class="">默认</th>

                </tr>

                @forelse($user_companies as $user_company)
                    <tr>
                        <td class="tableInfoDel">
                            @if(!$user_company->default)
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $user_company->id }}">
                            @endif
                        </td>
                        <td>{{ $user_company->number }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.user_companies.edit',$user_company->id) }}">{{ $user_company->name }}</a>
                        </td>
                        <td class="">{{ $parameters['invoice'][$user_company->tax_mode] }}</td>
                        <td class="">{{ $user_company->unit_phone }}</td>
                        <td>{{ $user_company->address }}</td>
                        <td class="">
                            @if($user_company->default)
                                @php $default=1;@endphp
                            @else
                                @php $default=0;@endphp
                            @endif

                            {{ Form::checkbox('edit['.$user_company->id.'][default]',$default ,old('edit['.$user_company->id.'][default]',$default),['class'=>'default']) }}
                        </td>
                    </tr>
                @empty
                    <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $user_companies->links() }}
        </div>
    </div>

@endsection