<li {!! $vue ?? '' !!}>
    <div class="liLeft">{{ $title }}：</div>
    <div class="liRight">
        {!!  Form::textarea($field,$field_val,$other) !!}
    </div>
    <div class="clear"></div>
</li>