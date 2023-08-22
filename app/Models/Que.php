<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Que extends Model
{
    use HasFactory;
    public function client_detail(){
        return $this->belongsTo('App\Models\Client', 'customer_id', 'id');
    }
    public function destination_detail(){
        return $this->belongsTo('App\Models\Destination', 'destination_id', 'id');
    }
}
