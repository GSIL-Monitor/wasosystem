<li {!! $vue ?? '' !!}>
    <div class="liLeft">{{ $title }}：</div>
    <div class="liRight">
        {!!  Form::select($field,$field_list,old($field),$other) !!}
    </div>
    <div class="clear"></div>
</li>