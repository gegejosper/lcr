<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\GlobalController;

class CounterController extends Controller
{
    //
    public function show_counters(){
        $counters = Counter::get();
        $page_name="Counter";
        return view('panel.counters.counters', compact('page_name', 'counters'));
    }

    public function add_counter(Request $req){
        $validator = Validator::make($req->all(), [
            'counter_name' => 'required'
        ]);
        if ($validator->fails()) {    
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
            //return response()->json(['errors' => $validator->messages(), 'status' => 422], 200);
        }
        else {
            $data = new Counter();
            $data->counter_name = strtoupper($req->counter_name);
            $data->status = 'active';
            $data->save();
            return response()->json($data);
        }

    }

    public function edit_counter(Request $request){
        $data = Counter::find($request->counter_id);
        $data->counter_name = strtoupper($request->counter_name);
        $data->save();
        if (Auth::check()){
            $name = Auth::user()->name;
        }
        Log::info($name.' modified '.$data->counter_name.' into '.$request->counter_status);
        return response()->json($data);
    }

    public function modify_counter(Request $req){
        $data = Counter::find($req->counter_id);
        $data->status = $req->counter_status;
        $data->save();
        if (Auth::check()){
            $name = Auth::user()->name;
        }
        Log::info($name.' modified '.$data->counter_name.' into '.$req->counter_status);
        return response()->json($data);
    }
    public function view_counter($counter_id){
        $counter_detail = Counter::find($counter_id);
        $page_name=$counter_detail->counter_name." Counter";
       
        return view('panel.counters.counter', compact('page_name', 'counter_detail'));
    }
}
