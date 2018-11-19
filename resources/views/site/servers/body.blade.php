@inject('complete_machine_paramenter','App\Presenters\CompleteMachineParamenter')
@php
    $complete_machine_category=$complete_machine_paramenter->complete_machine_category();
    $storage=$complete_machine_paramenter->storage($common_complete_machines);
    $graphic_workstation_designer_computer=$complete_machine_paramenter->graphic_workstation_designer_computer($common_complete_machines);
    $common_complete_machines=$complete_machine_paramenter->complete_machine($common_complete_machines);
    $server_filters=$complete_machine_paramenter->server_filter($servers);
    $designer_filters=$complete_machine_paramenter->designer_filter($servers);
@endphp
<div class="P_con_box">
    <h5>筛选条件</h5>
    <div class="P_con_btn">
        <span class="P_sure">确定</span>
        <span class="P_cancel">取消</span>
        <div class="clear"></div>
    </div>
</div>
<!--  手机端 条件 -->


<div class="body" id="app">
    <div id="crumbs">
        <div class="wrap">
            <a href="/">首页</a> > 产品分类 > {{ $complete_machine_framework->name ?? '全部' }}
        </div>
    </div>

    <div class="wrap">
        <!--  手机端 搜索 开始-->
        <div class="P_pro_condition">
            {{--<div class="P_search">--}}
                {{--<form action="" method="get">--}}
                    {{--<input type="text" name="keyword" value="" placeholder="请输入产品关键字">--}}
                    {{--<button></button>--}}
                {{--</form>--}}
            {{--</div>--}}
            <span class="P_condition">筛选条件</span>
            <div class="clear"></div>
        </div>
    </div>
    <!--  手机端 搜索 结束-->
    <div class="ProType">
        <div class="wrap">
            <input id="con_sit" value="0" type="hidden">
            @if(str_contains(implode(' ', $type->jiagou), ['ND8000系列', 'ND9000系列', 'ND7000系列', '办公电脑系列', '图形工作站']))
                @includeIf('site.servers.conditions.designer_type')
                @else
                @includeIf('site.servers.conditions.server_type')
            @endif
            <div id="CompareBox" style="@if(count(session()->get('complete_machines') ?? []) > 0 ) display:block @endif">
                <div class="controler">
                    产品对比<i class="compareNum">{{ count(session()->get('complete_machines') ?? []) }}</i>
                    <div class="compareBtn"><a href="{{ route('server.comparisonShow') }}" target="_blank">开始对比</a><a class="clearAll" data_url="{{ route('server.comparisonAllRemove') }}">全部清空</a></div>
                </div>
            </div>

            <div id="condition">
                @if(str_contains(implode(' ', $type->jiagou), ['ND8000系列', 'ND9000系列', 'ND7000系列', '办公电脑系列', '图形工作站']))
                    @includeIf('site.servers.conditions.designer_condition')
                @else
                    @includeIf('site.servers.conditions.server_condition')
                @endif
                <div :class="{hide_condition:true,opend:condition_more}">
                    <div class="choosed">
                        <dl>
                            <dt>已选：</dt>
                            <dd class="clearAll" id="clearAll"><a href="{{ request()->url() }}">清除条件</a>
                            </dd>
                            <ul class="condition_list">
                                <template v-for='(item,index) in selected'>
                                    <li v-for="(item2,index2) in item"><div>@{{ item2 }}<span @click="del_selected(index,index2)">x</span></div></li>
                                </template>
                                <div class="clear"></div>
                            </ul>
                            <div class="clear"></div>
                        </dl>
                    </div>
                </div>
                <div class="condition_btn"><span :class="{close:condition_more}" @click="condition_m()"><em>@{{ condition_more ? '隐藏条件' : '更多条件' }}</em><i></i></span></div>
            </div>
        </div>
    </div>

    <div class="ProRight">
        <div class="wrap">
            <div class="server" >
            @includeIf('site.servers.product_list')
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
