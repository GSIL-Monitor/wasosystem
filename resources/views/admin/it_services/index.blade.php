@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create it_services')
                    <button class="changeWeb Btn" data_url="{{ route('admin.it_services.create') }}">添加</button>
                @endcan
                @can('delete it_services')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/it_services/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="it_services">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">架构类型</th>
                    <th class="">产品系列</th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">描述</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @foreach($it_services as $it_service)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $it_service->id }}">
                        </td>
                        <td class="">{{ $it_service->framework->name }}</td>
                        <td class="">{{ $it_service->series->name }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.it_services.edit',$it_service->id) }}">{{ $it_service->name }} / {{ $it_service->details['cooperation_types'] }}</a>
                        </td>
                        <td class="">{{ $it_service->details['description'] }}</td>
                        <th class="tableMoreHide">{{ $it_service->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $it_service->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
            </form>
             {{ $it_services->links() }}
        </div>
    </div>

@endsection