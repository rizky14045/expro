<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\License;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $data['user'] = User::count();
        $data['inspection'] = Inspection::count();
        $data['license'] = License::count();
        $data['inspection_accept'] = Inspection::where('status_level',1)->count();
        $data['inspection_process'] = Inspection::where('status_level',2)->count();
        $data['inspection_revision'] = Inspection::where('status_level',3)->count();
        $data['inspection_reject'] = Inspection::where('status_level',4)->count();
        return view('admin.dashboard',$data);
    }
}
