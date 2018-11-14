@extends('admin.layout.default')
@inject('ServiceManagementParamenter','App\Presenters\ServiceManagementParamenter')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/progress.css') }}">
@endsection
@section('js')


@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">
                    <dl>
                        <dt>年份：</dt>
                        <dd>
                            @foreach($years as $item)
                                <a href="{{ route('admin.services.repair_statistics') }}?year={{  $item }}"
                                   class="@if($year==$item) active @endif">{{ $item }}</a>
                            @endforeach
                        </dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>月份：</dt>
                        <dd>
                            @foreach($mouths as $item)
                                <a href="{{ route('admin.services.repair_statistics') }}?year={{ $year }}&mouth={{ $item }}"
                                   class="@if($mouth==$item) active @endif">{{ $item }}</a>
                            @endforeach
                        </dd>
                        <div class="clear"></div>
                    </dl>
                </div>
                <b class="tips">数据仅供参考！</b>
            </div>
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="services">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel">管理员</th>
                        <th class="">月参与单数</th>
                        <th class="">返修率</th>
                    </tr>
                    @forelse($admins as $key=>$item)
                        @if(!empty($admin_lists[$key]))
                            <tr>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    {{ $admin_lists[$key] }}({{ $key }})
                                </td>
                                <td class="">{{ $item }}</td>
                                <td class="">
                                    @if(!empty($service_admins[$key]))
                                        {{ round($service_admins[$key] / $item , 2) * 100 }}
                                    @else
                                        0
                                    @endif
                                    %
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td>
                                <div class='error'>没有数据</div>
                            </td>
                        </tr>
                    @endforelse
                </table>
                {{--{{ $services->links() }}--}}
            </form>
        </div>
    </div>
@endsection