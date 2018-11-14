<div class="JJList">
    <ul class="maxUl" >
        @if(Route::is('admin.products.create'))
            {!! Form::open(['route'=>'admin.products.store','method'=>'post','id'=>'products']) !!}
        @else
            {!! Form::model($product,['route'=>['admin.products.update',$product->id],'id'=>'products','method'=>'put']) !!}
        @endif
            <li>
                <div class="liLeft">配件编号：</div>
                <div class="liRight">
                    {!!  Form::text('bianhao',old('bianhao'),['placeholder'=>'请输入配件编号',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">配件名：</div>
                <div class="liRight">
                    {!!  Form::text('title',old('title'),['placeholder'=>'请输入配件名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">配件简码：</div>
                <div class="liRight">
                    {!!  Form::textarea('jianma',old('jianma'),['placeholder'=>'请输入配件简码']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


