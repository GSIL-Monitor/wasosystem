@extends('admin.layout.default')
@section('js')
    <script>

        var vm = new Vue({
            el: "#app",
            data: {
                @if(Route::is('admin.information_managements.create'))
                defaultList: [],
                @else
                defaultList:{!! $information_management->pic !!},
                @endif
                actionImageUrl: "{!! env('ActionImageUrl') !!}",
                imageUrl: "{!! env('IMAGES_URL') !!}",
                deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
                fileCount:1,
            },
            methods: {

            },
            mounted: function () {
            },
        });

    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.information_managements.create'))
                @can('create information_managements')
                    <button type="submit" class="Btn common_add" form_id="information_managements"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit information_managements')
                    <button type="submit" class="Btn common_add" form_id="information_managements"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.information_managements.form')
        </div>
    </div>

@endsection