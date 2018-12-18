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


        'procurement_grade' => array('bad' => '坏货', 'stock_returns' => '进货退货','models_to_replace'=>'型号更换'),//采购 高级权限
        'bad_grade' => array('returned_to_the_factory' => '返厂在途', 'stock_returns' => '进货退货', 'breakage' => '报损','models_to_replace'=>'型号更换'),//坏货 高级权限
        'procurement' => array('bad' => '坏货','models_to_replace'=>'型号更换'),//采购
        'bad' => array('returned_to_the_factory' => '返厂在途'),//坏货
        'sell' => array('sell_return' => '销售退货', 'warranty_replacement' => '质保更换', 'quality_acceptance' => '质保受理', 'loan_out_to_replace' => '借转更换'),//销售
        'quality_acceptance' => array('warranty_returned_to_the_factory' => '质保返厂', 'sell_return' => '销售退货', 'warranty_replacement' => '质保更换', 'quality_take_away' => '质保取走'),//质保受理
        'loan_out' => array('borrow_to_sales' => '借转销售', 'loan_out_return' => '借出还回'),//借出
        'returned_to_the_factory' => array('factory_return' => '返厂返回', 'quality_return' => '质保返回'),//返厂在途
        'quality_return' => array('quality_take_away' => '质保取走', 'escrow_to_storage' => '代管转入库', 'breakage' => '报损'),//代管货品
        'test' => array('test_return' => '测试品归还', 'test_to_procurement' => '测试品转采购'),//测试品









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
    'warranty_replacement' => [
        'sell_return' => '销售退货', 'warranty_replacement' => '质保更换',
        'quality_acceptance' => '质保受理', 'loan_out_to_replace' => '借转更换'
    ],
    'warranty_replacement换进 有新条码!' => [
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

    'barcode_associateds_decription' => [
        'procurement' => '采购', //库存：(new,good,bad) 数量 + 1
        'test' => '测试品',//库存：(test) 数量 + 1
        'sell' => '销售',//库存：(new,good,bad) 数量 - 1
        'loan_out' => '借出', //库存：(new,good,bad) 数量 - 1
        'stock_returns' => '进货退货',//库存：(new,good,bad) 数量 - 1
        'new' => '新品',//产品成色(new)
        'good' => '良品',//产品成色(good)
         'bad' => '坏货', //产品成色(bad)
        'breakage' => '报损',//库存(bad,proxies) - 1
        'sell_return' => '销售退货',//库存：(new,good,bad) 数量 + 1
        'warranty_replacement' => '质保更换',//库存：换出(new,good,bad) 数量 - 1  换进 (new,good,bad) 数量 + 1
        'quality_acceptance' => '质保受理',//库存：(proxies) 数量 + 1
        'loan_out_to_replace' => '借转更换', //库存：换出(new,good,bad) 数量 - 1  换进 (new,good,bad) 数量 + 1
        'returned_to_the_factory' => '返厂在途', //库存：(return_factory) 数量 + 1
        'factory_return' => '返厂返回',//库存：(return_factory) 数量 - 1  如果有会员(proxies) 数量+1  否则  (new,good,bad) 数量 + 1
        'warranty_returned_to_the_factory' => '质保返厂', //库存：(return_factory) 数量 + 1
        'quality_take_away' => '质保取走', //库存：(proxies) 数量 - 1
        'escrow_to_storage' => '代管转入库',//库存：(proxies) 数量 - 1  (new,good,bad) 数量 + 1
        'test_return' => '测试品归还',//库存：(test) 数量 - 1  (new,good,bad) 数量 + 1
        'test_to_procurement' => '测试品转采购',//库存：(test) 数量 - 1  (new) 数量 + 1
        'product_replacement' => '产品更换',//库存：(test) 数量 - 1  (new) 数量 + 1
        'loan_out_return' => '借出还回',//库存：(new,good,bad) 数量 + 1
        'quality_return' => '质保返回',//库存：(return_factory) 数量 - 1  如果有会员(proxies) 数量+1  否则  (new,good,bad) 数量 + 1
        'borrow_to_sales' => '借转销售',//库存：不变
        'models_to_replace' => '型号更换'//库存：旧产品(new,good,bad) 数量 - 1  更换的新产品(new,good,bad) 数量 + 1
    ],




];