{!!  Form::text('supplier_managements_id', old('supplier_managements_id',optional($barcode_associated['supplier_managements'])->id ?? 0 )) !!}
{!!  Form::text('order_id',
old('order_id',
optional($barcode_associated['order'])->id ?? 0
),['placeholder'=>'订单id',"class"=>'','readonly']) !!}
{!!  Form::text('procurement_plans_id',
old('procurement_plans_id',
$barcode_associated['procurement_plan']->id ?? 0
),['placeholder'=>'入库id',"class"=>'','readonly']) !!}
{!!  Form::text('warehouse_out_management_id',
old('warehouse_out_management_id',
   $barcode_associated['warehouse_out_management']->id ??  0
),['placeholder'=>'出库id',"class"=>'','readonly']) !!}
{!!  Form::text('barcode_associated_id',
old('barcode_associated_id',
$barcode_associated['barcode_associated']->id ??  0
)
,['placeholder'=>'关联id',"class"=>'','readonly']) !!}