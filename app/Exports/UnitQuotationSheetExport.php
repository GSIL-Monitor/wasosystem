<?php

namespace App\Exports;

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


class UnitQuotationSheetExport implements WithEvents
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
        $invoice =$comm_info['invoice'];
        $pic=str_after(order_complete_machine_pic(self::$order->order_product_goods),'storage/');
        $sheet= $event->sheet->getDelegate();
        $sheet->setCellValue('A1', '网烁服务器明细及报价')->mergeCells('A1:I1');
        $sheet->setCellValue('A2', '序列号：'.self::$order->serial_number )->mergeCells('A2:I2');
        $sheet->setCellValue('A3', '方案提供商');
        $sheet->setCellValue('A4', '方案联系人');
        $sheet->setCellValue('A5', '联系电话');
        $sheet->setCellValue('A6', '电子邮箱');
        $sheet->setCellValue('B3', '成都网烁信息科技有限公司')->mergeCells('B3:C3');
        $sheet->setCellValue('B4', self::$order->user->admins->name)->mergeCells('B4:C4');
        $sheet->setCellValue('B5', self::$order->user->admins->phone)->mergeCells('B5:C5');
        $sheet->setCellValue('B6', self::$order->user->admins->email)->mergeCells('B6:C6');
        $sheet->setCellValue('D3', '企业简介：')->mergeCells('D3:D6');
        $sheet->setCellValue('E3',  "Intel授权\"智造基地\"成员和铂金技术合作伙伴；美国超微华西区唯一的STAP授权合作伙伴；华硕工作站产品四川唯一代理。企业通过ISO9001质量管理体系认证和产品的3C认证；15年专研服务器定制，为您避免3大采购风险！")->mergeCells('E3:G6');
        $sheet->setCellValue('H3', '配置代码：')->mergeCells('H3:H6');
        $sheet->setCellValue('A7', '型号');
        $sheet->setCellValue('B7', '配置参数')->mergeCells('B7:E7');
        $sheet->setCellValue('F7', '数量');
        $sheet->setCellValue('G7', '单价');
        $sheet->setCellValue('H7', '金额');
        $sheet->setCellValue('I7', '备注');
        $sheet->setCellValue('A8', self::$order->machine_model);
        $sheet->setCellValue('B8', '* '.implode('\n* ',BaseSheetExport::material_details(self::$order)['complete_machine_detailed']))->mergeCells('B8:E8');
        $sheet->setCellValue('F8', self::$order->num);
        $sheet->setCellValue('G8', '￥'.self::$order->unit_price.'.00');
        $sheet->setCellValue('H8', '￥'.self::$order->total_prices.'.00');
        $sheet->setCellValue('I8', self::$order->user_remark);
        $sheet->setCellValue('A9', "注：以上" . $invoice . "价格(整机服务叁年)。交货时间：3-21个工作日，请与方案人员联系确认。")->mergeCells('A9:I9');
        $sheet->setCellValue('A10', '公司地址：四川省成都市武侯区高朋东路2号搏润科技园一楼101号610093')->mergeCells('A10:F10');
        $sheet->setCellValue('G10', '（报价有效期：三天）报价日期：'.Carbon::createFromDate()->format('Y-m-d'))->mergeCells('G10:I10');
        $sheet->mergeCells('I3:I6');
        $sheet->mergeCells('J1:P10');
        $event->sheet->setWidthHeight([
            'width'=>[
                'A'=>12, 'B'=>15, 'C'=>15, 'D'=>10, 'E'=>20,
                'F'=>8, 'G'=>12, 'H'=>12, 'I'=>18
            ],
            'height'=>[
                1=>20,2=>15,3=>25,4=>25,5=>25,6=>25,
                7=>20,8=>350,9=>20,10=>20
            ],
        ]);
        //设置样式
        $event->sheet->styleCells('A1:I10', ['font' => ['name' => '微软雅黑', 'size' => 10], 'alignment' => ['vertical'=>Alignment::VERTICAL_CENTER,'horizontal' => Alignment::HORIZONTAL_CENTER]]);
        $event->sheet->styleCells('A1', ['font' => ['bold' => true,'size' => 16]]);
        $event->sheet->styleCells('A2', ['font' => ['bold' => true], 'alignment' => ['horizontal' =>Alignment::HORIZONTAL_RIGHT]]);
        $event->sheet->styleCells('A3:I10', ['borders'=>['allBorders'=>['borderStyle'=>Border::BORDER_THIN]]]);
        $event->sheet->styleCells('B3:B6', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('D3:D6', ['borders'=>['right'=>['borderStyle'=>Border::BORDER_NONE]]]);
        $event->sheet->styleCells('E3:E6', ['borders'=>['left'=>['borderStyle'=>Border::BORDER_NONE]]]);
        $event->sheet->styleCells('H3:H6', ['borders'=>['right'=>['borderStyle'=>Border::BORDER_NONE]]]);
        $event->sheet->styleCells('I3:I6', ['borders'=>['left'=>['borderStyle'=>Border::BORDER_NONE]]]);
        $event->sheet->styleCells('A7:I7', ['font'=>['bold'=>true],'fill'=>['fillType'=>Fill::FILL_SOLID,'startColor'=>['rgb'=>'98BDC9']]]);
        $event->sheet->styleCells('A9:I9', ['font'=>['bold'=>true],'alignment'=>['horizontal'=>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A10:I10', ['font'=>['bold'=>true],'alignment'=>['horizontal'=>Alignment::HORIZONTAL_LEFT]]);
        $event->sheet->styleCells('A8', ['alignment' => ['wrapText'=>true]]);
        $event->sheet->styleCells('B8', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
        $event->sheet->styleCells('I8', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
        $event->sheet->styleCells('E3', ['alignment' => ['horizontal' =>Alignment::HORIZONTAL_LEFT,'wrapText'=>true]]);
        if(self::$order->order_type != 'parts' ) {
            BaseSheetExport::setImages($sheet,public_path('storage/'.$pic), 'J1', 50, 50);
        }
        BaseSheetExport::QrCode($sheet,self::$order,'I3',15,15);

    }
}