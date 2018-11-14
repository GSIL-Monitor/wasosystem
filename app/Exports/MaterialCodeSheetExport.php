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


class MaterialCodeSheetExport implements WithEvents
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
        $product_goods=self::$order->order_product_goods()->oldest('product_number')->get();
        $count=$product_goods->count();
        $service=self::$order->service()->whereType('service')->first();
        $sheet= $event->sheet->getDelegate();
        $sheet->setCellValue('A1', '订单物料条码表')->mergeCells('A1:E1');
        $sheet->setCellValue('A2', '序列号：'.self::$order->serial_number )->mergeCells('A2:E2');
        $sheet->setCellValue('A3', '客户名称');
        $sheet->setCellValue('B3', $company.' '.self::$order->user->nickname)->mergeCells('B3:C3');
        $sheet->setCellValue('D3', '出库时间');
        $sheet->setCellValue('E3',self::$order->created_at->format('Y-m-d'));
        $sheet->setCellValue('A4', '物 料');
        $sheet->setCellValue('B4', '规 格');
        $sheet->setCellValue('C4', '数 量');
        $sheet->setCellValue('D4', '条码编号')->mergeCells('D4:E4');
        $event->sheet->styleCells('A1:E'.($count+7), ['font' => ['name' => '微软雅黑', 'size' => 10], 'alignment' => ['vertical'=>Alignment::VERTICAL_CENTER,'horizontal' => Alignment::HORIZONTAL_CENTER,'wrapText'=>true]]);
        $num=0;
        foreach ($product_goods as $key=>$item){
               $num+=$item->pivot->product_good_num;
               $sheet->setCellValue('A'.($key + 5), $item->product->title);
               $sheet->setCellValue('B'.($key + 5), $item->name);
               $sheet->setCellValue('C'.($key + 5), $item->pivot->product_good_num);
               $sheet->setCellValue('D'.($key + 5), '')->mergeCells('D' . ($key + 5) . ':' . 'E' . ($key + 5));
               $sheet->getRowDimension(($key + 5))->setRowHeight(20);
               $event->sheet->styleCells('B'.($key + 5), [ 'alignment' => ['wrapText'=>true,'horizontal' => Alignment::HORIZONTAL_LEFT]]);
               $event->sheet->styleCells('E'.($key + 5), [ 'alignment' => ['wrapText'=>true,'horizontal' => Alignment::HORIZONTAL_LEFT]]);
        }
        $sheet->setCellValue('A'.($count + 5), '物料总数')->mergeCells('A' . ($count + 5) . ':' . 'B' . ($count + 5));
        $sheet->setCellValue('C'.($count + 5),$num);
        $sheet->mergeCells('D' . ($count + 5) . ':' . 'E' . ($count + 5));
        $sheet->setCellValue('A'.($count + 6),'成都网烁信息科技有限公司')->mergeCells('A' . ($count + 6) . ':' . 'E' . ($count + 6));
        $sheet->setCellValue('A'.($count + 7),'导出日期：'.Carbon::createFromDate()->format('Y-m-d').' 制表人：'.auth('admin')->user()->name)->mergeCells('A' . ($count + 7) . ':' . 'E' . ($count + 7));
        $event->sheet->setWidthHeight([
            'width'=>[
                'A'=>11, 'B'=>50, 'C'=>6, 'D'=>16, 'E'=>16
            ],
            'height'=>[
                1=>30,2=>25,3=>25,4=>25,($count + 5)=>25,($count + 6)=>20,($count + 7)=>20
            ],
        ]);

        //设置样式
        $event->sheet->styleCells('A1', ['font' => ['bold' => true,'size' => 16]]);
        $event->sheet->styleCells('A2', ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('B3', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 5), [ 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('A' . ($count + 6), [ 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('A' . ($count + 7), [ 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('A3'.':E'. ($count + 5), ['borders'=>['allBorders'=>['borderStyle'=>Border::BORDER_THIN]]]);
        $event->sheet->styleCells('A4:E4', ['font' => ['bold' => true],'fill' => ['fillType' =>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']]]);
        $event->sheet->styleCells('A' . ($count + 6) . ':' . 'A' . ($count + 7), ['font' => ['bold' => true]]);

    }
}