@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create warehouse_out_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.warehouse_out_managements.code_out') }}">条码出库</button>
                @endcan

                @if($status !='finish')
                @can('delete warehouse_out_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/warehouse_out_managements/destory') }}">删除
                    </button>
                @endcan
                @endif
            </div>
            @include('admin.common._search',[
           'url'=>route('admin.warehouse_out_managements.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'serial_number'=>'序列号',
               'user_id'=>'用户账号/姓名',
               'code'=>'条码',
           ]
           ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.warehouse_out_managements_status'),'duiBiCanShu'=>$status,'url'=>route('admin.warehouse_out_managements.index'),'canshu'=>'status'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="warehouse_out_managements">
            <table class="listTable">
                <tr>
                    @if($status !='finish')
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    @endif
                    <th class="">类别</th>
                    <th class="tableInfoDel">序列号</th>
                    <th class="">收货单位</th>
                    <th class="">型号</th>
                    <th class="">数量  => 已出</th>
                    <th class="">经办人</th>
                    <th class="">操作人员</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">出库时间</th>
                </tr>

                @forelse($warehouse_out_managements as $warehouse_out_management)
                    <tr>
                        @if($status !='finish')
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $warehouse_out_management->id }}">
                        </td>
                        @endif
                        <td>{{ config('status.warehouse_out_managements_type')[$warehouse_out_management->out_type] }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            @if($status == 'unfinished' && str_is('CK*',$warehouse_out_management->serial_number))
                            <a class="changeWeb" data_url="{{ route('admin.warehouse_out_managements.show',$warehouse_out_management->id) }}">{{ $warehouse_out_management->serial_number }}</a>
                            @else
                            <a class="changeWeb" data_url="{{ route('admin.warehouse_out_managements.edit',$warehouse_out_management->id) }}">{{ $warehouse_out_management->serial_number }}</a>
                            @endif
                        </td>
                        <td>{{ $warehouse_out_management->user->username.' -  '.$warehouse_out_management->user->nickname }}</td>
                        <td>{{ $warehouse_out_management->order->machine_model ?? '' }}</td>
                        <td>{{ $warehouse_out_management->out_number }} => {{ $warehouse_out_management->finish_out_number }}</td>
                        <td>{{ $warehouse_out_management->order->markets->name ?? $warehouse_out_management->admins->name ?? '' }}</td>
                        <td>{{ $warehouse_out_management->admins->name ?? '' }}</td>
                        <td class="tableMoreHide">{{ $warehouse_out_management->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $warehouse_out_management->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            {!! $warehouse_out_managements->appends(Request::all())->render() !!}
            </form>

        </div>
    </div>

@endsection