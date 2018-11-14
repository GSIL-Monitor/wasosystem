@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create demand_filtrates')
                    <button type="submit" class="Btn common_add" form_id="demand_filtrates"
                            location="top">@if(Route::is('admin.demand_filtrates.create'))添加@else
                            修改@endif</button>
                @elsecan('edit demand_filtrates')
                    <button type="submit" class="Btn common_add" form_id="demand_filtrates"
                            location="top">@if(Route::is('admin.demand_filtrates.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.demand_filtrates.form')
        </div>
    </div>

@endsection