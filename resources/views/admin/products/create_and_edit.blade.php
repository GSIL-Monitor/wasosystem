@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create products')
                    <button type="submit" class="Btn common_add" form_id="products"
                            location="top">@if(Route::is('admin.products.create'))添加@else
                            修改@endif</button>
                @elsecan('edit products')
                    <button type="submit" class="Btn common_add" form_id="products"
                            location="top">@if(Route::is('admin.products.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.products.form')
        </div>
    </div>

@endsection