<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    public function serving_que(){
        return $this->hasMany('App\Models\Que','counter_id', 'id')->where('status', 'serving');
    }
}
