@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create supplier_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.supplier_managements.create') }}">添加</button>
                @endcan
                @can('delete supplier_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/supplier_managements/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="supplier_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">简称</th>
                    <th class="">简码</th>
                    <th class="">采购总数</th>
                    <th class="">退货数(率)</th>
                    <th class="">返修数(率)</th>
                    <th class="">操作人员</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
                </tr>

                @forelse($supplier_managements as $supplier_management)
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $supplier_management->id }}"></td>
                        <td class="tablePhoneShow  tableName"><a class="changeWeb" data_url="{{ route('admin.supplier_managements.edit',$supplier_management->id) }}">{{ $supplier_management->name }}</a></td>
                        <td class="">{{ $supplier_management->code }}</td>
                        <td class="">
                            {{ $supplier_management->numberPurchasing() }}
                        </td>
                        <td>{{ $supplier_management->sales_return_count }}  / {{ $supplier_management->repairRate() }} % </td>
                        <td>{{ $supplier_management->factory_return_count }} / {{ $supplier_management->returnRate() }} % </td>
                        <td class="">{{ $supplier_management->admins->name }}</td>
                        <td class="tableMoreHide">{{ $supplier_management->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $supplier_management->updated_at->format('Y-m-d') }}</td>
                        <td class=""><a class="changeWeb" data_url="{{ route('admin.supplier_repair_addresses.index') }}?id={{ $supplier_management->id }}">返修地址</a></td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                         {{ $supplier_managements->links() }}
            </form>

        </div>
    </div>

@endsection