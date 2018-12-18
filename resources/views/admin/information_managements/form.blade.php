<div class="zyw">
    <div class="zyw_left " id="app">
        <ul class="zywUl">

            @if(Route::is('admin.information_managements.create'))
                {!! Form::open(['route'=>'admin.information_managements.store','method'=>'post','id'=>'information_managements','onsubmit'=>'return false']) !!}
            @else
                {!! Form::model($information_management,['route'=>['admin.information_managements.update',$information_management->id],'id'=>'information_managements','method'=>'put','onsubmit'=>'return false']) !!}
            @endif
            <li class="allLi">
                <div class="liLeft">标题：</div>
                <div class="liRight">
                    {!!  Form::hidden('type',old('type',Request::get('type')),['placeholder'=>'请填写资讯标题',"class"=>'checkNull']) !!}
                    {!!  Form::text('name',old('name'),['placeholder'=>'请填写资讯标题',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">标题图：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">发布：</div>
                <div class="liRight">
                    <label for="show">{{ Form::checkbox('marketing[show]',0,old('marketing[show]'),['id'=>'show','class'=>'radio']) }}发布</label>
                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">标签：</div>
                <div class="liRight">
                    @foreach(config('status.information_management_marketing') as $key=>$status)
                        <label for="marketing{{ $key }}">
                            {{ Form::checkbox('marketing['.$key.']',0,null,['id'=>'marketing'.$key,'class'=>'radio']) }}
                            {{ $status }}
                        </label>
                    @endforeach
                </div>
                <div class="clear"></div>
            </li>

            <li class="allLi">
                <div class="liLeft">描述：</div>
                <div class="liRight">
                    {!!  Form::textarea('description',old('description'),['placeholder'=>'资讯描述',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">相关整机：</div>
                <div class="liRight">
                    {!!  Form::select('complete_machines[]',$complete_machines,old('complete_machines[]',$complete_machine),['相关整机'=>'所属分类',"class"=>' select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
                <li class="allLi">
                    <div class="liLeft">文章内容：</div>
                    <div class="liRight">
                        @include('vendor.ueditor.assets')
                        <script id="container" name="content"   type="text/plain">
                            @if(!Route::is('admin.information_managements.create'))
                                {!! optional($information_management)->content !!}
                            @endif
                        </script>
                    </div>
                    <div class="clear"></div>
                </li>
            {!! Form::close() !!}

        </ul>
    </div>



</div>




