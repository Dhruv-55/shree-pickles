<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','original_price','selling_price','quantity','variation_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function variations()
    {
        return [
            1 => '250g',
            2 => '500g',
            3 => '1kg',
            4 => '2kg',
            5 => '5kg'
        ];
    }

    // Helper method to get variation name by key
    public static function variation($key)
    {
        return static::variations()[$key] ?? '';
    }

}
