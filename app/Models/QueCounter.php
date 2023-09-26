<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueCounter extends Model
{
    use HasFactory;
    public function que_details(){
        return $this->belongsTo('App\Models\Que', 'que_id', 'id');
    }
}
