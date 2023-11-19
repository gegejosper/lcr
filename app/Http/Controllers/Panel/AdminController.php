<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Application;
use App\Models\Destination;
use App\Models\Counter;
use App\Models\User;
use App\Models\Que;
use App\Models\Role;
use App\Models\Plan;
use App\Models\Package;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $page_name = 'Dashboard';
        $counters = Counter::with('waiting_que')->where('status', 'active')->get();
        return view('panel.admin.dashboard',compact('page_name', 'counters'));
    }
    
    
    public function settings(){
        $page_name = 'Settings';
        $settings = Setting::first();
        //dd($settings);
        return view('panel.admin.settings',compact('page_name', 'settings'));
    }
    public function roles(){
        $page_name = 'Roles';
        $roles = Role::get();
        return view('panel.admin.roles',compact('page_name', 'roles'));
    }
    public function subscribers(){
        $page_name = 'Subscribers';
        
        return view('panel.admin.subscribers',compact('page_name'));
    }
    public function users(){
        $page_name = 'Users';
        $users = User::with('roles')->paginate(10);
        $roles = Role::where('name', '!=', 'member')->get();
//dd($users);
        return view('panel.admin.users',compact('page_name', 'users', 'roles'));
    }
    public function backup(){
        $page_name = 'Backup';
        return view('panel.admin.backup',compact('page_name'));
    }
    public function reports(){
        $page_name = 'Reports';
        $destinations = Destination::get();
        $ques = Que::with('client_detail', 'destination_detail.counter_details')
            ->get();
        return view('panel.admin.reports',compact('page_name', 'ques', 'destinations'));
    }
    public function reports_range(Request $req){
        $from_date = null;
        $to_date = null;
        $destinations = Destination::get();
        if (isset($req->from_date) && isset($req->to_date)) {
            $from_date = Carbon::parse($req->from_date . ' 00:00:00');
            $to_date = Carbon::parse($req->to_date . ' 23:59:59');
        }

        $page_name = 'Reports';
        $status = $req->status == 'all' ? null : $req->status;
        $purpose = $req->purpose == 'all' ? null : $req->purpose;
        $priority = $req->priority == 'all' ? null : $req->priority;
        $ques = Que::with('client_detail', 'destination_detail.counter_details')
            ->when($priority != null, function ($query) use ($priority) {
                return $query->where('priority', $priority);
            })
            ->when($status != null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($purpose != null, function ($query) use ($purpose) {
                return $query->where('destination_id', $purpose);
            })
            ->when($from_date && $to_date, function ($query) use ($from_date, $to_date) {
                return $query->whereBetween('created_at', [$from_date->toDateTimeString(), $to_date->toDateTimeString()]);
            })
            ->get();

        return view('panel.admin.reports', compact('page_name', 'ques', 'destinations'));
    }
}
