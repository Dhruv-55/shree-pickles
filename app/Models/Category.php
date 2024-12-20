<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const ACTIVE = 1 , INACTIVE =2;
    protected $fillable = [
        'name','slug','description','image','parent_id'
    ];


    public function scopeActive($q){
        return $q->where('status',self::ACTIVE);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
