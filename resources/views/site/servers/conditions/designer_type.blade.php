<dl>
    <dt>分类：</dt>
    <dd><a href="{{ route('server.index','graphic_workstation_designer_computer') }}" class="@if(!$complete_machine_framework && $id != 'storage') a2 @endif">全部</a></dd>
    @foreach($graphic_workstation_designer_computer as $key=>$complete_machine)
        @if($key !='0')
            <dd><a class="@if($complete_machine_framework && $complete_machine_framework->name == $key) a2 @endif" href="{{ route('server.index',$complete_machine_category[$key]) }}">{{ $key }}</a></dd>
        @endif
    @endforeach
    <div class="clear"></div>
</dl>