@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.business_managements.about') || Route::is('admin.business_managements.copyright'))
                    <button type="submit" class="Btn common_add" form_id="business_managements"
                            location="top">保存
                    </button>
                @else
                    <button type="submit" class="Btn common_add" form_id="business_managements"
                            location="top">@if(!optional($business_management)->id  || !optional($business_management)->id)添加@else
                            修改@endif</button>
                    <button class="changeWebClose Btn">返回</button>
                @endif

            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @if(Route::is('admin.business_managements.about') )
                @include('admin.business_managements.form.about_form')
            @elseif(Route::is('admin.business_managements.copyright'))
                @include('admin.business_managements.form.copyright_form')
            @else
                @include('admin.business_managements.form')
            @endif

        </div>
    </div>

@endsection