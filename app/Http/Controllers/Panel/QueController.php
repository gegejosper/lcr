<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Que;
use App\Models\QueCounter;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Counter;
use Response;
use Validator;

class QueController extends Controller
{
    //
    public function ques(){
        $ques = Que::with('client_detail', 'destination_detail.counter_details')->latest()->paginate(100);
        return view('panel.admin.ques', compact('ques'));
    }
    public function serve($counter_id){
        $que = Que::where('counter_id', $counter_id)->where('status', 'waiting')
        ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")
        ->first();

        $update_que = Que::find($que->id);
        $update_que->status = 'serving';
        $update_que->save();
        $update_que_counter = QueCounter::where('status', 'serving')->update(['status' => 'done']);
        $que_counter = new QueCounter();
        $que_counter->counter_id = $counter_id;
        $que_counter->que_id = $update_que->id;
        $que_counter->status = 'serving';
        $que_counter->save();  
        return redirect('/panel/clerk/counter/'.$counter_id);
    }
    public function skip($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')
        ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")->first();
        $update_serving_que = Que::find($serving_que->id);
        $update_serving_que->status = 'skipped';
        $update_serving_que->save();
        $update_que_counter = QueCounter::where('status', 'serving')->update(['status' => 'done']);
        $new_que = Que::where('counter_id', $counter_id)->where('status', 'waiting')->oldest()->first();
        if($new_que){
            $update_waiting_que = Que::find($new_que->id);
            $update_waiting_que->status = 'serving';
            $update_waiting_que->save();

            $que_counter = new QueCounter();
            $que_counter->counter_id = $counter_id;
            $que_counter->que_id = $update_waiting_que->id;
            $que_counter->status = 'serving';
            $que_counter->save();  
        }
        return redirect('/panel/clerk/counter/'.$counter_id);
    }
    public function next($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')
        ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")
        ->first();
        //if($serving_que){}
        $update_serving_que = Que::find($serving_que->id);
        $update_serving_que->status = 'done';
        $update_serving_que->save();
        $update_que_counter = QueCounter::where('status', 'serving')->update(['status' => 'done']);
        $new_que = Que::where('counter_id', $counter_id)->where('status', 'waiting')
        ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")
        ->first();
        if($new_que){
            $update_waiting_que = Que::find($new_que->id);
            $update_waiting_que->status = 'serving';
            $update_waiting_que->save();

            $que_counter = new QueCounter();
            $que_counter->counter_id = $counter_id;
            $que_counter->que_id = $update_waiting_que->id;
            $que_counter->status = 'serving';
            $que_counter->save();  
        }
        return redirect('/panel/clerk/counter/'.$counter_id);

    }
    public function end($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')
        ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")
        ->first();
        if($serving_que){
            $update_serving_que = Que::find($serving_que->id);
            $update_serving_que->status = 'done';
            $update_serving_que->save();
        }
        return redirect('/panel/clerk/counter/'.$counter_id);
    }
    public function check_que(){
        $que = QueCounter::with('que_details')->where('status', 'serving')->oldest()->first();
        return response()->json($que);
    }
    public function view_counter($counter_id){
        $counter = Counter::find($counter_id);
        $serving = Que::where('counter_id', $counter_id)->with('client_detail', 'destination_detail.counter_details')->where('status', 'serving')->first();
        $ques = Que::with('client_detail', 'destination_detail.counter_details')
            ->where('counter_id', $counter_id)
            ->where('status', '!=', 'done')
            ->orderByRaw("
                CASE 
                    WHEN priority = 'pwd' THEN 1
                    WHEN priority = 'senior_citizen' THEN 2
                    WHEN priority = 'regular' THEN 3
                    ELSE 4
                END
            ")
            ->get();
        return view('panel.counters.counter', compact('ques', 'counter', 'serving'));
    }
}
