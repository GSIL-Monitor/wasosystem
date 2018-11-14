<div class="tips">
    <p>指数由处理器的主频、核心数、线程数综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
</div>

<table class="listTable">
    <tr class="tableTh">
        <th class="tableInfoDel tablePhoneShow">
            <div class="thTxt">排序</div>
            <!--<div class="paiIcon"><i class="AtoZ" data_model="cpu" data_order="key,asc"></i><i class="ZtoA" data_model="cpu" data_order="key,desc"></i>--></div>
        </th>
        <th class="tableName tableInfoDel">
            <div class="thTxt">产品型号</div>
            <div class="paiIcon">
                <i class="AtoZ" data_model="cpu" data_order="a2,desc"></i>
                <i class="ZtoA" data_model="cpu" data_order="a2,asc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">架构</div>
            <div class="paiIcon">
                <i class="AtoZ" data_model="cpu" data_order="b9,desc"></i>
                <i class="ZtoA" data_model="cpu" data_order="b9,asc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">主频(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" data_model="cpu" data_order="g3,desc"></i>
                <i class="ZtoA" data_model="cpu" data_order="g3,asc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">核心(C)/线程(H)</div>
            <div class="paiIcon">
                <i class="AtoZ" data_model="cpu" data_order="g10,desc"></i>
                <i class="ZtoA" data_model="cpu" data_order="g10,asc"></i>
            </div>
        </th>
        <!--<th><div class="thTxt">线程</div><div class="paiIcon"><i class="AtoZ" data_model="cpu" data_order="b7,asc"></i><i class="ZtoA" data_model="cpu" data_order="b7,desc"></i></div></th>-->
        <th class="tableInfoDel tablePhoneShow activeTh">
            <div class="thTxt">指数</div>
            <div class="paiIcon">
                <i class="AtoZ" data_model="cpu" data_order="zhishu,desc"></i>
                <i class="ZtoA active" data_model="cpu" data_order="zhishu,asc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">变化</div>
            <div class="paiIcon"></div>
        </th>
    </tr>
    <volist name="cpus" id="cpu">
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                <eq name="cpu.id" value="$top"><i class='tableTopXu'></i></eq>
                <php>
                    $key++;
                    $pagecount=isset($_GET['p'])?$_GET['p']:1;
                    $count=(14*($pagecount-1))+$key;
                </php>
                {$count}
            </td>
            <td class="tableName">{$cpu.a2}</td>
            <td>{$cpu.b9}</td>
            <td>{$cpu.g3}G</td>
            <td>{$cpu.g10}</td>
            <td class="tableInfoDel tablePhoneShow "><?php echo round($cpu['zhishu'],2); ?></td>
            <td>
                <if condition="strpos(friendlyDate($cpu['edittime']),'周') nheq false or strstr(friendlyDate($cpu['edittime']),'月') nheq false">
                    <i class="tableSitu goDown"></i>
                    <else/>
                    <if condition="$cpu['z2'] eq '0'"><i class="tableSitu goDown"></i></if>
                    <if condition="$cpu['z2'] eq '1'"><i class="tableSitu goHold"></i></if>
                    <if condition="$cpu['z2'] eq '2'"><i class="tableSitu goUp"></i></if>
                </if>
            </td>
        </tr>
    </volist>
</table>
<div id="page">
    {$page}
</div>
<script>
    var sort="{$sort}";
</script>
