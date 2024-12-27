<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\License;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $userId = Auth::guard('web')->user()->id;

        $data['inspection'] = Inspection::where('user_id',$userId)->count();
        $data['license'] = License::where('user_id',$userId)->count();
        $data['inspection_accept'] = Inspection::where('user_id',$userId)->where('status_level',1)->count();
        $data['inspection_process'] = Inspection::where('user_id',$userId)->where('status_level',2)->count();
        $data['inspection_revision'] = Inspection::where('user_id',$userId)->where('status_level',3)->count();
        $data['inspection_reject'] = Inspection::where('user_id',$userId)->where('status_level',4)->count();
        $data['license_accept'] = License::where('user_id',$userId)->where('status_level',1)->count();
        $data['license_process'] = License::where('user_id',$userId)->where('status_level',2)->count();
        $data['license_revision'] = License::where('user_id',$userId)->where('status_level',3)->count();
        $data['license_reject'] = License::where('user_id',$userId)->where('status_level',4)->count();
        return view('user.dashboard',$data);
    }
}
