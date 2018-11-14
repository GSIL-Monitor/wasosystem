@extends('admin.layout.default')
@section('js')
    <script>
        $(function () {
            $(document).on('click','.grades',function () {
                var val=$(this).val();
                if(val == 'all' && $(this).prop('checked')){
                    $('.grades').eq(0).parent('label').find('input').attr('disabled',false)
                    $(this).parent('label').siblings('label').hide().find('input').attr('disabled',true).prop('checked',false);
                }else{
                    $('.grades').eq(0).parent('label').hide().find('input').attr('disabled',true).prop('checked',false);
                   $(this).parent('label').siblings('label').show().find('input').attr('disabled',false)
                }
                $(this).parent('label').siblings('.error').remove()
            });
            $(document).on('keyup','.content',function () {
                var val=$(this).val();
                if(val != '' ){
                    $(this).siblings('.error').remove()
                }else{
                    showError( $(this),'内容不能为空');
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.notifications.create'))
                @can('create notifications')
                    <button type="submit" class="Btn common_add" form_id="notifications"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit notifications')
                    <button type="submit" class="Btn common_add" form_id="notifications"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.notifications.form')
        </div>
    </div>

@endsection