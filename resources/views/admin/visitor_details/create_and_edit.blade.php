@extends('admin.layout.default')
@php $grade=$visitor_detail->user->grade ?? '';@endphp
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create visitor_details')
                    <button type="submit" class="Btn common_add" form_id="visitor_details"
                            location="top">@if(Route::is('admin.visitor_details.create'))添加@else
                            修改@endif</button>
                @elsecan('edit visitor_details')
                    <button type="submit" class="Btn common_add" form_id="visitor_details"
                            location="top">@if(Route::is('admin.visitor_details.create'))添加@else
                            修改
                        @endif</button>
                @endcan
                @if($grade=='unverified')
                    {{-- 未认证--}}
                    <button class="changeWeb Btn"
                            data_url="{{ route('admin.users.edit',$visitor_detail->user_id) }}">认证会员</button>
                @endif
                @if($grade=='' && !empty($visitor_detail->id))
                    {{-- 还不是会员--}}
                    <button class="changeWeb Btn"    data_url="{{ route('admin.demand_managements.create') }}?visitor_details_id={{ $visitor_detail->id }}"
                            >生成需求</button>
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.visitor_details.form')
        </div>
    </div>

@endsection