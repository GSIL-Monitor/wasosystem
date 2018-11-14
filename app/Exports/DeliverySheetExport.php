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


class DeliverySheetExport implements WithEvents
{
    static $order;
    use Exportable, RegistersEventListeners;

    public function __construct(Order $order)
    {
        self::$order = $order;
    }

    public static function afterSheet(AfterSheet $event)
    {
        $comm_info=BaseSheetExport::commInfo(self::$order);
        $invoice =$comm_info['invoice'];
        $invoice_name =$comm_info['invoice_name'];
        $company=$comm_info['company'];
        $product_goods = self::$order->order_product_goods()->oldest('product_number')->get();
        $count = $product_goods->count();
        $service = self::$order->service()->whereType('service')->first();
        $payment = self::$order->payment()->whereType('payment_status')->first();

        $sheet = $event->sheet->getDelegate();
        $sheet->setCellValue('A1', '网烁信息科技出库单(' . self::$order->serial_number . ')')->mergeCells('A1:H1');
        $sheet->setCellValue('A2', '收货单位');
        $sheet->setCellValue('B2', $company . ' ' . self::$order->user->username . ' ' . self::$order->user->nickname . ' | 联系电话 ' . self::$order->user->phone)->mergeCells('B2:E2');
        $sheet->setCellValue('F2', "客户：" . self::$order->user_remark . "\n" . "公司：" . self::$order->company_remark)->mergeCells('F2:H' . ($count + 4));
        $sheet->mergeCells('C2:D2');
        $sheet->setCellValue('A3', '品 名');
        $sheet->setCellValue('B3', '规 格');
        $sheet->setCellValue('C3', '数 量');
        $sheet->setCellValue('D3', '单 价');
        $sheet->setCellValue('E3', '金 额');

        $event->sheet->styleCells('A1:' . 'H' . ($count + 5), ['font' => ['name' => '微软雅黑', 'size' => 10], 'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true]]);
        foreach ($product_goods as $key => $item) {
            if (self::$order->invoice_type == 'no_invoice') {
                $unit_price = ceil($item->pivot->product_good_price * self::$order->user->tax_rates->identifying);
            } else {
                $unit_price = $item->pivot->product_good_price;
            }
            $num = $item->pivot->product_good_num / self::$order->num;
            $sheet->setCellValue('A' . ($key + 4), $item->product->title);
            $sheet->setCellValue('B' . ($key + 4), $item->name);
            $sheet->setCellValue('C' . ($key + 4), $num);
            $sheet->setCellValue('D' . ($key + 4), $unit_price);
            $sheet->setCellValue('E' . ($key + 4), $unit_price * $num);
            $sheet->getRowDimension(($key + 4))->setRowHeight(20);
            $event->sheet->styleCells('B' . ($key + 4), ['alignment' => ['wrapText' => true, 'horizontal' => Alignment::HORIZONTAL_LEFT]]);
        }
        $sheet->setCellValue('A' . ($count + 4), "款项状态：" . $payment->name . "| 客户账期：" . self::$order->user->payment_days . "天 | （" . $invoice . "）")->mergeCells('A' . ($count + 4) . ':' . 'C' . ($count + 4));
        $sheet->setCellValue('D' . ($count + 4), '单套合计');
        $sheet->setCellValue('E' . ($count + 4), '=SUM(E4:E' . ($count + 3) . ')');
        $sheet->setCellValue('A' . ($count + 5), "合计金额：" . num2rmb(self::$order->total_prices) . ' | 优惠合计：' . self::$order->total_prices)->mergeCells('A' . ($count + 5) . ':' . 'C' . ($count + 5));
        $sheet->setCellValue('D' . ($count + 5), '多套合计');
        $sheet->setCellValue('E' . ($count + 5), '=E' . ($count + 4) . '*G' . ($count + 5));
        $sheet->setCellValue('F' . ($count + 5), '数量');
        $sheet->setCellValue('G' . ($count + 5), self::$order->num)->mergeCells('G' . ($count + 5) . ':' . 'H' . ($count + 5));
        $acceptance = !empty(self::$order->participation_admin['acceptance']) ? implode(',', self::$order->participation_admin['acceptance']) : '';
        $skill = !empty(self::$order->participation_admin['skill']) ? implode(',', self::$order->participation_admin['skill']) : '';
        $pack = !empty(self::$order->participation_admin['pack']) ? implode(',', self::$order->participation_admin['pack']) : '';
        $sheet->setCellValue('A' . ($count + 6), "销售：" . self::$order->market . " | 受理：" . $acceptance . "| 技术：" . $skill . " | 打包：" . $pack . " | " . $service->name . "(" . $service->identifying . "元)")->mergeCells('A' . ($count + 6) . ':' . 'E' . ($count + 6));
        $sheet->setCellValue('F' . ($count + 6), "填单：" . auth('admin')->user()->name . ' | ' . Carbon::createFromDate()->format('Y-m-d'))->mergeCells('F' . ($count + 6) . ':' . 'H' . ($count + 6));

        $event->sheet->setWidthHeight([
            'width' => [
                'A' => 10, 'B' => 40, 'C' => 10, 'D' => 10, 'E' => 10,
                'F' => 10, 'G' => 10, 'H' => 10
            ],
            'height' => [
                1 => 20, 2 => 20, 3 => 20, 4 => 20, ($count + 5) => 20, ($count + 6) => 20
            ],
        ]);
        $row_num = $count + 15;
        for ($i = 5; $i < $row_num; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(20);
        }
        //设置样式

        $event->sheet->styleCells('A1', ['font' => ['bold' => true, 'size' => 16]]);
        $event->sheet->styleCells('A' . ($count + 4), ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B2', ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('B3', ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('F2', ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 4), ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A' . ($count + 5), ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('F' . ($count + 4), ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A2:' . 'H' . ($count + 6), ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]]);
        $event->sheet->styleCells('A3:E3', ['font' => ['bold' => true], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '98BDC9']]]);
        $event->sheet->styleCells('A' . ($count + 4) . ':' . 'H' . ($count + 6), ['font' => ['bold' => true]]);
    }
}