@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create visitor_details')
                    <button class="changeWeb Btn" data_url="{{ route('admin.visitor_details.create') }}">添加</button>
                @endcan
                @if($valid=='no')
                @can('delete visitor_details')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/visitor_details/destory') }}">删除
                    </button>
                @endcan
                @endif
            </div>
            @include('admin.common._search',[
            'url'=>route('admin.visitor_details.index'),
            'status'=>['valid'=>$valid],
            'condition'=>[
                'source'=>'来源',
                'nickname'=>'姓名',
                'phone'=>'电话',
                'email'=>'邮箱',
            ]
            ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.visitor_details_valid'),'duiBiCanShu'=>$valid,'url'=>route('admin.visitor_details.index'),'canshu'=>'valid'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="visitor_details">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">访问时间</th>
                    <th  class="">来源</th>
                    <th  class="">姓名</th>
                    <th class="tableMoreHide">联系方式</th>
                    <th  class="tableMoreHide">位置</th>
                    <th  class="">成交情况</th>
                    <th  class="">搜索词</th>
                    <th  class="">关键词</th>
                    <th  class="">联系次数</th>
                    <th  class="">有效沟通</th>
                    <th  class="">值班客服</th>
                    <th  class="">是否会员</th>
                </tr>

                @forelse($visitor_details as $visitor_detail)

                    <tr>
                        <td class="tableInfoDel">
                            @if($valid=='yes')
                                --
                                @else
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $visitor_detail->id }}">
                            @endif
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb "
                                                                               data_url="{{ route('admin.visitor_details.edit',$visitor_detail->id) }}">{{ $visitor_detail->created_at }}
                            @if($visitor_detail->created_at==$visitor_detail->updated_at)
                                    <i class="newOrder"></i>
                                @endif
                            </a>
                        </td>
                        <td>{{ $visitor_detail->source}}</td>
                        @if($visitor_detail->user_id)
                        <td>{{ $visitor_detail->user->username ?? ''}} {{ $visitor_detail->nickname ?? $visitor_detail->user->nickname ?? ''}} </td>
                        <td class="tableMoreHide">{{ $visitor_detail->contact ?? $visitor_detail->user->contact ?? ''}}</td>
                            <td class="tableMoreHide">{{ $visitor_detail->address ?? $visitor_detail->user->address ?? ''}}</td>
                          <td>{{ isset($visitor_detail->user->deal) && $visitor_detail->user->deal==1? '已成交':'未成交' }}</td>
                        @else
                            <td>{{ $visitor_detail->nickname}}</td>
                            <td class="tableMoreHide">{{ $visitor_detail->contact}}</td>
                            <td class="tableMoreHide">{{ $visitor_detail->address}}</td>
                            <td>未成交</td>
                        @endif
                        <td>{{ $visitor_detail->search}}</td>
                        <td>{{ $visitor_detail->key}}</td>
                        <td>{{ config('status.visitor_details_contact_count')[$visitor_detail->contact_count] }}</td>
                        <td>{{ config('status.visitor_details_valid')[$visitor_detail->valid] }}</td>
                        <td>{{ $visitor_detail->admin_name->name ?? '' }} </td>
                        <td>{!!  $parameters['grades'][$visitor_detail->user->grade ?? ''] ?? '<span class="redWord" >非会员</span>' !!}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
               {{ $visitor_details->links('vendor.pagination.bootstrap-4',['data'=>'&valid='.$valid]) }}

            </form>
        </div>
    </div>

@endsection