@extends('admin.layout.default')
@section('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                date:'',
                @if(Route::is('admin.services.create'))
                'disabled': false,
                @else
                 date:"{!! $service->door_of_time !!}",
                'disabled': true
                @endif
            }
        });
        $(function () {
            $(document).on('change', '.quality_assurance_model', function () {
                if ($(this).val() == 'complete_machine') {
                    $('.SelectAll').click()
                    $('.sevenLi').find('.error').remove();
                } else {
                    if ($('.SelectAll').is(':checked')) {
                        $('.SelectAll').click()
                    }
                }
            })
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.services.create'))
                    @can('create services')
                        <button type="submit" class="Btn common_add" form_id="services"
                                location="top">添加
                        </button>
                    @endcan
                @else
                    @can('edit services')
                        <button type="submit" class="Btn common_add" form_id="services"
                                location="top">修改
                        </button>
                    @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            @if(Route::is('admin.services.create'))
                @include('admin.common._search',[
                  'url'=>route('admin.services.create'),
                  'status'=>array_except(Request::all(),['type','keyword','_token']),
                  'condition'=>[
                      'serial_number'=>'订单序列号',
                      'code'=>'条码',
                  ]
                  ])
            @endif

            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.services.form')
        </div>
    </div>

@endsection