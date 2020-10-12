<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist_model extends Model
{
   protected $table = 'wishlist_';
   protected $primarykey = 'id';
   protected $fillable = ['pro_id','user_id'];
}
