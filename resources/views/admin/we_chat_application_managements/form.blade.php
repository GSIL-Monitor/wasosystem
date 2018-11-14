<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.we_chat_application_managements.create'))
            {!! Form::open(['route'=>'admin.we_chat_application_managements.store','method'=>'post','id'=>'we_chat_application_managements','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($we_chat_application_management,['route'=>['admin.we_chat_application_managements.update',$we_chat_application_management->id],'id'=>'we_chat_application_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">应用标识：</div>
                <div class="liRight">
                    {!!  Form::text('identifying',old('identifying'),['placeholder'=>'应用唯一标识  在推送消息时使用',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">应用ID：</div>
                <div class="liRight">
                    {!!  Form::text('agentId',old('agentId'),['placeholder'=>'AgentId',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">应用名：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'应用名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">secret</div>
                <div class="liRight">
                    {!!  Form::text('secret',old('secret'),['placeholder'=>'secret',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">应用描述</div>
                <div class="liRight">
                    {!!  Form::textarea('description',old('description'),['placeholder'=>'应用描述',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


