@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="Btn" >{{ $user->username }} {{ $user->nickname }}</button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            @include('admin.common._search',
            ['placeholder'=>'请输入订单号',
            'url'=>route('admin.funds_managements.financial_details').'?user_id='.$user->id,
             'status'=>array_except(Request::all(),['type','keyword','_token','page']),
            ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="funds_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">交易类型</th>
                    <th  class="">交易金额</th>
                    <th class="">交易时间</th>
                    <th class="">操作人员</th>
                    <th class="tableInfoDel">信息备注</th>
                    <th class="tableMoreHide">信息备注</th>
                </tr>


                @forelse($financial_details as $financial_detail)

                    <tr>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            @if($financial_detail->type == 'deposit')
                                存入
                            @elseif($financial_detail->type == 'pay')
                                支付
                            @else
                                定金
                            @endif
                        </td>
                        <td  class="">{{ $financial_detail->price }}</td>
                        <td class="">{{ $financial_detail->created_at }}</td>
                        <td class="">{{ $financial_detail->admin->name }}</td>
                        <td class="tableInfoDel">{{ str_limit($financial_detail->comment,50) }}</td>
                        <td class="tableMoreHide">{{ $financial_detail->comment }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                {{ $financial_details->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())]) }}
            </form>

        </div>
    </div>

@endsection