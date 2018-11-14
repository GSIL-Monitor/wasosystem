<div class="tips">
    <p>指数由处理器的主频、核心数、线程数综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
</div>

<table class="listTable">
    <tr class="tableTh">
        <th class="tableInfoDel tablePhoneShow">
            <div class="thTxt">排序</div>
        </th>
        <th class="tableName tableInfoDel">
            <div class="thTxt">产品规格</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="jiancheng,asc"></i>
                <i class="ZtoA" good="cpu" order="jiancheng,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">架构</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="framework_name,asc"></i>
                <i class="ZtoA" good="cpu" order="framework_name,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">主频(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="zhu_pin,asc"></i>
                <i class="ZtoA" good="cpu" order="zhu_pin,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">核心(C)/线程(H)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="thread,asc"></i>
                <i class="ZtoA" good="cpu" order="thread,desc"></i>
            </div>
        </th>

        <th class="tableInfoDel tablePhoneShow activeTh">
            <div class="thTxt">指数</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="index,asc"></i>
                <i class="ZtoA active" good="cpu" order="index,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">变化</div>
            <div class="paiIcon"></div>
        </th>
    </tr>
   @foreach($cpus['cpu_lists'] as $cpu)
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                @if($cpu->id == $cpus['top'])
                   <i class='tableTopXu'></i>
                   @else
                   {{ $loop->iteration }}
                @endif
            </td>
            <td class="tableName">{{ $cpu->jiancheng }}</td>
            <td>{{ $cpu->framework_name }}</td>
            <td>{{ floatval($cpu->details['zhu_pin']) }}G</td>
            <td>{{ $cpu->details['c_h'] }}</td>
            <td class="tableInfoDel tablePhoneShow ">{{ round($cpu->index,2) }}</td>
            <td>
                @switch($cpu->float)
                    @case("come-up")
                    <i class="tableSitu goUp"></i>
                    @break
                    @case("lower")
                    <i class="tableSitu goDown"></i>
                    @break
                    @default
                    <i class="tableSitu goHold"></i>
                @endswitch
            </td>
        </tr>
   @endforeach
</table>

