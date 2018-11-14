<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterial extends Model
{
    protected $fillable=['product_number','product_good_num','product_good_price','product_good_raid'];
    public $timestamps = false;

}
