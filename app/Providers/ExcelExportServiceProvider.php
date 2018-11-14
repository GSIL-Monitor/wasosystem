<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Sheet;

class ExcelExportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //        Sheet::macro('setCellValue', function (Sheet $sheet, $a,$b) {
//            $sheet->getDelegate()->setCellValue($a,$b);
//        });
        Collection::macro('pluck_str',function ($symbolic_link){
            $arr=[];
            $this->map(function ($item) use (&$arr,$symbolic_link) {
                $id=$item->id;
                unset($item['id']);
                $arr[$id]=implode($symbolic_link,$item->toArray());
            });
            return $arr;
        });
        //设置样式
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        //设置行宽和行高
        Sheet::macro('setWidthHeight', function (Sheet $sheet,array $width_height) {
            foreach ($width_height as $key=>$item){
                if($key=='width'){
                    foreach ($item as $k=>$v){
                        $sheet->getDelegate()->getColumnDimension($k)->setWidth($v);
                    }
                }else{
                    foreach ($item as $k=>$v){
                        $sheet->getDelegate()->getRowDimension($k)->setRowHeight($v);
                    }
                }


            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
