@extends('admin.layout.default')
@inject('OrderParamenterPresenter','App\Presenters\OrderParamenterPresenter')
@section('css')
    <style>
        i {
            width: 15px;
            height: 15px;
            display:inline-block;
            vertical-align: middle;
            margin:0 0 0 5px;
        }
        .UP {

            background: url({{ asset('admin/pic/icons.png') }}) no-repeat -20px 0;
        }

        .DOWN {
            background: url({{ asset('admin/pic/icons.png') }}) no-repeat -20px -20px;
        }

        .HOLD {
            background: url({{ asset('admin/pic/icons.png') }}) no-repeat -20px -40px;
        }
    </style>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit common_equipments')
                    <button  class="Btn blue common_update" form_id="AllEdit">批量更新价格</button>
                @endcan
                @can('delete common_equipments')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/common_equipments/destory') }}">取消常用配置
                    </button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.common_equipments.update_prices') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">配置型号</th>
                    <th class="">订单类型</th>
                    <th class="">配置单价</th>
                    <th class="">更新前</th>
                    <th class="">备注信息</th>
                    <th class="">更新时间</th>
                    <th class="">操作</th>

                </tr>

                @forelse($common_equipments as $common_equipment)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $common_equipment->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="{{ route('admin.common_equipments.edit',$common_equipment->id) }}">
                                {{ $common_equipment->name }}
                            </a>
                        </td>
                        <td>{{ $common_equipment->machine_model }}</td>
                        <td>{{ $parameters['order_type'][$common_equipment->order_type] }}</td>
                        <td>
                            {{ $common_equipment->total_prices }}
                            <i class="{{ $OrderParamenterPresenter
                                    ->check_peice_float($common_equipment->total_prices,$common_equipment->old_prices) }}">
                            </i>
                        </td>
                        <td>{{ $common_equipment->old_prices }}</td>
                        <td>{{ $common_equipment->user_remark }}</td>
                        <td class="">{{ $common_equipment->updated_at->format('Y-m-d') }}</td>
                        <td><a  class="click" data_title="你确定要下单吗？" data_name="下单" data_url="{{ route('admin.common_equipments.place_an_order',$common_equipment->id) }}">下单</a></td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $common_equipments->links() }}
        </div>
    </div>

@endsection