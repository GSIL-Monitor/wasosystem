<?php

namespace App\Presenters;
use Overtrue\Pinyin\Pinyin;
class CompleteMachineFrameworksParamenter
{
    //参数树
    public function tree($data,$prefix,$parent_id)
    {
        $traverse = function ($complete_machine_frameworks, $prefix,$parent_id) use (&$traverse) {
            foreach ($complete_machine_frameworks as $category) {
                echo '<tr>';
                echo '<td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="' . $category->id . '"></td>';
//                echo '<td class="tableInfoDel"><input type="text" name="edit[' . $category->id . '][order]" value="' . $category->order . '"></td>';
                if(empty($category->child_category)){
                    echo '<td class="tableInfoDel  tablePhoneShow  tableName" style="padding-left:'.(strlen(PHP_EOL . $prefix)*10).'px'.'">' .'<a class="alertWeb" data_url="'.route('admin.complete_machine_frameworks.edit',$category->id).'">'.$category->name . '</a></td>';
                }else{
                    echo '<td class="tableInfoDel  tablePhoneShow  tableName" style="padding-left:'.(strlen(PHP_EOL . $prefix)*10).'px'.'">' . $category->name . '</td>';
                }

                echo '<td class="tableMoreHide">' . $category->created_at->format('Y-m-d') . '</td>';
                echo '<td class="">' . $category->updated_at->format('Y-m-d') . '</td>';
                if($category->child_category !='product'){
                    echo '<td>
                            <button class="alertWeb Btn" data_url="' . route('admin.complete_machine_frameworks.create') . '?parent_id=' . $category->id . '&category=filtrate&select=false&parent=' . $parent_id . '">添加</button>
                        </td>';
                }else{
                    echo '<td>
                      --
                        </td>';
                }

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