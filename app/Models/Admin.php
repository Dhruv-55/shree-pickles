<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    const ACTIVE = 1,INACTIVE =2;
    protected $fillable = [
        'username','name','email','password','phone','status'
    ];


    public function createAdmin(){
        self::create([
            'name' => 'Dhruv Kumar',
            'username' => 'dhruva0786',
            'email' => 'dhruva0786@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => 9512565855
        ]);
    }
}
