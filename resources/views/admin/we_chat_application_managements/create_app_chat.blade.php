@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>

                    @can('create we_chat_application_managements')
                        <button type="submit" class="Btn common_add" form_id="we_chat_application_managements"
                                location="top">添加</button>
                    @endcan

                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.we_chat_application_managements.form.app_chart')
        </div>
    </div>

@endsection