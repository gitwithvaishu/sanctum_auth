<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DairyTask extends Model
{
    protected $table='dairy_tasks';
    protected $fillable=[
        'user_id',
        'date',
        'thoughts'
    ];

    public function user(){
        return $this->belongsTo(Dairy::class);
    }
}
