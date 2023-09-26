<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Que;
use App\Models\QueCounter;

class QueController extends Controller
{
    //
    public function ques(){
        $ques = Que::with('client_detail', 'destination_detail.counter_details')->latest()->paginate(100);
        return view('panel.admin.ques', compact('ques'));
    }
    public function serve($counter_id){
        $que = Que::where('counter_id', $counter_id)->where('status', 'waiting')->oldest()->first();

        $update_que = Que::find($que->id);
        $update_que->status = 'serving';
        $update_que->save();
        $update_que_counter = QueCounter::where('status', 'serving')->update(['status' => 'done']);
        $que_counter = new QueCounter();
        $que_counter->counter_id = $counter_id;
        $que_counter->que_id = $update_que->id;
        $que_counter->status = 'serving';
        $que_counter->save();  
        return redirect('/counter/'.$counter_id);
    }
    public function skip($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')->oldest()->first();
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
        return redirect('/counter/'.$counter_id);
    }
    public function next($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')->oldest()->first();
        //if($serving_que){}
        $update_serving_que = Que::find($serving_que->id);
        $update_serving_que->status = 'done';
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
        return redirect('/counter/'.$counter_id);

    }
    public function end($counter_id){
        $serving_que = Que::where('counter_id', $counter_id)->where('status', 'serving')->oldest()->first();
        if($serving_que){
            $update_serving_que = Que::find($serving_que->id);
            $update_serving_que->status = 'done';
            $update_serving_que->save();
        }
        return redirect('/counter/'.$counter_id);
    }
    public function check_que(){
        $que = QueCounter::with('que_details')->where('status', 'serving')->oldest()->first();
        return response()->json($que);
    }
}
