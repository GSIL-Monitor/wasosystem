<div class="right">

                <!--  编辑框  -->
                @include('member_centers.user_companies.create_edit')
                <div class="info" v-show="!create_edit">
                    <div class="tit bigTit">
                        <h5>企业信息</h5>
                        <p>填写企业信息，选择税票等税务信息。</p>
                    </div>
                    <div class="addreses">
                        <ul>
                            <li class="th">
                                <span class="num">序号</span>
                                <span class="name">企业全称</span>
                                <span class="type">含税类型</span>
                                <span class="peo">财务人员</span>
                                <span class="pho">联系电话</span>
                                <span class="oth">操作</span>
                                <div class="clear"></div>
                            </li>

                        @forelse($user_companies as $user_company)
                                <li class="tr">
                                    <em class="change_view" >
                                        <span class="num LikeBtn">{{ $user_company->number }}</span>
                                        <span class="name LikeBtn">{{ $user_company->name }}</span>
                                        <span class="type LikeBtn">{{ $user_company->invoice_type }}</span>
                                        <span class="peo LikeBtn">{{ $user_company->finance }}</span>
                                        <span class="pho LikeBtn">{{ $user_company->finance_phone }}</span>
                                        <span class="oth">
                                            <a class="change_edit" @click="edit('{{ route('user_companies.edit',$user_company->id) }}')"> 编辑</a>
                                            @if(!$user_company->default)
                                            <a class="Del" data_title="{{ $user_company->name }}" data_url="{{ url('/user_companies/destory') }}" data_id="{{ $user_company->id }}"> 删除 </a>
                                                <a class="noteIco @if(!$user_company->default) note @endif" @click="set_default('{{ route('user_companies.update',$user_company->id) }}')"> 设为默认 </a>
                                             @endif

                                        </span>
                                        <div class="clear"></div>
                                    </em>
                                    <div class="clear"></div>
                                    <dl class="LikeBtn">
                                        <dd>
                                            <div class="taTit">序号：</div>
                                            <div class="taCon">{{ $user_company->number }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">企业全称：</div>
                                            <div class="taCon">{{ $user_company->name }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">联系电话：</div>
                                            <div class="taCon">{{ $user_company->unit_phone }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">注册地址：</div>
                                            <div class="taCon">{{ $user_company->address }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">邮政编码：</div>
                                            <div class="taCon">{{ $user_company->zip }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">传真号码：</div>
                                            <div class="taCon">{{ $user_company->fax }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">企业网址：</div>
                                            <div class="taCon"><a href="" target="_blank">{{ $user_company->url }}</a></div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">含税类型：</div>
                                            <div class="taCon">{{ $user_company->invoice_type }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">企业税号：</div>
                                            <div class="taCon">{{ $user_company->tax_number }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">开户银行：</div>
                                            <div class="taCon">{{ $user_company->opening_bank }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">银行账号：</div>
                                            <div class="taCon">{{ $user_company->account }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">开户行地址：</div>
                                            <div class="taCon">{{ $user_company->bank_address }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">开户行电话：</div>
                                            <div class="taCon">{{ $user_company->bank_phone }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">财务人员：</div>
                                            <div class="taCon">{{ $user_company->finance }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">财务电话：</div>
                                            <div class="taCon">{{ $user_company->finance_phone }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">票据收件信息：</div>
                                            <div class="taCon">{{ $user_company->logistics }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <div class="clear"></div>
                                    </dl>
                                </li>
                            @empty
                                <li>没有企业信息</li>
                          @endforelse
                        </ul>

                        <div class="btns">
                            <button class="AllBtn" @click="create()">新增企业信息</button>
                        </div>
                    </div>
                    <!--   地址表格完成  -->

                </div>
            </div>