<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\License;
use App\Mail\RenewEmail;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function resultScanner($uuid){
        $inspection = Inspection::where('uuid', $uuid)->first();
        if (!$inspection){
            abort(404);
        }
        $data['inspection'] = $inspection;
        return view('scanner',$data);
    }

    public function scanner($uuid){

        $data['uuid'] = $uuid;
        if (Auth::guard('admin')->check()) {
            return redirect()->route('resultScanner',['uuid' => $uuid]);
        }else{
            return view('input',$data);

        }
    }

    public function inputScanner(Request $request,$uuid){
        $inspection = Inspection::where('uuid',$uuid)->first();
        if (!$inspection){
            abort(404);
        }

        $user = User::where('id',$inspection->user_id)->first();
        if( Hash::check($request->password,$user->password) ){

            Alert::success('Berhasil', 'Password benar!');
            return redirect()->route('resultScanner',['uuid' => $uuid]);
        } else {
            Alert::error('Gagal', 'Password Salah!');
            return redirect()->back();
        }

    }

}
