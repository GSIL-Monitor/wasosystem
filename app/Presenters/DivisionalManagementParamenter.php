<?php

namespace App\Presenters;

use App\Http\Requests\Request;
use App\Models\Admin;
use App\Models\Order;
use Carbon\Carbon;

class DivisionalManagementParamenter
{
    //参数树
    public function tree($data, $prefix, $parent_id)
    {
        $traverse = function ($DivisionalManagement, $prefix, $parent_id) use (&$traverse) {
            foreach ($DivisionalManagement as $category) {
                echo '<tr>';
                echo '<td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="' . $category->id . '"></td>';
//                echo '<td class="tableInfoDel"><input type="text" name="edit[' . $category->id . '][order]" value="' . $category->order . '"></td>';
                if (empty($category->admin_id)) {
                    echo '<td class="tableInfoDel  tablePhoneShow  tableName" style="padding-left:' . (strlen(PHP_EOL . $prefix) * 10) . 'px' . '">' . '<a class="alertWeb" data_url="' . route('admin.divisional_managements.edit', $category->id) . '">' . $category->name . '</a></td>';
                } else {
                    echo '<td class="tableInfoDel  tablePhoneShow  tableName" style="padding-left:' . (strlen(PHP_EOL . $prefix) * 10) . 'px' . '">' . $category->name . '</td>';
                }

                echo '<td class="tableMoreHide">' . $category->created_at->format('Y-m-d') . '</td>';
                echo '<td class="">' . $category->updated_at->format('Y-m-d') . '</td>';
                if ($category->task) {
                    $task_url = route('admin.task_managements.edit', $category->task->id) . '?parent_id=' . $category->id;
                    $task_str = '修改任务';
                } else {
                    $task_url = route('admin.task_managements.create') . '?parent_id=' . $category->id;
                    $task_str = '添加任务';
                }
                if (empty($category->admin_id)) {

                    echo '<td>
                            <a class="alertWeb" data_url="' . route('admin.divisional_managements.create') . '?parent_id=' . $category->id . '">添加下级</a>&nbsp;&nbsp;&nbsp;
                            <a class="alertWeb" data_url="' . $task_url . '">' . $task_str . '</a>
                        </td>';
                } else {
                    echo '<td>  
                         <a class="alertWeb" data_url="' . $task_url . '">' . $task_str . '</a>
                        </td>';
                }
                echo '</tr>';

                $traverse($category->children, $prefix . '--', $parent_id);
            }
        };
        $traverse($data, $prefix, $parent_id);
    }

    //参数树
    public function category_tree($data, $prefix, $parent_id, $year, $mouth)
    {
        $traverse = function ($DivisionalManagement, $prefix, $parent_id, $year, $mouth) use (&$traverse) {
            foreach ($DivisionalManagement as $category) {
                if (\Route::is('admin.task_managements.task_progress')) {
                    $url = route('admin.task_managements.task_progress');
                } else {
                    $url = route('admin.task_managements.historical_task');
                }
                if ($category->identifying == 'company') {
                    echo '<dl>';
                    echo '<dt>公司：</dt>';
                    echo '<dd>';
                    echo ' <a href="' . $url . '?parent_id=' . $category->id . '&year=' . $year . '&mouth=' . $mouth . '" >' . $category->name . '</a>';
                    echo '</dd>';
                    echo ' <div class="clear"></div>';
                    echo ' </dl>';
                } else {
                    echo '<dl  class="list_' . $category->id . '">';
                    if ($category->identifying != 'member') {
                        echo '<dt>' . $category->name . '：</dt>';
                    }
                    echo '<dd>';
                    if ($category->children->isNotEmpty()) {
                        foreach ($category->children as $cate) {
                            $active = '';
                            if ($cate->id == \request()->input('parent_id')) {
                                $active = 'active';
                            }
                            echo ' <a href="' . $url . '?parent_id=' . $cate->id . '&type=' . $cate->identifying . '&year=' . $year . '&mouth=' . $mouth . '" class="list_' . $cate->id . '  ' . $active . ' ">' . $cate->name . '</a>';
                        }
                    }
                    echo '</dd>';
                    echo ' <div class="clear"></div>';
                    echo ' </dl>';
                }
                $traverse($category->children, $prefix . '--', $parent_id, $year, $mouth);
            }
        };
        $traverse($data, $prefix, $parent_id, $year, $mouth);
    }

    //参数树
    public function chart_tree($data, $parent_id, $year, $mouth)
    {
        $arr = [];
        $cates = ['company' => '公司', 'department' => '部门', 'group' => '组队', 'member' => '成员'];
        $traverse = function ($DivisionalManagement) use (&$traverse, &$arr) {
            foreach ($DivisionalManagement as $category) {
                $arr[$category->identifying][$category->id] = $category->name;
                $traverse($category->children);
            }
        };
        $traverse($data);

        foreach ($cates as $key => $item) {
            echo '<dl>';
            echo '<dt>' . $item . '：</dt>';
            echo '<dd>';

            foreach ($arr[$key] as $key2 => $item2) {
                if ($key2 == $parent_id) {
                    echo ' <a href="' . route('admin.task_managements.marketing_statistics') . '?parent_id=' . $key2 . array_to_url(\request()->only(['year', 'mouth'])) . '" class="active">' . $item2 . '</a>';
                } else {
                    echo ' <a href="' . route('admin.task_managements.marketing_statistics') . '?parent_id=' . $key2 . array_to_url(\request()->only(['year', 'mouth'])) . '" >' . $item2 . '</a>';
                }
            }
            echo '</dd>';
            echo ' <div class="clear"></div>';
            echo ' </dl>';

        }

    }

    public function chart($data)
    {
        $arr = [];
        $sources = [];
        $source = [];
        $traverse = function ($DivisionalManagement) use (&$traverse, &$arr) {
            foreach ($DivisionalManagement as $category) {
                if ($category->admins) {
                    if ($category->admins->visitor->isNotEmpty()) {
                        $arr[$category->admins->account] = self::chartGroup($category->admins->visitor);
                    }
                }
                $traverse($category->children);
            }
        };
        $traverse($data);
        foreach ($arr as $item) {
            foreach ($item as $key => $item2) {
                $sources[$key][] = count($item2);
            }
        }
        foreach ($sources as $key => $item) {
            $source[$key] = array_sum($item);
        }

        if ($source) {
            echo '<ul class="bindBox">';
            foreach (array_reverse(array_sort($source)) as $key => $item) {
                echo '<li><div class="bindZhi" data_num="' . $item . '">' . $key . ' </div><div class="bindLine"><div class="lines"><i class="zhi"></i></div></div></li>';
            }
            echo '</ul>';
            echo '<div class="bottomLines"><i>0%</i><i>50%</i><i>100%</i></div>';
        }
    }

    public function pieBox($data, $parent_id, $year, $mouth)
    {
        $arr = [];
        $arrs = [];
        $returned_money = [];
        $outstanding = [];
        $guaranteed_task = [];
        $traverse = function ($DivisionalManagement, $parent_id, $year, $mouth) use (&$traverse, &$arr, &$returned_money, &$outstanding, &$guaranteed_task) {
            foreach ($DivisionalManagement as $category) {
                if ($category->admins) {//&& $category->task
                    if ($category->admins->demand->isNotEmpty()) {
                        $arr['first_effective'][$category->admins->account] = self::first_effective($category->admins->demand, $year, $mouth);
                        $arr['demand_finish'][$category->admins->account] = self::demand_finish($category->admins->demand, $year, $mouth);
                        $returned_money[$category->admins->account] = $category->admins->funds->sum('price');
                        if ($category->admins->order) {
                            $outstanding[$category->admins->account] = self::outstanding($category->admins, $year, $mouth);
                        }
                        $guaranteed_task[$category->admins->account] = self::calculation($category->task->guaranteed_task ?? 0);
                        $arr['new_customer'][$category->admins->account] = self::new_customer($category->admins->users, $year, $mouth);
                    }
                }
                $traverse($category->children, $parent_id, $year, $mouth);
            }
        };
        $traverse($data, $parent_id, $year, $mouth);
        //dump($arr);
        $arrs['receivable_outstanding'] = self::receivable_outstanding($returned_money, $outstanding, $guaranteed_task);
        foreach ($arr as $key => $item) {
            $item = collect($item);
            if ($key == 'first_effective') {
                $arrs['first_effective'] = number_format(($item->sum('allsn') / $item->sum('allCount')) * 100, 2);
                //     $arrs['first_effective']=
            } elseif ($key == 'demand_finish') {
                $arrs['demand_finish'] = number_format(($item->sum('allsn') / $item->sum('allCount')) * 100, 2);
            } else {//new_customer
                $arrs['new_customer'] = number_format(($item->sum('allsn') / $item->sum('allCount')) * 100, 2);
            }

        }

        $arrs['returned_money'] = $arrs['receivable_outstanding']['returned_money'];
        $arrs['outstanding'] = $arrs['receivable_outstanding']['outstanding'];

        unset($arrs['receivable_outstanding']);
        $i = 1;
        $name = ['first_effective' => '初次有效转化比例', 'returned_money' => '任务完成进度比例', 'outstanding' => '发出未结收款比例', 'demand_finish' => '需求成单转化比例', 'new_customer' => '本期新增客户比例'];
        if (array_filter($arrs)) {
            foreach (array_filter($arrs) as $key => $item) {
                $i++;
                echo '<li>
            <div class="pieMode">
                <canvas data-percent="' . $item . '" class="perCanvas">您的浏览器不支持canvas标签。</canvas>
                <div class="txtBox"><span class="bigTxt">' . $item . '%</span></div>
                <div class="txtBoxBottom">' . $name[$key] . '</div>
            </div>
        </li>';
            }
        } else {
            echo '没有数据！';
        }
    }


    //当月销售统计
    public function ProgressOfTheStatistics($data, $prefix, $parent_id)
    {
        $traverse = function ($DivisionalManagement, $prefix, $parent_id) use (&$traverse) {
            foreach ($DivisionalManagement as $category) {
                $type = $category->identifying;
                $name = $category->name;
                $goal = self::calculation($category->task->goal ?? 0);
                $guaranteed_task = self::calculation($category->task->guaranteed_task ?? 0);
                $RewardsAndPunishment = 0;
                if ($category->identifying == 'member') {
                    $returned_money = self::returned_money($category->admins->funds);
                    $monthly_sales = self::monthly_sales($category->admins->order);
                    $outstanding = self::outstanding($category->admins->order);
                    $RewardsAndPunishment = self::RewardsAndPunishment($category, $guaranteed_task, $returned_money);

//                    dump($returned_money,$monthly_sales,$outstanding,$RewardsAndPunishment);
                } else {
                    $returned_money = 0;
                    $monthly_sales = 0;
                    $outstanding = 0;
                }
                echo self::html($category, $type, $name, $prefix, $goal, $guaranteed_task, $returned_money, $monthly_sales, $outstanding, $RewardsAndPunishment);
                $traverse($category->children, $prefix . '--', $parent_id);
            }
        };
        $traverse($data, $prefix, $parent_id);
    }

    public function historical_task($data, $prefix, $parent_id, $year, $mouth)
    {
        $traverse = function ($DivisionalManagement, $prefix, $parent_id, $year, $mouth) use (&$traverse) {
            foreach ($DivisionalManagement as $category) {
                $historical_task = $category->historical_task;
                $type = $category->identifying;
                $name = $category->name;
                $goal = $historical_task->goal ?? 0;
                $guaranteed_task = $historical_task->guaranteed_task ?? 0;
                $RewardsAndPunishment = $historical_task->punish_award ?? 0;;
                $returned_money = $historical_task->returned_money ?? 0;
                $monthly_sales = $historical_task->monthly_sales ?? 0;
                $outstanding = $historical_task->outstanding ?? 0;
                echo self::html($category, $type, $name, $prefix, $goal, $guaranteed_task, $returned_money, $monthly_sales, $outstanding, $RewardsAndPunishment);
                $traverse($category->children, $prefix . '--', $parent_id, $year, $mouth);
            }
        };
        $traverse($data, $prefix, $parent_id, $year, $mouth);
    }

    public static function html($category, $type, $name, $prefix, $goal, $guaranteed_task, $returned_money, $monthly_sales, $outstanding, $RewardsAndPunishment)
    {
        $html = '';
        $html .= '<tr class="' . $type . ' parent_' . $category->id . '" data-pid="' . $category->parent_id . '" data-id="' . $category->id . '">';

        $html .= '<td class="tableInfoDel tablePhoneShow tableName" >' . $prefix . $name . '</td>';

        $html .= '<td class="tableInfoDel" >
                <div class="JDBox">
                     <span class="goal"><i>' . $goal . '</i></span><span class="guaranteed_task"><i>' . $guaranteed_task . '</i></span><span class="returned_money"><i>' . $returned_money . '</i></span>
                 </div>
                </td>';
        $html .= '<td class=""><span class="MBIWords">' . $goal . '</span></td>';
        $html .= '<td class=""><span class="BDIWords">' . $guaranteed_task . '</span></td>';
        $html .= '<td class=""><span class="YHIWords">' . $returned_money . '</span></td>';
        $html .= '<td class=""><span class="monthly_sales">' . $monthly_sales . '</span></td>';
        $html .= '<td class=""><span class="outstanding">' . $outstanding . '</span></td>';
        $html .= '<td class=""><span class="">' . $RewardsAndPunishment . '</span></td>';
        $html .= '</tr>';
        return $html;
    }

    //计算
    public static function calculation($value, $product = 10000)
    {
        return $value * $product;
    }

    //已回款
    public static function returned_money($funds)
    {

        return $funds ? $funds->funds->sum('price') : 0;
    }

    //当月销售
    public static function monthly_sales($order, $year, $mouth)
    {
        if ($order) {
            list($monthly_sales, $other) = $order->order->partition(function ($item) use ($year, $mouth) {
                $frist_day = Carbon::createFromDate($year, $mouth)->firstOfMonth();
                $last = Carbon::createFromDate($year, $mouth)->lastOfMonth();
                $last_day = Carbon::create($year, $mouth, $last->format('d'), 23, 59, 59);
                return $item->order_status != 'intention_to_order' && $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
            });//筛选出当月销售 并且时间在本月的订单
            $sum_price = $monthly_sales->sum('total_prices'); //计算出总价
            return $sum_price;
        } else {
            $sum_price = 0;
        }

        return $sum_price;
    }

    //发出未结
    public static function outstanding($order, $year, $mouth)
    {

        if ($order) {
            list($outstanding, $other) = $order->order->partition(function ($item) use ($year, $mouth) {
                $frist_day = Carbon::createFromDate($year, $mouth)->firstOfMonth();
                $last = Carbon::createFromDate($year, $mouth)->lastOfMonth();
                $last_day = Carbon::create($year, $mouth, $last->format('d'), 23, 59, 59);
                return $item->payment_status != 'account_paid' && $last_day->gte($item->created_at);
            });//筛选未付款订单

            $sum_price = $outstanding->whereIn('order_status', ['placing_orders', 'order_acceptance', 'in_transportation', 'arrival_of_goods'])->sum('total_prices'); //筛选出订单状态在再输运途 和到货  然后计算出总价
        } else {
            $sum_price = 0;
        }
        return $sum_price;
    }

    //奖惩
    public static function RewardsAndPunishment($category, $guaranteed_task, $returned_money)
    {

        /*1,如果 (当月回款 - 保底任务) < 0 ：-round((1 - (当月回款 / 保底任务)) * 惩罚指标,2)；//取两位小数
          2,如果 (当月回款 - 保底任务) > 0 && (当月回款 < 二阶段目标)：round(当月回款 - 保底任务) / 单位指标 * 奖励系数),2)；
          3,如果 (当月回款 - 保底任务) > 0 && (当月回款 > 二阶段目标) && (当月回款 < 三阶段目标)：round(((二阶段目标 - 保底任务) / 单位指标 * 奖励系数) + (当月回款 - 二阶段目标) / 单位指标 * 二阶段系数,2)；
          4,如果 (当月回款 - 保底任务) > 0 && (当月回款 > 三阶段目标)：round((二阶段目标 - 保底任务）/ 单位指标 * 奖励系数)+((三阶段目标 - 二阶段目标）/单位指标 * 二阶段系数)+((当月回款 - 三阶段目标）/ 单位指标 * 三阶段系数),2）；
        */
        $RewardsAndPunishment = 0;//奖惩
        if ($returned_money && $guaranteed_task) {

            $award_coefficient = $category->task->award_coefficient ?? 0;//奖励系数
            $goal_two = self::calculation($category->task->goal_two ?? 0);//二阶段目标
            $award_coefficient_two = $category->task->award_coefficient_two ?? 0;//二阶段系数
            $goal_three = self::calculation($category->task->goal_three ?? 0);//三阶段目标
            $award_coefficient_three = $category->task->award_coefficient_three ?? 0;//三阶段系数
            $punish_index = $category->task->punish_index ?? 0;//处罚指标（元）
            $units_index = $category->task->units_index ?? 10000;//单位指标（万）

            if ($punish_index && $units_index) {
                if (($returned_money - $guaranteed_task) < 0) {

                    $RewardsAndPunishment = -round(((1 - $returned_money / $guaranteed_task)) * $punish_index, 2);
                } else {
                    if ($goal_three && $goal_two) {
                        if (($returned_money - $guaranteed_task) > 0 && ($returned_money > $goal_three)) {

                            $RewardsAndPunishment = round(
                                (($goal_two - $guaranteed_task) / ($units_index * $award_coefficient))
                                + (($goal_three - $goal_two) / ($units_index * $award_coefficient_two))
                                + (($returned_money - $goal_three) / ($units_index * $award_coefficient_three)), 2);

                        } else {
                            if (($returned_money - $guaranteed_task) > 0 && ($returned_money > $goal_two) && ($returned_money < $goal_three)) {

                                $RewardsAndPunishment = round((($goal_two - $guaranteed_task) / ($units_index * $award_coefficient)) + (($returned_money - $goal_two) / ($units_index * $award_coefficient_two)), 2);
                            } else {
                                if (($returned_money - $guaranteed_task) > 0 && ($returned_money < $goal_two)) {
                                    $RewardsAndPunishment = round(($returned_money - $guaranteed_task) / ($units_index * $award_coefficient), 2);
                                }
                            }
                        }
                    } else {
                        $RewardsAndPunishment = round(($returned_money - $guaranteed_task) / ($units_index * $award_coefficient), 2);
                    }
                }
            }
        }


        return $RewardsAndPunishment;
    }

//来源分组
    public
    static function chartGroup($visitor)
    {
        return $visitor->groupBy('source')->toArray();
    }

//初次有效转换
    public
    static function first_effective($demand, $year, $mouth)
    {
        $allCount = $demand->count();
        list($this_month, $other) = $demand->partition(function ($item) use ($year, $mouth) {
            $frist_day = Carbon::create($year, $mouth)->firstOfMonth();
            $last_day = Carbon::create($year, $mouth)->lastOfMonth();
            return $item->demand_status != 'demand_consult' && $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
        });//筛选出有订单的需求
        $all = $this_month->count();
        return ['allCount' => $allCount, 'allsn' => $all];
    }

//需求订单完成转换
    public
    static function demand_finish($demand, $year, $mouth)
    {
        $allCount = $demand->count();
        list($this_month, $other) = $demand->partition(function ($item) use ($year, $mouth) {
            $frist_day = Carbon::create($year, $mouth)->firstOfMonth();
            $last_day = Carbon::create($year, $mouth)->lastOfMonth();
            return $item->demand_status == 'requirement_determination' && $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
        });//筛选出有订单的需求
        $all = $this_month->count();
        return ['allCount' => $allCount, 'allsn' => $all];
    }

//回款未结
    public
    static function receivable_outstanding($returned_money, $outstanding, $guaranteed_task)
    {

        $arr['returned_money'] = 0;
        $arr['outstanding'] = 0;
        $returned_money_sum = array_sum($returned_money);
        $guaranteed_task_sum = array_sum($guaranteed_task);
        $task_sum = $guaranteed_task_sum;
        $outstanding_sum = array_sum($outstanding);

        if ($returned_money_sum && $outstanding_sum) {
            if ($task_sum <= 0) {
                $guaranteed_task_sum = $returned_money_sum;
            }
            $arr['returned_money'] = number_format(($returned_money_sum / $guaranteed_task_sum) * 100, 2);
            if ($task_sum <= 0) {
                $guaranteed_task_sum = $outstanding_sum;
            }
            $arr['outstanding'] = number_format(($outstanding_sum / $guaranteed_task_sum) * 100, 2);
        }

        return $arr;
    }

//新增客户转换
    public
    static function new_customer($user, $year, $mouth)
    {
        $allCount = $user->count();
        list($new_customer, $other) = $user->partition(function ($item) use ($year, $mouth) {
            $frist_day = Carbon::create($year, $mouth)->firstOfMonth();
            $last_day = Carbon::create($year, $mouth)->lastOfMonth();
            return $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
        });//筛选出有订单的需求
        $all = $new_customer->count();
        return ['allCount' => $allCount, 'allsn' => $all];
    }
}