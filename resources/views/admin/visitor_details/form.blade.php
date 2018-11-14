<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.visitor_details.create'))
            {!! Form::open(['route'=>'admin.visitor_details.store','method'=>'post','id'=>'visitor_details','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($visitor_detail,['route'=>['admin.visitor_details.update',$visitor_detail->id],'id'=>'visitor_details','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">客户来源：</div>
                <div class="liRight">
                    {!!  Form::select('source',$parameters['source'],old('source'),['placeholder'=>'客户来源',"class"=>'checkNull select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户姓名：</div>
                <div class="liRight">
                    {!!  Form::text('nickname',old('nickname',$visitor_detail->nickname  ?? $visitor_detail->user->nickname ??  ''),['placeholder'=>'客户姓名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">搜索词：</div>
                <div class="liRight">
                    {!!  Form::text('search',old('search'),['placeholder'=>'搜索词',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">关键词：</div>
                <div class="liRight">
                    {!!  Form::text('key',old('key'),['placeholder'=>'关键词',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户行业：</div>
                <div class="liRight">
                    {!!  Form::select('industry',$parameters['industry'],old('industry', $visitor_detail->industry ?? $visitor_detail->user->industry ?? ''),['placeholder'=>'客户行业',"class"=>'select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户位置：</div>
                <div class="liRight">
                    {!!  Form::text('address',old('address',$visitor_detail->address ?? $visitor_detail->user->address ?? '' ),['placeholder'=>'客户位置',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户电话：</div>
                <div class="liRight">
                    {!!  Form::text('phone',old('phone',$visitor_detail->phone ?? $visitor_detail->user->phone ??  ''),['placeholder'=>'客户电话',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户邮箱：</div>
                <div class="liRight">
                    {!!  Form::text('email',old('email',$visitor_detail->email ?? $visitor_detail->user->email ?? ''),['placeholder'=>'客户邮箱',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户QQ：</div>
                <div class="liRight">
                    {!!  Form::text('qq',old('qq', $visitor_detail->qq ?? $visitor_detail->user->qq ?? ''),['placeholder'=>'客户QQ',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户微信：</div>
                <div class="liRight">
                    {!!  Form::text('wechat',old('wechat',$visitor_detail->wechat ?? $visitor_detail->user->wechat ?? ''),['placeholder'=>'客户微信',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            @if(!Route::is('admin.visitor_details.create'))
            <li>
                <div class="liLeft">联系次数：</div>
                <div class="liRight">

                    {!!  Form::select('contact_count',config('status.visitor_details_contact_count'),old('contact_count'),['placeholder'=>'联系次数',"class"=>'select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
                <li>
                    <div class="liLeft">成交情况：</div>
                    <div class="liRight">
                        {{ isset($visitor_detail->user->deal) && $visitor_detail->user->deal==1? '已成交':'未成交' }}
                    </div>
                    <div class="clear"></div>
                </li>

            @endif
            <li>
                <div class="liLeft">值班客服：</div>
                <div class="liRight">
                    {{ $visitor_detail->admin_name->name ?? auth('admin')->user()->name }}
                    {!!  Form::hidden('admin',old('admin',$visitor_detail->admin ?? auth('admin')->user()->account),['placeholder'=>'值班客服',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">客户备注：</div>
                <div class="liRight">
                    @include('vendor.ueditor.assets')
                    <script id="container" name="details"   type="text/plain">
                        @if(!Route::is('admin.visitor_details.create'))
                            {!! $visitor_detail->details !!}
                        @endif
                    </script>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


