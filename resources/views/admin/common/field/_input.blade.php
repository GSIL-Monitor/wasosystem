<li {!! $vue ?? '' !!}>
    <div class="liLeft">{{ $title }}：</div>
    <div class="liRight">
        {!!  Form::text($field,$field_val ?? old($field),array_merge(['placeholder'=>$title],$other)) !!}
    </div>
    <div class="clear"></div>
</li>