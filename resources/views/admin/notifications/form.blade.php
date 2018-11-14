<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.notifications.create'))
            {!! Form::open(['route'=>'admin.notifications.store','method'=>'post','id'=>'notifications','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($notification,['route'=>['admin.notifications.update',$notification->id],'id'=>'notifications','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li >
                <div class="liLeft">公告标题：</div>
                <div class="liRight">
                    {!!  Form::text('title',old('title'),['placeholder'=>'请填写公告标题']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">发送组：</div>
                <div class="liRight">
                    @foreach($userGrades as $key=>$userGrade)
                    <label for="{{ $key }}">
                    {!!  Form::checkbox('to_user[]',$key,old('to_user[]'),["class"=>'grades','id'=>$key]) !!}
                    {{ $userGrade }}
                    </label>
                    @endforeach
                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">指定用户：</div>
                <div class="liRight">
                    {!!  Form::select('user[]',$users,old('user[]',$notification->to_user ?? []),["class"=>' select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li >
                <div class="liLeft">公告内容：</div>
                <div class="liRight">
                    {!!  Form::textarea('content',old('content'),["class"=>'content','placeholder'=>'请填写公告内容']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>



