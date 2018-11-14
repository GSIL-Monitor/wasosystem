<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//会员单位管理Model
class UserCompany extends Model
{
   protected $casts=[];
   protected $fillable=['user_id','number','name','unit','address','unit_phone','fax','zip','url','tax_mode','tax_number','account'
       ,'opening_bank','bank_address','bank_phone','finance','finance_phone','logistics','default'];

   public function getInvoiceTypeAttribute(){
       return $this->tax_mode == 'no_invoice' ?  '个人采购' : '单位采购';
    }
}