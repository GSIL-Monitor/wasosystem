<?php

namespace App\Presenters;

class WarehouseOutManagementParamenter
{

    public function CodeTable($codes)
    {

        foreach ($codes as $item) {

            if ($item->product_good_num == 1) {
                $class=!empty($item->code[0]) ? 'good' : '';
//                $readonly=!empty($item->code[0]) ? 'readonly' : '';
//                $show=!empty($item->code[0]) ? 'block' : 'none';
                echo '<tr>
                     <td><input type="text" readonly value="' . $item->code[0] . '" class="good_'.$item->product_good_id.' '.$class.'"  data-number="'.$item->product_good_number.'"  data-id="'.$item->product_good_id.'" data-num="'.$item->product_good_num.'" ></td>
                     <td>' . $item->product_good->product->title . '</td>
                     <td>' . $item->product_good->name . '</td>
                     <td><Poptip
                    confirm
                    title="你确定删除这个条码吗?"
                    @on-ok="del('.$item->product_good_id.',0)"
                    ok-text="删除"
            >
                <Button class="Btn red" >删除</Button>
            </Poptip></td>
              </tr>';
            } else {
                for ($i = 0; $i < $item->product_good_num; $i++) {
                    $class=!empty($item->code[$i]) ? 'good' : '';
//                    $readonly=!empty($item->code[$i]) ? 'readonly' : '';
//                    $show=!empty($item->code[$i]) ? 'block' : 'none';
                    echo '<tr>
                     <td><input type="text" readonly value="' . $item->code[$i] . '" class="good_'.$item->product_good_id.' '.$class.'"  data-number="'.$item->product_good_number.'"  data-id="'.$item->product_good_id.'" data-num="'.$item->product_good_num.'"></td>
                     <td>' . $item->product_good->product->title . '</td>
                     <td>' . $item->product_good->name . '</td>
                     <td><Poptip
                    confirm
                    title="你确定删除这个条码吗?"
                    @on-ok="del('.$item->product_good_id.','.$i.')"
                    ok-text="删除"
                       >
                <Button class="Btn red" >删除</Button>
                     </Poptip>
            </td>
                 </tr>';
                }
            }

        }

    }

    public function GoodTable($goods)
    {
        $product_goods = $this->checkSelfBuild($goods);
        echo '<table class="listTable"  ref="good">';
        echo '<tr>
             <th>产品条码</th>
             <th>产品类型</th>
             <th>产品名</th>
             <th>清除条码</th>
         </tr>';
        foreach ($product_goods as $item) {
            if ($item->pivot->product_good_num == 1) {
                echo '<tr >
                     <td><input type="text" readonly  value="" class="good_'.$item->id.'"  data-number="'.$item->product->bianhao.'"  data-id="'.$item->id.'" data-num="'.$item->pivot->product_good_num.'"></td>
                     <td>' . $item->product->title . '</td>
                     <td>' . $item->name . '</td>
                     <td ><Poptip
                    confirm
                    title="你确定删除这个条码吗?"
                    @on-ok="del(index)"
                    ok-text="删除" 
            >
                <Button   class="Btn red">删除</Button>
            </Poptip></td>
              </tr>';
            } else {
                for ($i = 0; $i < $item->pivot->product_good_num; $i++){
                    echo '<tr>
                     <td><input type="text"  readonly value=""  class="good_'.$item->id.'" data-number="'.$item->product->bianhao.'"  data-id="'.$item->id.'" data-num="'.$item->pivot->product_good_num.'"></td>
                     <td>' . $item->product->title . '</td>
                     <td>' . $item->name . '</td>
                     <td  ><Poptip
                    confirm
                    title="你确定删除这个条码吗?"
                    @on-ok="del(index)"
                    ok-text="删除"
                  
            >
                <Button   class="Btn red">删除</Button>
            </Poptip></td>
                 </tr>';
                }
            }

        }
        echo '</table>';

    }

    public function GoodToJson($goods)
    {
        $product_goods = $this->checkSelfBuild($goods);
        $arr = [];
        $code = [];
        foreach ($product_goods as $item) {
            if ($item->pivot->product_good_num == 1) {
                $arr[$item->id] = ['type' => $item->product->title, 'name' => $item->name, 'product_good_id' => $item->id, 'product_good_num' => $item->pivot->product_good_num, 'product_good_number' => $item->product->bianhao, 'code' => [""]];
            } else {
                for ($i = 0; $i < $item->pivot->product_good_num; $i++) {
                    $code[$item->id][] = "";
                }
                $arr[$item->id] = ['type' => $item->product->title, 'name' => $item->name, 'product_good_id' => $item->id, 'product_good_num' => $item->pivot->product_good_num, 'product_good_number' => $item->product->bianhao, 'code' => $code[$item->id]];
            }
        }
        return json_encode($arr, true);
    }

    public function checkSelfBuild($goods)
    {
        $cpu = $goods->firstWhere('product_id', 12);
        $cpu_num = 0;
        $good_arr = [];
        if ($cpu) {
            $cpu_num = $cpu->pivot->product_good_num;
        }
        foreach ($goods as $item) {
            if ($item->product_id == 23 && $item->jiagou_id == 279) {
                $product_goods_self_build_terrace = $item->product_goods_self_build_terrace;
                if ($product_goods_self_build_terrace->isNotEmpty()) {
                    foreach ($product_goods_self_build_terrace as $item2) {
                        if ($item2->product_id == 22) {
                            $item2->pivot->product_good_num = $cpu_num;
                        } else {
                            $item2->pivot->product_good_num = $item->pivot->product_good_num * $item2->pivot->product_good_num;
                        }
                        $good_arr[] = $item2;
                    }
                }
            } else {
                $good_arr[] = $item;
            }
        }
        return collect($good_arr)->sortBy('pivot.product_number');
    }

    public function codeToJson($goods)
    {
        $arr=[];
        foreach ($goods as $item) {
            if ($item->product_good_num == 1) {
                $arr[$item->product_good_id][$item->code[0]]=['id'=>$item->product_good_id,'var'=>$item->code[0],'bianhao'=>$item->product_good_number,'num'=>1,'type'=>$item->product_good->product->title,'name'=>$item->product_good->name];
            } else {
                for ($i = 0; $i < $item->product_good_num; $i++){
                    $arr[$item->product_good_id][$item->code[$i]]=['id'=>$item->product_good_id,'var'=>$item->code[$i],'bianhao'=>$item->product_good_number,'num'=>1,'type'=>$item->product_good->product->title,'name'=>$item->product_good->name];
                }
            }
        }
       return json_encode($arr);
    }
}