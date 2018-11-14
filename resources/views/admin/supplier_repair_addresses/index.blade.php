@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create supplier_repair_addresses')
                    <button class="changeWeb Btn" data_url="{{ route('admin.supplier_repair_addresses.create') }}?supplier_managements_id={{ $supplier_management->id }}">添加{{   $supplier_management->name }}返修地址</button>
                @endcan
                @can('delete supplier_repair_addresses')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/supplier_repair_addresses/destory') }}">删除
                    </button>

                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="supplier_repair_addresses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">地址</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @forelse($supplier_repair_addresses as $supplier_repair_address)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $supplier_repair_address->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.supplier_repair_addresses.edit',$supplier_repair_address->id) }}">{{ $supplier_repair_address->name }}</a>
                        </td>
                        <td class=""><a class="changeWeb"
                                                                               data_url="{{ route('admin.supplier_repair_addresses.edit',$supplier_repair_address->id) }}">{{ $supplier_repair_address->address }}</a>
                        </td>
                        <td class="tableMoreHide">{{ $supplier_repair_address->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $supplier_repair_address->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $supplier_repair_addresses->links() }}
        </div>
    </div>

@endsection