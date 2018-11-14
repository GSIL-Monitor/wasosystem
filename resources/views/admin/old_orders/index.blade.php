@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            @if(Request::has('source'))
                <button class="changeWebClose Btn">返回</button>
            @endif
            @include('admin.common._search',[
           'url'=>route('admin.old_orders.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'proid'=>'序列号',
               'remarks'=>'公司',
               'userid'=>'用户账号',
           ]
           ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="old_orders">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">订单序列号</th>
                    <th  class="">用户账号</th>
                    <th  class="">订单模式</th>
                    <th  class="">订单状态</th>
                    <th  class="">订单价格</th>
                    <th  class="">款项状态</th>
                    <th class="">提交时间</th>

                </tr>

                @forelse($old_orders as $old_order)
                    <tr>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb" data_url="{{ route('admin.old_orders.edit',$old_order->id) }}">{{ $old_order->proid }}</a>
                        </td>
                        <td class="">{{ $old_order->userid }}{{ $old_order->remarks }}</td>
                        <td class="">{{ $old_order->mode }}</td>
                        <td class="">{{ config('status.old_status')[$old_order->prostatus] }}</td>
                        <td class="">{{ $old_order->totalprice }}</td>
                        <td class="">{{ config('status.old_fund')[$old_order->prostatuss] ?? '未付货款' }}</td>
                        <td class="">{{ $old_order->prodate }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
             {{ $old_orders->links() }}
            </form>

        </div>
    </div>

@endsection