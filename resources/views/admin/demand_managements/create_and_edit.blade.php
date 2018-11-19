@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/create_order.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change','.filtrate',function () {
             filtrate($(this),"{{ route('admin.demand_managements.filtrateList') }}")
            })
        });

    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.demand_managements.create'))
                @can('create demand_managements')
                    <button type="submit" class="Btn common_add" form_id="demand_managements"
                            location="top">添加</button>
                @endcan
                    @else
                    @can('edit demand_managements')
                    <button type="submit" class="Btn common_add" form_id="demand_managements"
                            location="top">修改 </button>
                        <button class="Btn changeWeb" data_url="{{ route('admin.demand_managements.show',$demand_management->id) }}">生成初步方案 </button>
                        {{--<button class="Btn" >指定关联订单 </button>--}}
                        <button class="Btn AllDel"  data_url="{{ url('/waso/demand_managements/destory') }}?delOrder=allDelete&demand_management_id={{ $demand_management->id }}">删除关联订单</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.demand_managements.form')
        </div>
    </div>

@endsection