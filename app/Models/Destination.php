<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    public function counter_details(){
        return $this->belongsTo('App\Models\Counter', 'counter_id', 'id');
    }
}
