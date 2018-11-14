<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Service;
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


class ServiceSheetExport implements WithEvents
{
    static $service;
    use Exportable, RegistersEventListeners;

    public function __construct(Service $service)
    {
        self::$service=$service;
    }

    public static function afterSheet(AfterSheet $event)
    {

        $sheet= $event->sheet->getDelegate();
        $sheet->setCellValue('A1', '网烁公司上门服务单')->mergeCells('A1:F1');
        $sheet->setCellValue('A2', '服务单号：'.self::$service->serial_number )->mergeCells('A2:F2');
        $sheet->setCellValue('A3', '客户账户：');
        $sheet->setCellValue('B3', self::$service->username)->mergeCells('B3:D3');
        $sheet->setCellValue('E3', '建单时间：');
        $sheet->setCellValue('F3', today()->format('Y-m-d'));
        $sheet->setCellValue('A4', '服务地址：');
        $sheet->setCellValue('B4', '')->mergeCells('B4:F4');
        $sheet->setCellValue('A5', '相关订单号：');
        $sheet->setCellValue('B5', self::$service->order_serial_number)->mergeCells('B5:F5');
        $sheet->setCellValue('A6', '物 料');
        $sheet->setCellValue('B6', '规 格')->mergeCells('B6:D6');
        $sheet->setCellValue('E6', '数 量');
        $sheet->setCellValue('F6', '备注');
        $num=0;

        $product_goods=self::$service->order->order_product_goods()->orderBy('product_number','asc')->get();
        $count=0;
        if($product_goods->isNotEmpty()){
            $count=$product_goods->count();
            foreach ($product_goods as $key=>$item){
                $num+=$item->pivot->product_good_num;
                $sheet->setCellValue('A'.($key + 7), $item->product->title);
                $sheet->setCellValue('B'.($key + 7), $item->name)->mergeCells('B' . ($key + 7) . ':' . 'D' . ($key + 7));
                $sheet->setCellValue('E'.($key + 7), $item->pivot->product_good_num);
                $sheet->setCellValue('F'.($key + 7), '');
                $sheet->getRowDimension(($key + 7))->setRowHeight(25);
                $event->sheet->styleCells('B'.($key + 7), [ 'alignment' => ['wrapText'=>true,'horizontal' => Alignment::HORIZONTAL_LEFT]]);
            }
        }
        $sheet->setCellValue('A'.($count + 7), '故障描述:')->mergeCells('A' . ($count + 7) . ':' . 'A' . ($count + 9));
        $sheet->setCellValue('B'.($count + 7), self::$service->error_description)->mergeCells('B' . ($count + 7) . ':' . 'F' . ($count + 9));
        $sheet->setCellValue('A'.($count + 10), '解决办法:')->mergeCells('A' . ($count + 10) . ':' . 'A' . ($count + 12));
        $sheet->setCellValue('B'.($count + 10), self::$service->solution)->mergeCells('B' . ($count + 10) . ':' . 'F' . ($count + 12));

        $sheet->setCellValue('A'.($count + 13), '服务信息:')->mergeCells('A' . ($count + 13) . ':' . 'F' . ($count + 13));
        $sheet->setCellValue('A'.($count + 14), '上门人员：');
        $admin=[];
        if(!empty(self::$service->door_and_service_staff['door'])){
            $admin=Admin::whereIn('account',self::$service->door_and_service_staff['door'])->pluck('name')->toArray();
        }
        $sheet->setCellValue('B'.($count + 14), implode(' | ',$admin))->mergeCells('B' . ($count + 14) . ':' . 'F' . ($count + 14));
        $sheet->setCellValue('A'.($count + 15), '预约日期');
        $sheet->setCellValue('B'.($count + 15), self::$service->door_of_time)->mergeCells('B' . ($count + 15) . ':' . 'C' . ($count + 15));
        $sheet->setCellValue('D'.($count + 15), '到达时间');
        $sheet->setCellValue('E'.($count + 15), '')->mergeCells('E' . ($count + 15) . ':' . 'F' . ($count + 15));
        $sheet->setCellValue('A'.($count + 16), '服务信息')->mergeCells('A' . ($count + 16) . ':' . 'F' . ($count + 16));
        $sheet->setCellValue('A'.($count + 17), 'A、已解决；     B、还需测试验证；     C、还需再次上门处理；      D、未解决，需另查找原因。')->mergeCells('A' . ($count + 17) . ':' . 'F' . ($count + 17));
        $sheet->setCellValue('A'.($count + 18), '本次服务评价')->mergeCells('A' . ($count + 18) . ':' . 'F' . ($count + 18));
        $sheet->setCellValue('A'.($count + 19), '不满意')->mergeCells('A' . ($count + 19) . ':' . 'B' . ($count + 19));
        $sheet->setCellValue('C'.($count + 19), '满意')->mergeCells('C' . ($count + 19) . ':' . 'D' . ($count + 19));
        $sheet->setCellValue('E'.($count + 19), '非常满意')->mergeCells('E' . ($count + 19) . ':' . 'F' . ($count + 19));
        $sheet->setCellValue('A'.($count + 20), '0分')->mergeCells('A' . ($count + 20) . ':' . 'B' . ($count + 20));
        $sheet->setCellValue('C'.($count + 20), '3分')->mergeCells('C' . ($count + 20) . ':' . 'D' . ($count + 20));
        $sheet->setCellValue('E'.($count + 20), '5分')->mergeCells('E' . ($count + 20) . ':' . 'F' . ($count + 20));
        $sheet->setCellValue('A'.($count + 21), '其它信息及客户意见：')->mergeCells('A' . ($count + 21) . ':' . 'F' . ($count + 24));
        $sheet->setCellValue('A'.($count + 25), '客户签字：__________________')->mergeCells('A' . ($count + 25) . ':' . 'C' . ($count + 25));
        $sheet->setCellValue('D'.($count + 25), '客户签字：__________________')->mergeCells('D' . ($count + 25) . ':' . 'F' . ($count + 25));
        $event->sheet->setWidthHeight([
            'width'=>[
                'A'=>15, 'B'=>20, 'C'=>15, 'D'=>15, 'E'=>15,
                'F'=>15
            ],
            'height'=>[
                1=>20,2=>25,3=>25,4=>25,5=>25,6=>25,
                7=>20,8=>25,9=>20,10=>20,($count + 13)=>25,($count + 14)=>25
                ,($count + 15)=>25,($count + 16)=>25  ,($count + 17)=>25,($count + 18)=>25
                ,($count + 19)=>25,($count + 20)=>25,($count + 25)=>30
            ],
        ]);
        $event->sheet->styleCells('A1'. ':' . 'F' . ($count + 25), ['font' => ['name' => '微软雅黑', 'size' => 10], 'alignment' => ['vertical'=>Alignment::VERTICAL_CENTER,'horizontal' => Alignment::HORIZONTAL_CENTER]]);
        $event->sheet->styleCells('A3'. ':' . 'F' . ($count + 25), ['borders'=>['allBorders'=>['borderStyle'=>Border::BORDER_THIN]]]);
        //设置样式
        $event->sheet->styleCells('A1', ['font' => ['bold' => true,'size' => 16]]);
        $event->sheet->styleCells('A2', ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('B3:B5', ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A6:F6', ['font'=>['bold'=>true],'fill'=>['fillType'=>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']]]);
        $event->sheet->styleCells('A' . ($count + 13) . ':' . 'F' . ($count + 13), ['font'=>['bold'=>true],'fill'=>['fillType'=>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 16) . ':' . 'F' . ($count + 16), ['font'=>['bold'=>true],'fill'=>['fillType'=>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 18) . ':' . 'F' . ($count + 18), ['font'=>['bold'=>true],'fill'=>['fillType'=>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B' . ($count + 14) , ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 21) , ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'vertical'=>Alignment::VERTICAL_TOP]]);
        $event->sheet->styleCells('A' . ($count + 25). ':' . 'F' . ($count + 25) , ['font' => ['bold' => true], 'alignment' => ['vertical'=>Alignment::VERTICAL_BOTTOM]]);
        $event->sheet->styleCells('B' . ($count + 7) . ':' . 'F' . ($count + 10), ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'vertical'=>Alignment::VERTICAL_TOP]]);
//        $event->sheet->styleCells('B3:B6', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
//        $event->sheet->styleCells('D3:D6', ['borders'=>['right'=>['borderStyle'=>Border::BORDER_NONE]]]);
//        $event->sheet->styleCells('E3:E6', ['borders'=>['left'=>['borderStyle'=>Border::BORDER_NONE]]]);
//        $event->sheet->styleCells('H3:H6', ['borders'=>['right'=>['borderStyle'=>Border::BORDER_NONE]]]);
//        $event->sheet->styleCells('I3:I6', ['borders'=>['left'=>['borderStyle'=>Border::BORDER_NONE]]]);
//        $event->sheet->styleCells('A9:I9', ['font'=>['bold'=>true],'alignment'=>['horizontal'=>Alignment::HORIZONTAL_LEFT]]);
//        $event->sheet->styleCells('A10:I10', ['font'=>['bold'=>true],'alignment'=>['horizontal'=>Alignment::HORIZONTAL_LEFT]]);
//        $event->sheet->styleCells('A8', ['alignment' => ['wrapText'=>true]]);
//        $event->sheet->styleCells('B8', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
//        $event->sheet->styleCells('I8', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
//        $event->sheet->styleCells('E3', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
    }
}