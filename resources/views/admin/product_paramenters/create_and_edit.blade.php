@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create product_paramenters')
                    <button type="submit" class="Btn common_add" form_id="product_paramenters"
                            location="top">@if(Route::is('admin.product_paramenters.create'))添加@else
                            修改@endif</button>
                @elsecan('edit product_paramenters')
                    <button type="submit" class="Btn common_add" form_id="product_paramenters"
                            location="top">@if(Route::is('admin.product_paramenters.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.product_paramenters.form')
        </div>
    </div>

@endsection