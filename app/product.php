<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table ='products';
    protected $primarykey = 'id';
    protected $fillable = [
        'pro_name', 'pro_price', 'pro_info','ship_price','pro_code','image','categories','stock'
    ];
}
