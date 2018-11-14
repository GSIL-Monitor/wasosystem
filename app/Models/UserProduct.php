<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $fillable=['user_id','product_good_id','product_good_num','product_good_price','product_good_raid','product_number','type'];
    public $timestamps=false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product_good()
    {
        return $this->belongsTo(ProductGood::class);
    }
}
