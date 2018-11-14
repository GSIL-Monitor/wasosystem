@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create integration_categories')
                    <button type="submit" class="Btn common_add" form_id="integration_categories"
                            location="top">@if(Route::is('admin.integration_categories.create'))添加@else
                            修改@endif</button>
                @elsecan('edit integration_categories')
                    <button type="submit" class="Btn common_add" form_id="integration_categories"
                            location="top">@if(Route::is('admin.integration_categories.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.integration_categories.form')
        </div>
    </div>

@endsection