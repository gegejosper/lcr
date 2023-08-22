<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Response;
use Validator;
use App\Models\Client;
use App\Models\Que;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\GlobalController;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    //
        //
        public function show_clients(){
            $clients = Client::paginate(50);
            $page_name="Clients";
            return view('panel.clients.clients', compact('page_name', 'clients'));
        }

        
    
        public function edit_client(Request $req){
            //dd($req);
            $province = Province::where('provCode',$req->province)->first();
            $citymunicipality = Citymunicipality::where('citymunCode',$req->city_municipality)->first();
            $barangay = Barangay::where('brgyCode',$req->barangay)->first();
            $client = Client::find($req->client_id);
            $client->first_name = strtoupper($req->first_name);
            $client->last_name = strtoupper($req->last_name);
            $client->address = strtoupper($req->address);
            $client->brgy = $barangay->brgyDesc;
            $client->province = $province->provDesc;
            $client->city_num = $citymunicipality->citymunDesc;
            $client->facebook = $req->facebook;
            $client->mobile_num = $req->mobile_num;
            $client->save();
            if (Auth::check())
            {
                $name = Auth::user()->name;
            }
            Log::info($name.' modified '.$client->last_name.', '.$client->first_name);
            return response()->json($client);
        }
    
        public function view_client($client_id){
            $client = Client::find($client_id);
            $page_name="Client";
            return view('panel.clients.client', compact('page_name', 'client'));
        }
        public function search_clients(Request $req){
            
            $searchTerm = '%'.$req->search_query.'%';
            $clients_result = Client::where(function($query) use ($searchTerm){
                    $query->where('first_name','LIKE', $searchTerm)
                    ->orWhere('last_name','LIKE', $searchTerm);
                })
                ->take(20)->get();
            return response()->json($clients_result);
        }

}
