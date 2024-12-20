<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    const ACTIVE = 1 , INACTIVE =2;

     protected $fillable = [
        'name','slug','image','status'
    ];

    public function scopeActive($q){
        return $q->where('status',self::ACTIVE);
    }
}
