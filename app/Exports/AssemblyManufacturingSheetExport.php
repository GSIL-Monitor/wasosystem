<?php

namespace App\Exports;

use App\Models\CompleteMachine;
use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AssemblyManufacturingSheetExport implements WithEvents
{
    static $order;
    use Exportable, RegistersEventListeners;

    public function __construct(Order $order)
    {
        self::$order=$order;
    }

    public static function afterSheet(AfterSheet $event)
    {
        $comm_info=BaseSheetExport::commInfo(self::$order);
        $company=$comm_info['company'];
        if(self::$order->order_type != 'parts' ) {
            $machine_model = explode('-', self::$order->machine_model);
            $complete_machine = CompleteMachine::where('name', 'like', '%' . $machine_model[0] . '%')->first();
            $framework_application = !empty($complete_machine->jiagou) && !empty($complete_machine->application) ? implode(',', $complete_machine->jiagou) . '(' . implode(',', $complete_machine->application) . ')' : '';
        }
        $product_goods=self::$order->order_product_goods()->oldest('product_number')->get();
        $count=$product_goods->count();
        $service=self::$order->service()->whereType('service')->first();
        $sheet= $event->sheet->getDelegate();
        $sheet->setCellValue('A1', '网烁信息产品组装生产单')->mergeCells('A1:F1');
        $sheet->setCellValue('A2', '序列号：'.self::$order->serial_number )->mergeCells('A2:F2');
        $sheet->setCellValue('A3', '客户名称');
        $sheet->setCellValue('A4', '应用功能');
        $sheet->setCellValue('A5', '所属机型');
        $sheet->setCellValue('B3', $company.' '.self::$order->user->nickname)->mergeCells('B3:C3');
        $sheet->setCellValue('B4',$framework_application ?? '无')->mergeCells('B4:F4');
        $sheet->setCellValue('B5', self::$order->machine_model ? self::$order->machine_model :'无')->mergeCells('B5:C5');
        $sheet->setCellValue('D3', '配置时间');
        $sheet->setCellValue('D5',  "定制数量");
        $sheet->setCellValue('E3',self::$order->created_at)->mergeCells('E3:F3');
        $sheet->setCellValue('E5', self::$order->num)->mergeCells('E5:F5');
        $sheet->setCellValue('A6', '品 名');
        $sheet->setCellValue('B6', '规 格');
        $sheet->setCellValue('C6', '数 量');
        $sheet->setCellValue('D6', '单 价');
        $sheet->setCellValue('E6', '金 额');
        $sheet->setCellValue('F6', '备 注');
        $event->sheet->styleCells('A1:F'.($count+18), ['font' => ['name' => '微软雅黑', 'size' => 10], 'alignment' => ['vertical'=>Alignment::VERTICAL_CENTER,'horizontal' => Alignment::HORIZONTAL_CENTER,'wrapText'=>true]]);
        foreach ($product_goods as $key=>$item){

                $num=$item->pivot->product_good_num / self::$order->num;
               $sheet->setCellValue('A'.($key + 7), $item->product->title);
               $sheet->setCellValue('B'.($key + 7), $item->name);
               $sheet->setCellValue('C'.($key + 7), $num);
               $sheet->setCellValue('D'.($key + 7), 0);
               $sheet->setCellValue('E'.($key + 7), 0);
               $sheet->setCellValue('F'.($key + 7), $item->pivot->product_good_raid);
               $sheet->getRowDimension(($key + 7))->setRowHeight(20);
               $event->sheet->styleCells('B'.($key + 7), [ 'alignment' => ['wrapText'=>true,'horizontal' => Alignment::HORIZONTAL_LEFT]]);
        }
        $sheet->setCellValue('A'.($count + 7), '服务模式');
        $sheet->setCellValue('B'.($count + 7),$service->name);
        $sheet->setCellValue('C'.($count + 7),1);
        $sheet->setCellValue('D'.($count + 7),$service->identifying);
        $sheet->setCellValue('E'.($count + 7),$service->identifying);
        $sheet->setCellValue('A'.($count + 8),'客户要求')->mergeCells('A'.($count + 8).':'.'A'.($count + 11));
        $sheet->setCellValue('B'.($count + 8),self::$order->user_remark)->mergeCells('B'.($count + 8).':'.'F'.($count + 11));
        $sheet->setCellValue('A'.($count + 12),'订单备注')->mergeCells('A'.($count + 12).':'.'A'.($count + 14));
        $sheet->setCellValue('B'.($count + 12),self::$order->company_remark)->mergeCells('B'.($count + 12).':'.'F'.($count + 14));
        $sheet->setCellValue('A'.($count + 15),'方案确认');
        $sheet->setCellValue('B'.($count + 15),'');
        $sheet->setCellValue('C'.($count + 15),'商务确认')->mergeCells('C' . ($count + 15) . ':' . 'D' . ($count + 15));
        $sheet->setCellValue('E'.($count + 15),self::$order->market.'；'.Carbon::createFromDate()->format("H:i:s"))->mergeCells('E' . ($count + 15) . ':' . 'F' . ($count + 15));
        $sheet->setCellValue('A'.($count + 16),'出库确认');
        $acceptance=!empty(self::$order->participation_admin['acceptance']) ? implode(',',self::$order->participation_admin['acceptance']) .'；'.Carbon::createFromDate()->format("H:i:s") :'';
        $sheet->setCellValue('B'.($count + 16),$acceptance);
        $skill=!empty(self::$order->participation_admin['skill']) ? implode(',',self::$order->participation_admin['skill']) .'；'.Carbon::createFromDate()->format("H:i:s") :'';
        $sheet->setCellValue('C'.($count + 16),'技术确认')->mergeCells('C' . ($count + 16) . ':' . 'D' . ($count + 16));
        $sheet->setCellValue('E'.($count + 16),$skill)->mergeCells('E' . ($count + 16) . ':' . 'F' . ($count + 16));
        $sheet->setCellValue('A'.($count + 17),'款项确认');
        $sheet->setCellValue('B'.($count + 17),'');
        $pack=!empty(self::$order->participation_admin['pack']) ? implode(',',self::$order->participation_admin['pack']) .'；'.Carbon::createFromDate()->format("H:i:s") :'';
        $sheet->setCellValue('C'.($count + 17),'打包物流')->mergeCells('C' . ($count + 17) . ':' . 'D' . ($count + 17));
        $sheet->setCellValue('E'.($count + 17),$pack)->mergeCells('E' . ($count + 17) . ':' . 'F' . ($count + 17));
        $sheet->setCellValue('A'.($count + 18),'制表日期：'.Carbon::createFromDate())->mergeCells('A'.($count + 18).':'.'F'.($count + 18));
        $event->sheet->setWidthHeight([
            'width'=>[
                'A'=>10, 'B'=>40, 'C'=>6, 'D'=>10, 'E'=>10,
                'F'=>12
            ],
            'height'=>[
                1=>30,4=>30,3=>20
            ],
        ]);
        $row_num = $count + 15;
       for ($i = 5; $i < $row_num; $i++){
            $sheet->getRowDimension($i)->setRowHeight(20);
       }
        //设置样式

        $event->sheet->styleCells('A1', ['font' => ['bold' => true,'size' => 16]]);
        $event->sheet->styleCells('A2', ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('E' . ($count + 8) . ':' . 'E' . ($count + 9), ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 10), ['font' => ['bold' => true],'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B' . ($count + 7), ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B' . ($count + 8).':B'.($count + 12), ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B3:B5', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A3'.':F'. ($count + 18), ['borders'=>['allBorders'=>['borderStyle'=>Border::BORDER_THIN]]]);
        $event->sheet->styleCells('A6:F6', ['font' => ['bold' => true],'fill' => ['fillType' =>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']]]);
        $event->sheet->styleCells('A' . ($count + 10) . ':' . 'F' . ($count + 10), ['fill' => ['fillType' =>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']]]);
        $event->sheet->styleCells('D' . ($count + 11) . ':' . 'D' . ($count + 18), ['font' => ['bold' => true],'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 18), ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        if(self::$order->order_type != 'parts' ){
            BaseSheetExport::setImages($sheet,public_path('pic/about/about1.jpg'),'G1',50,50);
        }
    }
}