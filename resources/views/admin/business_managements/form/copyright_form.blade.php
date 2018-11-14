<div class="JJList">
    <ul class="maxUl" id="app">
        @if(!optional($copyright)->id)
            {!! Form::open(['route'=>'admin.business_managements.store','method'=>'post','id'=>'business_managements','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($copyright,['route'=>['admin.business_managements.update',$copyright->id],'id'=>'business_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li class="sevenLi">
                <div class="liLeft">版权声明</div>
                <div class="liRight">
                    <input type="hidden" name="type" value="copyright">
                    @include('vendor.ueditor.assets')
                    <script id="container" name="field[content]"   type="text/plain">
                        {!! optional($copyright)->field['content'] !!}
                    </script>
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


