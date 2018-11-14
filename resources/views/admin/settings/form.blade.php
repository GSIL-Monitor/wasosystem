<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.settings.create'))
            {!! Form::open(['route'=>'admin.settings.store','method'=>'post','id'=>'settings','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($settings,['route'=>['admin.settings.update',$settings->id],'id'=>'settings','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">settings：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'settings',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


