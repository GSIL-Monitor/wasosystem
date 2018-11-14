<?php

namespace App\Exports;

use App\Models\CompleteMachine;
use App\Models\Order;
use Carbon\Carbon;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

class ContractDocExport
{
    static $order;
    public function __construct(Order $order)
    {
        self::$order=$order;
    }

    public static function doc($order,$request,$default_company)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        //设置默认样式
        $phpWord->setDefaultFontName('Microsoft Yahei UI');//字体
        $phpWord->setDefaultFontSize(16);//字号
        $section = $phpWord->addSection();
        self::Header($section);
//        $company=config('status.'.$request->get('company'));
//        $phpWord->addNumberingStyle(
//            'hNum',
//            array('type' => 'multilevel', 'levels' => array(
//                array('pStyle' => 'Heading1', 'format' => 'decimal', 'text' => '%1'),
//                array('pStyle' => 'Heading2', 'format' => 'decimal', 'text' => '%1.%2'),
//                array('pStyle' => 'Heading3', 'format' => 'decimal', 'text' => '%1.%2.%3'),
//            )
//            )
//        );
//        $TitleFontStyle = ['name' => 'Microsoft Yahei UI', 'size' => 18, 'color' => '#000000', 'bold' => true,];
//        $section->addTextBreak(1);// 换行符
//        $section->addText('产品购销合同', $TitleFontStyle,array('alignment'=>Jc::CENTER));
//        $section->addTextBreak(1);// 换行符
//        $styleTable = array('borderSize'=>0, 'borderColor'=>'ffffff', 'cellMargin'=>80);
//
//        $styleCell = array('valign'=>'center', 'align'=>'left');
//        $fontStyle = array( 'size' => 10.5, 'color' => '#000000');
//        $phpWord->addTableStyle('myOwnTableStyle', $styleTable, $fontStyle);
//        $table = $section->addTable('myOwnTableStyle');
//        $table->addRow();
//        $contract_NO=optional($order->company)->unit_code  ?? optional($default_company)->unit_code;
//        $table->addCell(6000)->addText('甲方：'.optional($order->company)->unit  ??  optional($default_company)->unit, $fontStyle, $styleCell);
//        $table->addCell(4000)->addText('合同编号：'.$contract_NO.$request->get('company').\Carbon\Carbon::createFromDate()->format('Ymd').'A', $fontStyle, $styleCell);
//        $table->addRow();
//        $table->addCell(6000)->addText('乙方：'.$company['danwei'], $fontStyle, $styleCell);
//        $table->addCell(4000)->addText('签订地点：成都', $fontStyle, $styleCell);
//        $section->addText('一、产品名称、规格明细、单位、数量、单价、金额',$fontStyle, $styleCell);
//        //物料列表
//        $tableListStyle = array('borderSize'=>1, 'borderColor'=>'000000', 'cellMargin'=>80);
//        $phpWord->addTableStyle('tableListStyle', $tableListStyle, $fontStyle);
//        $tableList = $section->addTable('tableListStyle');
//        if($order->order_type !='parts'){
//           self::complete_machine($tableList,$order,$request);
//        }
//        // Define styles
//        $fontStyleName = 'myOwnStyle';
//        $phpWord->addFontStyle($fontStyleName, array('color' => 'FF0000'));
//        $paragraphStyleName = 'P-Style';
//        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 95));
//        $multilevelNumberingStyleName = 'multilevel';
//        $phpWord->addNumberingStyle(
//            $multilevelNumberingStyleName,
//            array(
//                'type'   => 'multilevel',
//                'levels' => array(
//                    array('format' => 'upperLetter', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
//                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
//                ),
//            )
//        );
//        //合计
//        $totaltable= $section->addTable('tableListStyle');
//        $totaltable->addRow();
//        $totaltable->addCell(1000)->addText('合计金额', $fontStyle, $styleCell);
//        $totaltable->addCell(8000)->addText('￥'.$order->total_prices.'.00', array( 'size' => 10.5, 'color' => '#E11512'), array('valign'=>'center', 'align'=>'left'));
//        $totaltable->addRow();
//        $totaltable->addCell(1000)->addText('大写合计', $fontStyle, $styleCell);
//        $totaltable->addCell(8000)->addText(num2rmb($order->total_prices), array( 'size' => 10.5, 'color' => '#E11512'), array('valign'=>'center', 'align'=>'left'));
//        $section->addText('（注：订购产品非产品质量和硬件型号不符合问题，甲方不能退货）',$fontStyle, $styleCell);
//        $section->addText('二、质量保证：产品质量标准按照行业通用技术要求及厂商规范为准。',$fontStyle, $styleCell);
//        $section->addText('三、售后服务：乙方对所售出产品按生产厂家公开承诺之售后服务条款执行。在质保期内出现的质量问题，乙方免费进行相应质保年限更换；若因甲方使用不当造成损坏，乙方酌情收取维修费。在质保期内需要换货，换货仅限同型号产品，以下情况不属保修范围（以到货签收时间为准）：',$fontStyle,array('valign'=>'center', 'align'=>'left'));
//
//        $section->addListItem('二、质量保证：产品质量标准按照行业通用技术要求及厂商规范为准。', 0, null, $multilevelNumberingStyleName);
//        $section->addListItem('三、售后服务：乙方对所售出产品按生产厂家公开承诺之售后服务条款执行。在质保期内出现的质量问题，乙方免费进行相应质保年限更换；若因甲方使用不当造成损坏，乙方酌情收取维修费。在质保期内需要换货，换货仅限同型号产品，以下情况不属保修范围（以到货签收时间为准）：', 0, null, $multilevelNumberingStyleName);
//        $section->addListItem('List Item II.a', 1, null, $multilevelNumberingStyleName);
//        $section->addListItem('List Item III', 0, null, $multilevelNumberingStyleName);

        //  // 简单文本
   //     $section->addTitle('CA重庆起止-阿联酋7天5晚', 1);
//        $table = $header->addTable(array('border'=>0));
//        $section->addTextBreak(2);// 两个换行符
//        $table->addRow();
//        $table->addCell(5200)->addImage(asset('admin/doc/logo.png'), array('width' => 200, 'height' => 40, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END));
//        $cell = $table->addCell(3800);
//        $cell->addText('成都网烁信息科技有限公司   WASO.COM.CN',  array('size'=>9,'color'=>'1B2232'), array('spaceBefore' =>530,'alignment'=>\PhpOffice\PhpWord\SimpleType\Jc::LEFT));
        $phpWord=IOFactory::load(resource_path('views/admin/orders/doc/contract.blade.php'));



       self::Footer($section);
        $file = 'HelloWorld.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter =IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");
    }

    public static function parts()
    {
        
    }

    public static function complete_machine($table,$order,$request)
    {
        $styleCell = array('valign'=>'center', 'align'=>'center');
        $fontStyle = array( 'size' => 10.5, 'color' => '#000000');
        $table->addRow();
        $table->addCell(1000)->addText('品名', $fontStyle, $styleCell);
        $table->addCell(3000)->addText('规格', $fontStyle, $styleCell);
        $table->addCell(1000)->addText('数量', $fontStyle, $styleCell);
        $table->addCell(1000)->addText('单价', $fontStyle, $styleCell);
        $table->addCell(1000)->addText('金额', $fontStyle, $styleCell);
        $table->addCell(2000)->addText('备注', $fontStyle, $styleCell);
        $table->addRow();
        $table->addCell(1000)->addText('服务器', $fontStyle, $styleCell);
        $table->addCell(3000)->addText($order->machine_model, $fontStyle, $styleCell);
        $table->addCell(1000)->addText($order->num, $fontStyle, $styleCell);
        $table->addCell(1500)->addText($order->unit_price, $fontStyle, $styleCell);
        $table->addCell(1500)->addText($order->total_prices, $fontStyle, $styleCell);
        $table->addCell(2000)->addText($request->get('des'), $fontStyle, $styleCell);



    }
    public static function Header($section)
    {
        $header = $section->addHeader();
        $imageStyle = array(
            'width' => 150,
            'height' => 38,
        );
        $header->addWatermark(asset('admin/doc/logo.png'), $imageStyle);
        $headerfontStyle = [
            'name' => 'Microsoft Yahei UI',
            'size' => 10,
            'color' => '#000000',
            'bold' => true
        ];
        $header->addText('成都网烁信息科技有限公司 WASO.COM.CN',  $headerfontStyle, array('alignment'=>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT));
    }
    public static function Footer($section)
    {
        //添加页脚
        $footer = $section->addFooter();
        $footerfontStyle = [
            'name' => 'Microsoft Yahei UI',
            'size' => 9,
            'color' => '#000000',
            'bold' => true,
        ];
        $footer->addPreserveText('地址：成都市高新区高朋东路2号搏润科技园1楼1101号 / 邮编：610093 / 电话：028-62751968（多线）',$footerfontStyle,array('alignment'=>\PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    }
}