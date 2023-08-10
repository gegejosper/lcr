<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Counter;
use Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\GlobalController;

class DestinationController extends Controller
{
    //
    public function show_destinations(){
        $destinations = Destination::with('counter_details')->get();
        $counters = Counter::where('status', 'active')->get();
        $page_name="Destination";
        return view('panel.destinations.destinations', compact('page_name', 'destinations', 'counters'));
    }

    public function add_destination(Request $req){
        $validator = Validator::make($req->all(), [
            'destination_name' => 'required'
        ]);
        if ($validator->fails()) {    
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
            //return response()->json(['errors' => $validator->messages(), 'status' => 422], 200);
        }
        else {
            $data = new Destination();
            $data->destination_name = strtoupper($req->destination_name);
            $data->counter_id = $req->counter_id;
            $data->status = 'active';
            $data->save();
            $counter = Counter::find($req->counter_id);
            $data->counter_name = $counter->counter_name;
            return response()->json($data);
        }

    }

    public function edit_destination(Request $request){
        $data = Destination::find($request->destination_id);
        $data->destination_name = strtoupper($request->destination_name);
        $data->counter_id = $request->counter_id;
        $data->save();
        if (Auth::check()){
            $name = Auth::user()->name;
        }
        Log::info($name.' modified '.$data->destination_name.' into '.$request->destination_status);
        $counter = Counter::find($request->counter_id);
        $data->counter_name = $counter->counter_name;
        return response()->json($data);
    }

    public function modify_destination(Request $req){
        $data = Destination::find($req->destination_id);
        $data->status = $req->destination_status;
        $data->save();
        if (Auth::check()){
            $name = Auth::user()->name;
        }
        Log::info($name.' modified '.$data->destination_name.' into '.$req->destination_status);
        return response()->json($data);
    }
    public function view_destination($destination_id){
        $destination_detail = Destination::find($destination_id);
        $page_name=$destination_detail->destination_name." Destination";
       
        return view('panel.destinations.destination', compact('page_name', 'destination_detail'));
    }
}
