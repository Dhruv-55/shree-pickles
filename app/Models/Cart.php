<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','product_id','qty','variation_id'
    ];

    protected $appends = ['total_amount'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getTotalAmountAttribute()
    {
        return  $this->product->selling_price * $this->qty;
    }

    public function getDiscountAmountAttribute(){
        return $this->product->original_price -  $this->product->selling_price;
    }

   
}
