@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create member_statuses')
                    <button type="submit" class="Btn common_add" form_id="member_statuses"
                            location="top">@if(Route::is('admin.member_statuses.create'))添加@else
                            修改@endif</button>
                @elsecan('edit member_statuses')
                    <button type="submit" class="Btn common_add" form_id="member_statuses"
                            location="top">@if(Route::is('admin.member_statuses.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.member_statuses.form')
        </div>
    </div>

@endsection