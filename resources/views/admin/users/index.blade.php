@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create users')
                    <button class="changeWeb Btn" data_url="{{ route('admin.users.create') }}">添加会员</button>
                @endcan

                @if(Request::has('source'))
                    <button class="changeWebClose Btn">返回</button>
                @endif
                @can('edit users')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @if($status!='VerifiedUser')
                    @can('delete users')
                        <button type="submit" class="red Btn AllDel" form="AllDel"
                                data_url="{{ url('/waso/users/destory') }}">删除
                        </button>
                    @endcan
                @endif

            </div>
            @if($status=='VerifiedUser')
                @include('admin.common._search',[
              'url'=>route('admin.users.index'),
              'status'=>array_except(Request::all(),['type','keyword','_token','page']),
              'condition'=>['username'=>'账号',
                    'nickname'=>'姓名',
                    'unit'=>'单位',
                    'phone'=>'电话'
                 ]
              ])
            @endif
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.user'),'duiBiCanShu'=>$status,'url'=>route('admin.users.index'),'canshu'=>'status','link'=>Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' ])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="users">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                        @if(Request::has('source'))
                        <th class="">需求</th>
                        @endif
                        <th class="tableInfoDel">账号</th>
                        <th class="">姓名</th>
                        <th class="">单位简称</th>
                        <th class="">默认单位</th>
                        <th class="">单位简码</th>
                        <th class="">配件选购</th>
                        <th class="">级别</th>
                        <th class="">账期(天)</th>
                        <th class="">管理员</th>
                        <th class="tableMoreHide">添加时间</th>
                        <th class="">最后登陆时间</th>
                        <th class="">操作</th>

                    </tr>

                    @foreach($users as $user)
                        @php
                            $company=$user->user_company->firstWhere('default','=',1);
                        @endphp
                        <tr>
                            <td class="tableInfoDel">
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $user->id }}">
                            </td>
                            @if(Request::has('source'))
                                <td class=""><a class="changeWeb" data_url="{{ route('admin.demand_managements.create')}}?user_id={{ $user->id }}">添加</a></td>
                            @endif
                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                <a class="changeWeb " data_url="{{ route('admin.users.edit',$user->id) }}">
                                    {{ $user->username }}
                                    @if($user->newUser())  <i class="newOrder"></i> @endif
                                </a>
                            </td>
                            <td>{{ $user->nickname }}</td>
                            <td>{{ $user->unit }}</td>
                            <td>{{ $company->name ?? ''  }}</td>
                            <td>{{ $company->unit_code ?? '' }}</td>
                            <td>
                                <label for="{{ 'parts_buy'.$user->id }}">
                                    {{ Form::checkbox('edit['.$user->id.'][parts_buy]',$user->parts_buy,old('edit['.$user->id.'][parts_buy]',$user->parts_buy),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'parts_buy'.$user->id]) }}
                                </label>
                            </td>
                            <td>{{ $user->grades->name }}</td>
                            <td>{{ $user->payment_days }}</td>
                            <td>{{ $user->admins->name ?? '' }}</td>
                            <td class="tableMoreHide">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>{{ $user->last_login_time }}</td>
                            <td>
                                    <a class="changeWeb"
                                       data_url="{{ route('admin.user_addresses.index') }}?user_id={{ $user->id }}">物流</a>
                                    <a class="changeWeb"
                                       data_url="{{ route('admin.user_companies.index') }}?user_id={{ $user->id }}">单位</a>
                                    <a class="changeWeb"
                                       data_url="{{ route('admin.common_equipments.index') }}?user_id={{ $user->id }}">常用</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->appends(Request::except('page'))->links() }}

            </form>
        </div>
    </div>

@endsection