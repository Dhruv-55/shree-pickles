<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'link', 'type', 'position', 'status'];
    const BANNER = 1 , SLIDER = 2;
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopePosition($query, $position)
    {
        return $query->where('position', $position);
    }
}
