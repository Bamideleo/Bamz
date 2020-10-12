<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cart;
use Illuminate\Support\Facades\Auth;
class order_model extends Model
{
    protected $table ='orders';
    protected $primaryKey = 'id';
    protected $fillable = ['total','status','user_id'];



    public function Orderfield()
    {
        return $this->belongsToMany(product::class)->withPivot('qty','total');
    }
    public static function OrderCreate()
    {
       $user= Auth::user();
       $order=$user->order()->create(['total'=>cart::getTotal(),'status'=>'Pending']);
       $conitem=cart::getcontent();

       foreach($conitem as $itemcontent){
           $order->Orderfield()->attach($itemcontent->id, ['qty'=>$itemcontent->quantity,
           'total'=>$itemcontent->quantity*$itemcontent->price,'tax'=>$itemcontent->conditions->parsedRawValue]);
       }
    }
}
