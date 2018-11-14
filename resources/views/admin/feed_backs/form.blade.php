<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.feed_backs.create'))
            {!! Form::open(['route'=>'admin.feed_backs.store','method'=>'post','id'=>'feed_backs','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($feed_back,['route'=>['admin.feed_backs.update',$feed_back->id],'id'=>'feed_backs','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">feed_back：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'feed_back',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


