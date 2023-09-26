<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Que;
use App\Models\Counter;
use App\Models\QueCounter;
use Response;
use Validator;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $latest_que = QueCounter::with('que_details')->where('status', 'serving')->oldest()->first();
        $counters = Counter::with('serving_que')->where('status', 'active')->get();
        //dd($counters);
        return view('index', compact('counters', 'latest_que'));
    }
    public function unknown_user(){
        return view('errors.unknown_user');
    }
    public function thank_you($que_id){
        $que = Que::with('client_detail', 'destination_detail.counter_details')->find($que_id);

        return view('thank-you', compact('que'));
    }

    public function register(Request $req){
        $validator = Validator::make($req->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'address' => 'required',
            'mobile_number' => 'required',
            'type' => 'required',
            'destination' => 'required',
        ]);
        if ($validator->fails()) {    
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
            //return response()->json(['errors' => $validator->messages(), 'status' => 422], 200);
        }
        else {
            
            $data = new Client();
            $data->first_name = strtoupper($req->first_name);
            $data->last_name = strtoupper($req->last_name);
            $data->middle_name = strtoupper($req->middle_name);
            $data->address = strtoupper($req->address);
            $data->mobile_num = $req->mobile_number;
            $data->status = 'active';
            $data->priority = $req->type;
            $data->save();

            $today = date('m-d-Y');
            $destination = Destination::find($req->destination);
            $que_count = Que::where('destination_id', $req->destination)->where('que_date', $today)->count();
            $priority_number = $first_letter = strtoupper(substr($destination->destination_name, 0, 1)).'-'.str_pad($que_count + 1, 3, '0', STR_PAD_LEFT).'-'.strtoupper(substr($req->type, 0, 1));

            $que = new Que();
            $que->destination_id = $req->destination;
            $que->customer_id = $data->id;
            $que->counter_id = $destination->counter_id;
            $que->priority_number = $priority_number;
            $que->priority = $req->type;
            $que->que_date = $today;
            $que->status = 'waiting';
            $que->save();
            return redirect('/thankyou/'.$que->id);
        }

    }
    public function view_counter($counter_id){
        $counter = Counter::find($counter_id);
        $serving = Que::where('counter_id', $counter_id)->with('client_detail', 'destination_detail.counter_details')->where('status', 'serving')->first();
        $ques = Que::with('client_detail', 'destination_detail.counter_details')->where('counter_id', $counter_id)->get();
        return view('panel.counters.counter', compact('ques', 'counter', 'serving'));
    }
}

