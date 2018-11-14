<div class="JJList">
    <ul class="maxUl" id="app">
        @if(!optional($about)->id)
            {!! Form::open(['route'=>'admin.business_managements.store','method'=>'post','id'=>'business_managements','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($about,['route'=>['admin.business_managements.update',$about->id],'id'=>'business_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li class="sevenLi">
                <div class="liLeft">关于我们</div>
                <div class="liRight">
                    <input type="hidden" name="type" value="about">
                    @include('vendor.ueditor.assets')
                    <script id="container" name="field[content]"   type="text/plain">
                        {!! optional($about)->field['content'] !!}
                    </script>
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


