<?php

namespace App\Presenters;
class DemandFiltrateParamenter
{
    //参数树
    public function tree($data,$prefix,$parent_id)
    {
        $traverse = function ($complete_machine_frameworks, $prefix,$parent_id) use (&$traverse) {
            foreach ($complete_machine_frameworks as $category) {
                echo '<tr>';
                echo '<td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="' . $category->id . '"></td>';
//                echo '<td class="tableInfoDel"><input type="text" name="edit[' . $category->id . '][order]" value="' . $category->order . '"></td>';
                echo '<td class="tableInfoDel  tablePhoneShow  tableName" style="padding-left:'.(strlen(PHP_EOL . $prefix)*10).'px'.'">' .'<a class="alertWeb" data_url="'.route('admin.demand_filtrates.edit',$category->id).'">'.$category->name . '</a></td>';
                echo '<td class="tableMoreHide">' . $category->created_at->format('Y-m-d') . '</td>';
                echo '<td class="">' . $category->updated_at->format('Y-m-d') . '</td>';
                $cate=$category->category =='issue'?'答案':'问题';
                echo '<td>
            <button class="OneAdd Btn" data_title="'.$cate.'" data_parent_id="'.$category->id.'"
                            data_product_id="'.$cate.'" data_url="'.route('admin.demand_filtrates.store').'">添加'.$cate.'</button>
                        </td>';

                echo '</tr>';

                $traverse($category->children, $prefix.'--',$parent_id);
            }
        };
        $traverse($data,$prefix,$parent_id);
    }

    //显示参数名
    public function showPinyin()
    {
        return new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
    }
}