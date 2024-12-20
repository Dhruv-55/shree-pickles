<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;

    protected $fillable =[
        'cancel_order_id','user_id','reason','admin_id','order_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function order(){
        return $this->belongsTo(Order::class);
    }

}
