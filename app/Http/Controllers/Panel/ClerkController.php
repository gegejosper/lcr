<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Que;
use App\Models\Counter;
use App\Models\QueCounter;
use Response;
use Validator;

class ClerkController extends Controller
{
    //
    public function index(){
        $counters = Counter::get();
        $page_name="Counter";
        return view('panel.counters.dashboard', compact('page_name', 'counters'));
    }
}
