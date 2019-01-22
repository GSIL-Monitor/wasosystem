@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create services')
                    <button class="changeWeb Btn" data_url="{{ route('admin.services.create') }}">添加</button>
                @endcan
                @can('delete services')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/services/destory') }}">删除
                    </button>
                @endcan
            </div>
            @include('admin.common._search',[
                'url'=>route('admin.services.index'),
                'status'=>Request::except(['type','keyword','_token']),
                'condition'=>[
                    'serial_number'=>'质保序列号',
                    'order_serial_number'=>'订单序列号',
                    'username'=>'账号',
                ]
                ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.service_quality_assurance_status'),'duiBiCanShu'=>$status,'url'=>route('admin.services.index'),'canshu'=>'status','link'=>Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' ])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="services">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="tableInfoDel">客户信息</th>
                    <th class="tableInfoDel">申报单号</th>
                    <th class="tableInfoDel">质保模式</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @forelse($services as $service)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $service->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.services.edit',$service->id) }}">{{ $service->serial_number }}</a>
                        </td>
                        <td>{{ $service->username ?? '' }}</td>
                        <td>{{ $service->order->serial_number ?? '' }}</td>
                        <td>{{ config('status.service_quality_assurance_model')[$service->quality_assurance_model] }}</td>
                        <td class="tableMoreHide">{{ $service->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $service->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                {{ $services->appends(request()->except(['page']))->links() }}
            </form>

        </div>
    </div>

@endsection