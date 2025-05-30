<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Check extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;

    protected $table ='checks';

    protected $fillable = [
        'u_name',
        'email',
        'dob',
        'password'
    ];
}
