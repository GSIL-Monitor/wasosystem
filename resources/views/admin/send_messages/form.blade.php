<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.send_messages.create'))
            {!! Form::open(['route'=>'admin.send_messages.store','method'=>'post','id'=>'send_messages','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($send_message,['route'=>['admin.send_messages.update',$send_message->id],'id'=>'send_messages','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">send_message：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'send_message',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


