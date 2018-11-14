@extends('admin.layout.default')
@inject(DemandManagementParamenter,'App\Presenters\DemandManagementParamenter')
@section('js')
    <script>
        function sum_prices() {
            var chance_price=0,account_paid=0;
            $('.account_paid').each(function () {
                account_paid+=parseInt($(this).text());
            });
            $('.chance_price').each(function () {
                chance_price+=parseInt($(this).text());
            });
            $("#chance_price span").text(chance_price);
            $("#account_paid span").text(account_paid);
        }
        $(function () {
            sum_prices();
        });
        var vm=new Vue({
            el: "#app",
            data:{
                dates:{!! json_encode($date) !!}
            }
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox" id="app">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create demand_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.demand_managements.create') }}">添加</button>
                @endcan
                @can('show demand_filtrates_users')
                    <button class="changeWeb Btn" data_url="{{ route('admin.users.index') }}?source=demand_managements">会员管理</button>
                @endcan

                @can('delete demand_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/demand_managements/destory') }}">删除
                    </button>
                @endcan
            </div>

            @include('admin.common._search',[
           'url'=>route('admin.demand_managements.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'demand_number'=>'需求序列号',
               'user_id'=>'用户账号',
               'admin'=>'工号',
           ],'select'=>"<date-picker-filtrate :default-date='dates'></date-picker-filtrate>"
           ])
            <div class="phoneBtnOpen"></div>
        </div>

        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$parameters['demand_status'],
            'duiBiCanShu'=>$cate,
            'url'=>route('admin.demand_managements.index'),
            'canshu'=>'cate',
            'add'=>[
            'order_history'=>['url'=>route('admin.orders.index').'?status=arrival_of_goods&source','name'=>'历史订单'],
             'old_orders'=>['url'=>route('admin.old_orders.index').'?source','name'=>'老订单']
            ]
            ])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="demand_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">序列号</th>
                    @if($cate!='demand_consult')
                    <th class="">关联订单</th>
                    @endif
                    <th  class="">需求状态</th>
                    <th  class="">用户帐号</th>
                    <th  class="tableMoreHide">联系方式|电话/邮箱/微信/QQ</th>
                    <th  class="tableMoreHide">客户需求</th>
                    @if($cate!='demand_consult')
                    <th  id="chance_price">机会金额 <span></span></th>
                    <th  id="account_paid">成交金额 <span></span></th>
                    @endif
                    <th  class="">客情状态</th>
                    <th  class="tableMoreHide">下步计划</th>
                    <th  class="">添加时间</th>
                    <th class="tableMoreHide">事件更新</th>
                    <th  class="">管理员</th>
                    <th  class="tableMoreHide">协同人员</th>
                    <th  class="">信息来源</th>
                </tr>
                @forelse($demand_managements as $demand_management)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $demand_management->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.demand_managements.edit',$demand_management->id) }}">
                                @if($demand_management->created_at == $demand_management->updated_at)
                                    <span class="redWord new">{{ $demand_management->demand_number }}</span>
                                    <i class="newOrder"></i>
                                    @else
                                    {{ $demand_management->demand_number }}
                                @endif
                            </a>
                        </td>
                        @if($cate!='demand_consult')
                        <td  class="">{!!   $DemandManagementParamenter->orderList($demand_management) !!}</td>
                        @endif
                        <td  class="">{{ $parameters['demand_status'][$demand_management->demand_status] }}</td>
                        <td  class="">{{ $demand_management->user->username ?? ''}} {{ $demand_management->user->nickname ?? ''}}</td>

                        <td  class="tableMoreHide">{{ $demand_management->user->contact ?? ''}}</td>
                        <td  class="tableMoreHide">
                             {{ $DemandManagementParamenter->customer_demand($demand_management) }}
                        </td>
                        @if($cate!='demand_consult')
                        <td  class="chance_price">    {{ $DemandManagementParamenter->orderMaxPrice($demand_management) }}</td>
                        <td  class="account_paid">    {{ $DemandManagementParamenter->account_paid($demand_management) }}</td>
                       @endif
                        <td  class="">
                            {{ $parameters['customer_status'][$demand_management->customer_status] }}
                        </td>

                        <td  class="tableMoreHide">{{ $demand_management->the_next_step_program }}</td>
                        <td  class="">{{ $demand_management->created_at->format('Y-m-d') }}</td>
                        <td class="tableMoreHide">{{ $demand_management->updated_at }}</td>
                        <td  class="">{{ $parameters['admins'][$demand_management->admin] }}</td>
                        <td  class="tableMoreHide"> {{ $DemandManagementParamenter->assistant($demand_management) }}</td>
                        <td  class="">{{ $demand_management->visitor_detail->source ?? '老客户' }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
              {{ $demand_managements->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())]) }}
            </form>

        </div>
    </div>

@endsection