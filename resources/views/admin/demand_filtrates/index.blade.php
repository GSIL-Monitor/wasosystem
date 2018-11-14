@extends('admin.layout.default')
@inject('DemandFiltrateParamenter','App\Presenters\DemandFiltrateParamenter')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create demand_filtrates')
                    <button class="changeWeb Btn" data_url="{{ route('admin.demand_filtrates.create') }}">添加</button>
                @endcan
                @can('delete demand_filtrates')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/demand_filtrates/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="demand_filtrates">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">修改时间</th>

                    <th  class="">操作</th>

                </tr>
                {!! $DemandFiltrateParamenter->tree($demand_filtrates,$prefix='',43) !!}
                {{--@forelse($demand_filtrates as $demand_filtrate)--}}
                    {{--<tr>--}}
                        {{--<td class="tableInfoDel">--}}
                            {{--<input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $demand_filtrate->id }}">--}}
                        {{--</td>--}}
                        {{--<td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"--}}
                                                                               {{--data_url="{{ route('admin.demand_filtrates.edit',$demand_filtrate->id) }}">{{ $demand_filtrate->name }}</a>--}}
                        {{--</td>--}}
                        {{--<th class="tableMoreHide">{{ $demand_filtrate->created_at->format('Y-m-d') }}</th>--}}
                        {{--<td class="">{{ $demand_filtrate->updated_at->format('Y-m-d') }}</td>--}}
                    {{--</tr>--}}
                    {{--@empty--}}
                     {{--<tr><td><div class='error'>没有数据</div></td></tr>--}}
                {{--@endforelse--}}
            </table>
            </form>
{{--             {{ $demand_filtrates->links() }}--}}
        </div>
    </div>

@endsection