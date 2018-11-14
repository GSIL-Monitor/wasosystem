@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create self_build_terraces')
                    <button type="submit" class="Btn common_add" form_id="self_build_terraces"
                            location="top">@if(Route::is('admin.self_build_terraces.create'))添加@else
                            修改@endif</button>
                @elsecan('edit self_build_terraces')
                    <button type="submit" class="Btn common_add" form_id="self_build_terraces"
                            location="top">@if(Route::is('admin.self_build_terraces.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.self_build_terraces.form')
        </div>
    </div>

@endsection