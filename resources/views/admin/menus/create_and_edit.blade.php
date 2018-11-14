@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
            <button class="Btn Refresh ">刷新</button>
                @can('create menus')
            <button type="submit" class="Btn common_add" form_id="menus" location="top">@if(Route::is('admin.menus.create'))添加@else
                    修改@endif</button>
                @elsecan('edit menus')
                    <button type="submit" class="Btn common_add" form_id="menus" location="top">@if(Route::is('admin.menus.create'))添加@else
                            修改@endif</button>
                @endcan
            <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.menus.form')
        </div>
    </div>

@endsection