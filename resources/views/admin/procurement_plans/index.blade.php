@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create procurement_plans')
                    <button class="changeWeb Btn" data_url="{{ route('admin.procurement_plans.create') }}">采购录入</button>
                @endcan
                @can('delete procurement_plans')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/procurement_plans/destory') }}">删除
                    </button>
                @endcan
            </div>
            @include('admin.common._search',[
                 'url'=>route('admin.procurement_plans.index'),
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

            @include('admin.common._lookType',['datas'=>config('status.procurement_plans_status'),'duiBiCanShu'=>$status,'url'=>route('admin.procurement_plans.index'),'canshu'=>'status' ])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="procurement_plans">
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

                @forelse($procurement_plans as $procurement_plan)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $procurement_plan->id }}">
                        </td>
                        <td>{{ config('status.procurement_plans_type')[$procurement_plan->procurement_type] }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.procurement_plans.edit',$procurement_plan->id) }}">{{ $procurement_plan->serial_number }}</a>
                        </td>
                        <td>{{ $procurement_plan->supplier_managements->name }}</td>
                        <td>{{ $procurement_plan->products->title }}</td>
                        <td>{{ $procurement_plan->product_goods->name }}</td>
                        <td>{{ $procurement_plan->procurement_number }}</td>
                        <td><span class="@if($procurement_plan->procurement_status =='procurement') redWord @else greenWord @endif">{{ config('status.procurement_plans_statuss')[$procurement_plan->procurement_status] }}</span></td>
                        <td>{{ $procurement_plan->purchases->name ?? '' }}</td>
                        <td>{{ $procurement_plan->logistics_company ?? '' }}{{ $procurement_plan->logistics_number ?? '' }}</td>
                        <td class="tableMoreHide">{{ $procurement_plan->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $procurement_plan->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            {{ $procurement_plans->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())]) }}

            </form>
        </div>
    </div>

@endsection