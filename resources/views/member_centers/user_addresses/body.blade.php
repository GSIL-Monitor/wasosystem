<div class="right">

                <!--  编辑框  -->
                @include('member_centers.user_addresses.create_edit')
                <div class="info" v-show="!create_edit">
                    <div class="tit bigTit">
                        <h5>收货地址</h5>
                        <p></p>
                    </div>
                    <div class="addreses">
                        <ul>
                            <li class="th">
                                <span class="num">序号</span>
                                <span class="name">收货地址</span>
                                <span class="type">收货人</span>
                                <span class="peo">联系电话</span>
                                <span class="oth">操作</span>
                                <div class="clear"></div>
                            </li>

                        @forelse($user_addresses as $user_address)
                                <li class="tr">
                                    <em class="change_view" >
                                        <span class="num LikeBtn">{{ $user_address->number }}</span>
                                        <span class="name LikeBtn">{{ $user_address->address }}</span>
                                        <span class="type LikeBtn">{{ $user_address->name }}</span>
                                        <span class="peo LikeBtn">{{ $user_address->phone }}</span>
                                        <span class="oth">
                                            <a class="change_edit" @click="edit('{{ route('user_addresses.edit',$user_address->id) }}')"> 编辑</a>
                                            @if(!$user_address->default)
                                            <a class="Del" data_title="{{ $user_address->name }}" data_url="{{ url('/user_addresses/destory') }}" data_id="{{ $user_address->id }}"> 删除 </a>
                                                <a class="noteIco @if(!$user_address->default) note @endif" @click="set_default('{{ route('user_addresses.update',$user_address->id) }}')"> 设为默认 </a>
                                             @endif

                                        </span>
                                        <div class="clear"></div>
                                    </em>
                                    <div class="clear"></div>
                                    <dl class="LikeBtn">
                                        <dd>
                                            <div class="taTit">序号：</div>
                                            <div class="taCon">{{ $user_address->number }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">收货人：</div>
                                            <div class="taCon">{{ $user_address->name }}</div>
                                        </dd>

                                        <dd>
                                            <div class="taTit">收货地址：</div>
                                            <div class="taCon">{{ $user_address->address }}</div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">联系电话：</div>
                                            <div class="taCon">{{ $user_address->phone }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">备用电话：</div>
                                            <div class="taCon">{{ $user_address->alternative_phone }}</div>
                                            <div class="clear"></div>
                                        </dd>
                                        <dd>
                                            <div class="taTit">指定物流：</div>
                                            <div class="taCon">{{ $user_address->logistics }}</div>
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
