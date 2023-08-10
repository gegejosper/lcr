<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Response;
use Validator;
use App\Models\Product;
use App\Models\Client;
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

        public function add_client(Request $req){
            $user_id = GlobalController::get_user_id();
            $get_branch = Branchuser::where('user_id', $user_id)->first();
            $branch_id = $get_branch->branch_id; 
            $branch = Branch::find($branch_id);
            $validator = Validator::make($req->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'mobile_num' => 'required',
                'barangay' => 'required',
                'province' => 'required',
                'city_municipality' => 'required'
            ]);
            if ($validator->fails()) {    
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
                //return response()->json(['errors' => $validator->messages(), 'status' => 422], 200);
            }
            else {
                $year = date('y');
                $province = Province::where('provCode',$req->province)->first();
                $citymunicipality = Citymunicipality::where('citymunCode',$req->city_municipality)->first();
                $barangay = Barangay::where('brgyCode',$req->barangay)->first();
                $client_count = Client::where('branch_id', $branch_id)->whereYear('created_at', date('Y'))->count();
                $padded_count_Number = str_pad($client_count + 1, 4, '0', STR_PAD_LEFT);
                $data = new Client();
                $data->branch_id = $req->branch;
                $data->first_name = strtoupper($req->first_name);
                $data->last_name = strtoupper($req->last_name);
                $data->address = strtoupper($req->address);
                $data->brgy = $barangay->brgyDesc;
                $data->province = $province->provDesc;
                $data->city_num = $citymunicipality->citymunDesc;
                $data->email = $req->email;
                $data->facebook = $req->facebook;
                $data->mobile_num = $req->mobile_num;
                $data->status = 'active';
                $data->account_number = $branch->branch_code.'-'.$year.'-'.$padded_count_Number.'-'.date('m');;
                $data->save();
                return response()->json($data);
            }
    
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
