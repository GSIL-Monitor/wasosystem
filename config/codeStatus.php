<?php
return [
    'barcode_associateds_type' => [
        'procurement' => '采购', 'test' => '测试品', 'sell' => '销售', 'loan_out' => '借出', 'stock_returns' => '进货退货',
        'new' => '新品', 'good' => '良品', 'bad' => '坏货', 'breakage' => '报损', 'sell_return' => '销售退货', 'warranty_replacement' => '质保更换',
        'quality_acceptance' => '质保受理', 'loan_out_to_replace' => '借转更换', 'returned_to_the_factory' => '返厂在途', 'factory_return' => '返厂返回',
        'warranty_returned_to_the_factory' => '质保返厂', 'quality_take_away' => '质保取走', 'escrow_to_storage' => '代管转入库', 'test_return' => '测试品归还',
        'test_to_procurement' => '测试品转采购', 'product_replacement' => '产品更换', 'loan_out_return' => '借出还回', 'quality_return' => '质保返回',
        'borrow_to_sales' => '借转销售', 'models_to_replace' => '型号更换'
    ],

    'test' => [
        'test_return' => '测试品归还', 'test_to_procurement' => '测试品转采购'
    ],
    'loan_out' => [
        'loan_out_return' => '借出还回', 'borrow_to_sales' => '借转销售'
    ],
    'quality_return' => [
        'quality_take_away' => '质保取走', 'escrow_to_storage' => '代管转入库', 'breakage' => '报损'
    ],
    'bad' => [
        'returned_to_the_factory' => '返厂在途', 'stock_returns' => '进货退货', 'breakage' => '报损', 'models_to_replace' => '型号更换'
    ],
    'warranty_replacement换出' => [
        'sell_return' => '销售退货', 'warranty_replacement' => '质保更换',
        'quality_acceptance' => '质保受理', 'loan_out_to_replace' => '借转更换'
    ],
    'warranty_replacement换入' => [
        'bad' => '坏货', 'stock_returns' => '进货退货', 'models_to_replace' => '型号更换'
    ],
    'models_to_replace' => [
        'bad' => '坏货', 'stock_returns' => '进货退货', 'models_to_replace' => '型号更换'
    ],
    'sell_return' => [
        'bad' => '坏货', 'stock_returns' => '进货退货', 'models_to_replace' => '型号更换'
    ],
    'quality_acceptance' => [
        'warranty_returned_to_the_factory' => '质保返厂', 'sell_return' => '销售退货',
        'warranty_replacement' => '质保更换', 'quality_take_away' => '质保取走'
    ],
    'warranty_returned_to_the_factory' => [
        'factory_return' => '返厂返回', 'quality_return' => '质保返回'
    ],
    'returned_to_the_factory' =>[
        'factory_return' => '返厂返回', 'quality_return' => '质保返回'
    ],
    'quality_take_away' => [
        'sell_return' => '销售退货', 'warranty_replacement' => '质保更换',
        'quality_acceptance' => '质保受理', 'loan_out_to_replace' => '借转更换'
    ],






];