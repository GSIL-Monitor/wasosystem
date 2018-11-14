@foreach($server_selections as $server_selection)
    <dl>
        <dt><b>{{ $server_selection->name }}（@if($server_selection->select_type == 'radio')单选 @else 复选 @endif）<em> {{ $server_selection->description }}</em></b><i class="trans ModeIco"></i></dt>
        <dd class="trans">
            <ul class="@if($server_selection->select_type == 'radio')radioLi @else checkBoxLi @endif">
                @if(count($server_selection->children) > 0)
                    @foreach($server_selection->children as $child)
                        <li name="{{ $child->id }}"><img src="{{ pic($child->child->pic)[0]['url'] ??  '' }}"><h1>{{ $child->name }}</h1></li>
                    @endforeach
                @endif
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </dd>
        <dd class="errorMSG">至少选择一项</dd>
    </dl>
    @break($loop->index == 0)
@endforeach