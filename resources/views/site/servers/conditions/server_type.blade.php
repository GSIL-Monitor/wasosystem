<dl>
    <dt>分类：</dt>
    <dd><a href="{{ route('server.index','complete_machine') }}" class="@if(!$complete_machine_framework && $id != 'storage') a2 @endif">全部</a></dd>
    <dd><a href="{{ route('server.index','storage') }}" class="@if(!$complete_machine_framework && $id == 'storage') a2 @endif">存储服务器</a></dd>
    @foreach($common_complete_machines as $key=>$complete_machine)
        @if($key !='0' && $key !='')
            <dd><a class="@if($complete_machine_framework && $complete_machine_framework->name == $key) a2 @endif" href="{{ route('server.index',$complete_machine_category[$key]) }}">{{ $key }}</a></dd>
        @endif
    @endforeach
    <div class="clear"></div>
</dl>