<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.member_statuses.create'))
            {!! Form::open(['route'=>'admin.member_statuses.store','method'=>'post','id'=>'member_statuses','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($member_status,['route'=>['admin.member_statuses.update',$member_status->id],'id'=>'member_statuses','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">所属分类：</div>
                <div class="liRight">
                    {!!  Form::hidden('type',old('type'),['placeholder'=>'所属分类',"class"=>'checkNull','readonly']) !!}
                    {!!  Form::text('type1',old('type1',config('status.userStatus')[Request::get('type') ?? $member_status->type]),['placeholder'=>'所属分类',"class"=>'checkNull','readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">状态标识：</div>
                <div class="liRight">
                    @if(Route::is('admin.member_statuses.create'))
                        {!!  Form::text('identifying',old('identifying'),['placeholder'=>'请输入'.config('status.userStatus')[Request::get('type') ?? $member_status->type].'标识',"class"=>'checkNull']) !!}
                    @else
                        {!!  Form::text('identifying',old('identifying'),['placeholder'=>'请输入'.config('status.userStatus')[Request::get('type') ?? $member_status->type].'标识',"class"=>'checkNull','readonly']) !!}
                    @endif
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">状态名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入'.config('status.userStatus')[Request::get('type') ?? $member_status->type].'名称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


