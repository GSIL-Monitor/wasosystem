<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.user_companies.create'))
            {!! Form::open(['route'=>'admin.user_companies.store','method'=>'post','id'=>'user_companies','onsubmit'=>'return false']) !!}
            {!!  Form::hidden('user_id',old('user_id')) !!}
        @else
            {!! Form::model($user_company,['route'=>['admin.user_companies.update',$user_company->id],'id'=>'user_companies','method'=>'put','onsubmit'=>'return false']) !!}
        @endif

            <li>
                <div class="liLeft">序号：</div>
                <div class="liRight">
                    {!!  Form::select('number',letter(),old('number'),['placeholder'=>'序号',"class"=>'checkNull select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'单位名称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位简称：</div>
                <div class="liRight">
                    {!!  Form::text('unit',old('unit'),['placeholder'=>'单位简称',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位简码：</div>
                <div class="liRight">
                    {!!  Form::text('unit_code',old('unit_code'),['placeholder'=>'单位简码',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位地址：</div>
                <div class="liRight">
                    {!!  Form::text('address',old('address'),['placeholder'=>'单位地址',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位电话：</div>
                <div class="liRight">
                    {!!  Form::text('unit_phone',old('unit_phone'),['placeholder'=>'单位电话',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位传真：</div>
                <div class="liRight">
                    {!!  Form::text('fax',old('fax'),['placeholder'=>'单位传真',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位邮编：</div>
                <div class="liRight">
                    {!!  Form::text('zip',old('zip'),['placeholder'=>'单位邮编',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">官方网址：</div>
                <div class="liRight">
                    {!!  Form::text('url',old('url'),['placeholder'=>'官方网址',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">含税模式：</div>
                <div class="liRight">
                    {!!  Form::select('tax_mode',$parameters['invoice'],old('tax_mode'),['placeholder'=>'含税模式',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位税号：</div>
                <div class="liRight">
                    {!!  Form::text('tax_number',old('tax_number'),['placeholder'=>'单位税号',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位帐号：</div>
                <div class="liRight">
                    {!!  Form::text('account',old('account'),['placeholder'=>'单位帐号',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">开户行：</div>
                <div class="liRight">
                    {!!  Form::text('opening_bank',old('opening_bank'),['placeholder'=>'开户行',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">开户行地址：</div>
                <div class="liRight">
                    {!!  Form::text('bank_address',old('bank_address'),['placeholder'=>'开户行地址',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">开户行电话：</div>
                <div class="liRight">
                    {!!  Form::text('bank_phone',old('bank_phone'),['placeholder'=>'开户行电话',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">财务人员：</div>
                <div class="liRight">
                    {!!  Form::text('finance',old('finance'),['placeholder'=>'财务人员',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">财务电话：</div>
                <div class="liRight">
                    {!!  Form::text('finance_phone',old('finance_phone'),['placeholder'=>'财务电话',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">票据物流：</div>
                <div class="liRight">
                    {!!  Form::text('logistics',old('logistics'),['placeholder'=>'票据物流',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>


            <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


