<?php

use Maatwebsite\Excel\Excel;

return [
    'exports'            => [

        /*
        |--------------------------------------------------------------------------
        | Chunk size
        |--------------------------------------------------------------------------
        |
        | 当使用FromQuery时，将自动对查询进行分组。
        | 这里可以指定块的大小。
        |
        */
        'chunk_size' => 1000,

        /*
        |--------------------------------------------------------------------------
        | 临时路径
        |--------------------------------------------------------------------------
        |
        | 在导出文件时，我们在存储之前使用一个临时文件
        | 或下载。在这里，您可以自定义该路径。
        |
        */
        'temp_path'  => sys_get_temp_dir(),

        /*
        |--------------------------------------------------------------------------
        | CSV设置
        |--------------------------------------------------------------------------
        |
        | 为CSV导出配置例如分隔符、附件和行尾。
        |
        */
        'csv'        => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => PHP_EOL,
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 扩展器
    |--------------------------------------------------------------------------
    |
    | Configure here which writer type should be used when
    | the package needs to guess the correct type
    | based on the extension alone.
    |
    */
    'extension_detector' => [
        'xlsx'     => Excel::XLSX,
        'xlsm'     => Excel::XLSX,
        'xltx'     => Excel::XLSX,
        'xltm'     => Excel::XLSX,
        'xls'      => Excel::XLS,
        'xlt'      => Excel::XLS,
        'ods'      => Excel::ODS,
        'ots'      => Excel::ODS,
        'slk'      => Excel::SLK,
        'xml'      => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm'      => Excel::HTML,
        'html'     => Excel::HTML,
        'csv'      => Excel::CSV,

        /*
        |--------------------------------------------------------------------------
        | PDF Extension
        |--------------------------------------------------------------------------
        |
        | 在这里配置默认使用哪个Pdf驱动程序。
        |
        | 可用选项: Excel::MPDF | Excel::TCPDF | Excel::DOMPDF
        |
        */
        'pdf'      => Excel::DOMPDF,
    ],
];
