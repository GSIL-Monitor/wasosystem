<div class="tips">
    <p>指数由内存的容量、频率、类型综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
</div>

<table class="listTable">
    <tr class="tableTh">
        <th class="tableInfoDel tablePhoneShow">
            <div class="thTxt">排序</div>
        </th>
        <th class="tableName tableInfoDel">
            <div class="thTxt">产品规格</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="jiancheng,asc"></i>
                <i class="ZtoA" good="memory" order="jiancheng,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">类别</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="framework_name,asc"></i>
                <i class="ZtoA" good="memory" order="framework_name,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">频率(Hz)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="pin_lv,asc"></i>
                <i class="ZtoA" good="memory" order="pin_lv,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">容量(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="rong_liang,asc"></i>
                <i class="ZtoA" good="memory" order="rong_liang,desc"></i>
            </div>
        </th>

        <th class="tableInfoDel tablePhoneShow activeTh">
            <div class="thTxt">指数</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="index,asc"></i>
                <i class="ZtoA active" good="memory" order="index,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">变化</div>
            <div class="paiIcon"></div>
        </th>
    </tr>
   @foreach($memory_lists['memory_lists'] as $memory)
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                @if($memory->id == $memory_lists['top'])
                   <i class='tableTopXu'></i>
                   @else
                   {{ $loop->iteration }}
                @endif
            </td>
            <td class="tableName">{{ $memory->jiancheng }}</td>
            <td>{{ $memory->framework_name }}</td>
            <td>{{ $memory->details['gong_zuo_pin_lv'] }}Hz</td>
            <td>{{ $memory->details['rong_liang'] }}G</td>
            <td class="tableInfoDel tablePhoneShow ">{{ round($memory->index,2) }}</td>
            <td>
                @switch($memory->float)
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

