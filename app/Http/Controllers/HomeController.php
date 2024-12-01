<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function scanner($uuid){
        if(Auth::guard('admin')->check() || Auth::guard('web')->check()){
            $inspection = Inspection::where('uuid', $uuid)->first();
            if (!$inspection){
                abort(404);
            }
            $data['inspection'] = $inspection;
            return view('scanner',$data);
        }else{
            abort(403);
        }
    }
}
