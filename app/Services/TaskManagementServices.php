<?php

namespace App\Services;

use App\Models\FundsManagement;
use App\Models\TaskManagement;
use App\Models\Order;
use Carbon\Carbon;
class TaskManagementServices
{
    public function calculate($DivisionalManagement)
    {
        $member =self::member($DivisionalManagement);
        $group =self::group($DivisionalManagement,$member);
        $department =self::department($DivisionalManagement,$group);
        $company =self::company($DivisionalManagement,$department);
//        dump($member,$group,$department,$company);
        return 0;
    }

    //计算
    public static function calculation($value, $product = 10000)
    {
        return $value * $product;
    }

    //已回款
    public static function returned_money($funds,$account)
    {
//             $where = [
//            ['market', $account],
//            ['type','pay']
//        ];
//        $frist_day = Carbon::now()->firstOfMonth();
//        $last_day = Carbon::now()->lastOfMonth()->toDateString() . ' 23:59:59';
//        $sum_prices = FundsManagement::where($where)->whereDate('created_at', '>=', $frist_day)->whereDate('created_at', '<=', $last_day)->sum('price');
        list($account_paid, $other) = $funds->partition(function ($item) {
            $frist_day = Carbon::now()->firstOfMonth();
            $last_day = Carbon::now()->lastOfMonth();
            return $item->type== 'pay' && $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
        });//筛选出已付款 并且时间在本月的明细
        $sum_price=$account_paid->sum('price'); //计算出总价
//       dump($sum_prices.'=='.$sum_prices);
        return $sum_price;
    }

    //当月销售
    public static function monthly_sales($order,$account)
    {
//        $where = [
//            ['market', $account],
//            ['order_status', '<>', 'intention_to_order'],
//        ];
//        $frist_day = Carbon::now()->firstOfMonth();
//        $last_day = Carbon::now()->lastOfMonth()->toDateString() . ' 23:59:59';
//        $sum_prices = Order::where($where)->whereDate('created_at', '>=', $frist_day)->whereDate('created_at', '<=', $last_day)->sum('total_prices');
        list($monthly_sales, $other) = $order->partition(function ($item) {
            $frist_day = Carbon::now()->firstOfMonth();
            $last_day = Carbon::now()->lastOfMonth();
            return $item->order_status != 'intention_to_order' && $frist_day->lte($item->created_at) && $last_day->gte($item->created_at);
        });//筛选出当月销售 并且时间在本月的订单
        $sum_price=$monthly_sales->sum('total_prices'); //计算出总价
//        dump($sum_prices.'=='.$sum_price);
        return $sum_price;
    }

    //发出未结
    public static function outstanding($order,$account)
    {
//        $where = [
//            ['market', $account],
//            ['payment_status', '<>', 'account_paid'],
//        ];
//        $sum_prices = Order::where($where)->whereIn('order_status', ['in_transportation', 'arrival _of_goods'])->sum('total_prices');
        list($outstanding, $other) = $order->partition(function ($item) {
            return $item->payment_status != 'account_paid';
        });//筛选未付款订单
        $sum_price=$outstanding->whereIn('order_status', ['in_transportation', 'arrival _of_goods'])->sum('total_prices'); //筛选出订单状态在再输运途 和到货  然后计算出总价
//        dump($sum_prices.'=='.$sum_price);
        return $sum_price;
    }

    public static function company($DivisionalManagement,$department)
    {
        $arr4=[];
        foreach ($DivisionalManagement as $category) {
            $departments=$department[$category->id] ?? 0;
            if ($category->identifying == 'company' &&  $departments) {
                $arr4[$category->id]['goal']=self::calculation($category->task->goal ?? 0);
                $arr4[$category->id]['guaranteed_task']=self::calculation($category->task->guaranteed_task ?? 0);
                $arr4[$category->id]['returned_money']=collect($departments)->sum('returned_money');
                $arr4[$category->id]['monthly_sales']=collect($departments)->sum('monthly_sales');
                $arr4[$category->id]['outstanding']=collect($departments)->sum('outstanding');
            }
        }
        return $arr4;
    }
    public static function department($DivisionalManagement,$group)
    {
        $arr3 =[];
        foreach ($DivisionalManagement as $category) {
            $groups=$group[$category->id] ?? 0;
            if ($category->identifying == 'department' &&  $groups) {
                $arr3[$category->parent_id][$category->id]['goal']=self::calculation($category->task->goal ?? 0);
                $arr3[$category->parent_id][$category->id]['guaranteed_task']=self::calculation($category->task->guaranteed_task ?? 0);
                $arr3[$category->parent_id][$category->id]['returned_money']=collect($groups)->sum('returned_money');
                $arr3[$category->parent_id][$category->id]['monthly_sales']=collect($groups)->sum('monthly_sales');
                $arr3[$category->parent_id][$category->id]['outstanding']=collect($groups)->sum('outstanding');
            }
        }
        return $arr3;
    }
    public static function group($DivisionalManagement,$member)
    {
        $arr2 =[];
        foreach ($DivisionalManagement as $category) {
            $members=$member[$category->id] ?? 0;
            if ($category->identifying == 'group' && $members) {
                $arr2[$category->parent_id][$category->id]['goal']=self::calculation($category->task->goal ?? 0);
                $arr2[$category->parent_id][$category->id]['guaranteed_task']=self::calculation($category->task->guaranteed_task ?? 0);
                $arr2[$category->parent_id][$category->id]['returned_money']=collect($members)->sum('returned_money');
                $arr2[$category->parent_id][$category->id]['monthly_sales']=collect($members)->sum('monthly_sales');
                $arr2[$category->parent_id][$category->id]['outstanding']=collect($members)->sum('outstanding');
            }
        }
        return $arr2;
    }

    public static function member($DivisionalManagement)
    {
        $arr=[];
        foreach ($DivisionalManagement as $category) {
            if ($category->identifying == 'member') {
                $arr[$category->parent_id][$category->id]['goal']=self::calculation($category->task->goal ?? 0);
                $arr[$category->parent_id][$category->id]['guaranteed_task']=self::calculation($category->task->guaranteed_task ?? 0);
                $arr[$category->parent_id][$category->id]['returned_money']=self::returned_money($category->admins->funds,$category->admins->account);
                $arr[$category->parent_id][$category->id]['monthly_sales']= self::monthly_sales($category->admins->order,$category->admins->account);
                $arr[$category->parent_id][$category->id]['outstanding']= self::outstanding($category->admins->order,$category->admins->account);
                $arr[$category->parent_id][$category->id]['RewardsAndPunishment']= self::RewardsAndPunishment($category,$arr);

            }
        }
        return $arr;
    }
    //奖惩
    public static function  RewardsAndPunishment($category,$datas)
    {

        /*1,如果 (当月回款 - 保底任务) < 0 ：-round((1 - (当月回款 / 保底任务)) * 惩罚指标,2)；//取两位小数
          2,如果 (当月回款 - 保底任务) > 0 && (当月回款 < 二阶段目标)：round(当月回款 - 保底任务) / 单位指标 * 奖励系数),2)；
          3,如果 (当月回款 - 保底任务) > 0 && (当月回款 > 二阶段目标) && (当月回款 < 三阶段目标)：round(((二阶段目标 - 保底任务) / 单位指标 * 奖励系数) + (当月回款 - 二阶段目标) / 单位指标 * 二阶段系数,2)；
          4,如果 (当月回款 - 保底任务) > 0 && (当月回款 > 三阶段目标)：round((二阶段目标 - 保底任务）/ 单位指标 * 奖励系数)+((三阶段目标 - 二阶段目标）/单位指标 * 二阶段系数)+((当月回款 - 三阶段目标）/ 单位指标 * 三阶段系数),2）；
        */
        $goal=$datas[$category->parent_id][$category->id]['goal'];//目标任务
        $guaranteed_task=$datas[$category->parent_id][$category->id]['guaranteed_task'];//保底任务
        $award_coefficient=$category->task->award_coefficient ?? 0;//奖励系数
        $goal_two=self::calculation($category->task->goal_two ?? 0);//二阶段目标
        $award_coefficient_two=$category->task->award_coefficient_two ?? 0;//二阶段系数
        $goal_three=self::calculation($category->task->goal_three ?? 0);//三阶段目标
        $award_coefficient_three=$category->task->award_coefficient_three ?? 0;//三阶段系数
        $returned_money=$datas[$category->parent_id][$category->id]['returned_money'];//当月回款
        $punish_index=$category->task->punish_index ?? 0;//处罚指标（元）
        $units_index=$category->task->units_index ?? 10000;//单位指标（万）
        $RewardsAndPunishment=0;//奖惩
        if (($returned_money - $guaranteed_task) < 0) {
            $RewardsAndPunishment = -round(((1 - $returned_money / $guaranteed_task)) * $punish_index, 2);
        } else {
            if ($goal_three && $goal_two) {
                if (($returned_money - $guaranteed_task) > 0 && ($returned_money > $goal_three)) {
                    $RewardsAndPunishment = round(
                        ((($goal_two - $guaranteed_task) / $units_index) * $award_coefficient)
                        + ((($goal_three - $goal_two) / $units_index) * $award_coefficient_two)
                        + ((($returned_money - $goal_three) / $units_index) * $award_coefficient_three), 2);

                } else {
                    if (($returned_money - $guaranteed_task) > 0 && ($returned_money > $goal_two) && ($returned_money < $goal_three)) {
                        $RewardsAndPunishment = round(((($goal_two - $guaranteed_task) / $units_index) * $award_coefficient) + ((($returned_money - $goal_two) / $units_index) * $award_coefficient_two), 2);
                    } else {
                        if (($returned_money - $guaranteed_task) > 0 && ($returned_money < $goal_two)) {
                            $RewardsAndPunishment = round(($returned_money - $guaranteed_task) / $units_index * $award_coefficient, 2);
                        }
                    }
                }
            } else {
                $RewardsAndPunishment = round(($returned_money - $guaranteed_task) / $units_index * $award_coefficient, 2);
            }
        }
        return $RewardsAndPunishment;
    }
}

?>