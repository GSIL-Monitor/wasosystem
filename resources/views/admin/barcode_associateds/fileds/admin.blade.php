<li>
    <div class="liLeft">采购人员：</div>
    <div class="liRight">
        @php
            $admin_account=$barcode_associated['admin']->pluck('name','account');
            $admin_id=$barcode_associated['admin']->pluck('name','id');
        @endphp
        {!!  Form::text(null,
        $admin_id[$barcode_associated['procurement_plan']->purchase ?? ''
        ],['placeholder'=>'采购人员',"class"=>'checkNull','readonly']) !!}
    </div>
    <div class="clear"></div>
</li>

<li>
    <div class="liLeft">操作人员：</div>
    <div class="liRight">
        {!!  Form::hidden('admin',old('admin',admin()->id),['placeholder'=>'操作人员',"class"=>'checkNull','readonly']) !!}
        {!!  Form::text(null,admin()->name,['placeholder'=>'操作人员',"class"=>'checkNull','readonly']) !!}
    </div>
    <div class="clear"></div>
</li>
@if(!empty($barcode_associated['order']))
    <li>
        <div class="liLeft">经办人：</div>
        <div class="liRight">
            {!!  Form::text(null,$barcode_associated['order']->markets->name  ?? $admin_id[$barcode_associated['user']->administrator] ,['placeholder'=>'当前事件',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
@endif