<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class GlobalController extends Controller
{
    //
    public static function get_user_name(){
        if (Auth::check())
        {
            $name = Auth::user()->name;
        }
        return $name;
    }
    public static function get_user_id(){
        if (Auth::check())
        {
            $id = Auth::user()->id;
        }
        return $id;
    }
    public function search_town(Request $request){
        if($request->ajax())
        {   
            //dd($request->province);
            $search = $request->search;
            
            $output="";
            $municipalities = DB::table('citymunicipalities')
                ->where('provCode', '=',$search)
                ->get();
                //dd($municipalities);
            if($municipalities)
            {
                foreach ($municipalities as $municipality) {
                    $output.='<option value="'.$municipality->citymunCode.'">'.$municipality->citymunDesc.'</option>';
                }
                return response($output);
            }
        }
    }
    public function search_barangay(Request $request){
        if($request->ajax())
        {   
            //dd($request->province);
            $search = $request->search;
            
            $output="";
            $barangays = DB::table('barangays')
                ->where('citymunCode', '=',$search)
                ->get();
                //dd($municipalities);
            if($barangays)
            {
                foreach ($barangays as $barangay) {
                    $output.='<option value="'.$barangay->brgyCode.'">'.$barangay->brgyDesc.'</option>';
                }
                return response($output);
            }
        }
    }
    public static function random_characters($length_letters){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomCharacters = '';
        for ($i = 0; $i < $length_letters; $i++) {
            $randomCharacters .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomCharacters;
    }
}
