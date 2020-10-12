<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address_model extends Model
{
    protected $table ='address';
    protected $id ='id';
    protected $fillable =['firstname','lastname','city','state','phone','payment_type','user_id','street'];
}
