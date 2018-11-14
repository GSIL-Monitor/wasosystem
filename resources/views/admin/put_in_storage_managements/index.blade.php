@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create put_in_storage_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.put_in_storage_managements.create') }}">添加</button>
                @endcan
                @can('delete put_in_storage_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/put_in_storage_managements/destory') }}">删除
                    </button>
                @endcan
            </div>
            @include('admin.common._search',[
               'url'=>route('admin.put_in_storage_managements.index'),
               'status'=>array_except(Request::all(),['type','keyword','_token']),
               'condition'=>[
                   'serial_number'=>'序列号',
                   'supplier_managements_id'=>'供货单位/简称',
                    'product_good_id'=>'产品名/简称',

               ]
              ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="put_in_storage_managements">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                        <th class="">类别</th>
                        <th class="tableInfoDel">预购序列号</th>
                        <th class="">供货单位</th>
                        <th class="">产品类型</th>
                        <th class="">产品规格</th>
                        <th class="">数量</th>
                        <th class="">状态</th>
                        <th class="">采购员</th>
                        <th class="">物流及单号</th>
                        <th  class="tableMoreHide">预购日期</th>
                        <th class="">修改时间</th>

                    </tr>

                    @forelse($put_in_storage_managements as $put_in_storage_management)
                        <tr>
                            <td class="tableInfoDel">
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $put_in_storage_management->id }}">
                            </td>
                            <td>{{ config('status.procurement_plans_type')[$put_in_storage_management->procurement_type] }}</td>
                            <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                                   data_url="{{ route('admin.put_in_storage_managements.edit',$put_in_storage_management->id) }}">{{ $put_in_storage_management->serial_number }}</a>
                            </td>
                            <td>{{ $put_in_storage_management->supplier_managements->name }}</td>
                            <td>{{ $put_in_storage_management->products->title }}</td>
                            <td>{{ $put_in_storage_management->product_goods->name }}</td>
                            <td>{{ $put_in_storage_management->procurement_number }}</td>
                            <td><span class="@if($put_in_storage_management->procurement_status =='procurement') redWord @else greenWord @endif">{{ config('status.procurement_plans_statuss')[$put_in_storage_management->procurement_status] }}</span></td>
                            <td>{{ $put_in_storage_management->purchases->name ?? '' }}</td>
                            <td>{{ $put_in_storage_management->logistics_company ?? '' }}{{ $put_in_storage_management->logistics_number ?? '' }}</td>
                            <td class="tableMoreHide">{{ $put_in_storage_management->created_at->format('Y-m-d') }}</td>
                            <td class="">{{ $put_in_storage_management->updated_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr><td><div class='error'>没有数据</div></td></tr>
                    @endforelse
                </table>
            </form>
        </div>
    </div>

@endsection