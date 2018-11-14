<div class="tips">
    <p>指数由硬盘容量、类型、级别、速度综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
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
            <div class="thTxt">类别</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="framework_name,asc"></i>
                <i class="ZtoA" good="cpu" order="framework_name,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">转速</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="jie_kou_su_lv,asc"></i>
                <i class="ZtoA" good="cpu" order="jie_kou_su_lv,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">容量(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="rong_liang,asc"></i>
                <i class="ZtoA" good="cpu" order="rong_liang,desc"></i>
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
   @foreach($hard_disk_lists['hard_disk_lists'] as $hard_disk)
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                @if($hard_disk->id == $hard_disk_lists['top'])
                   <i class='tableTopXu'></i>
                   @else
                   {{ $loop->iteration }}
                @endif
            </td>
            <td class="tableName">{{ $hard_disk->jiancheng }}</td>
            <td>{{ $hard_disk->framework_name }} / {{ $hard_disk->series_name }}</td>
            <td>{{ $hard_disk->jie_kou_su_lv }}</td>
            <td>{{ $hard_disk->details['rong_liang'] }}G</td>
            <td class="tableInfoDel tablePhoneShow ">{{ round($hard_disk->index,2) }}</td>
            <td>
                @switch($hard_disk->float)
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

