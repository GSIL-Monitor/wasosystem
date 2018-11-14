@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create user_companies')
                    <button type="submit" class="Btn common_add" form_id="user_companies"
                            location="top">@if(Route::is('admin.user_companies.create'))添加@else
                            修改@endif</button>
                @elsecan('edit user_companies')
                    <button type="submit" class="Btn common_add" form_id="user_companies"
                            location="top">@if(Route::is('admin.user_companies.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.user_companies.form')
        </div>
    </div>

@endsection