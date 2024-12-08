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
use Illuminate\Support\Facades\Mail;

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

    public function tester(){

        $tanggalSekarang = Carbon::now();
        $tanggalMendekati = $tanggalSekarang->copy()->addDays(31);
        $tanggalTerlewat = $tanggalSekarang->copy()->subDays(365);
        
        $licenses = License::where(function ($query) use ($tanggalSekarang, $tanggalMendekati, $tanggalTerlewat) {
            $query->whereBetween('expired_date', [$tanggalSekarang, $tanggalMendekati])
                  ->orWhereBetween('expired_date', [$tanggalTerlewat, $tanggalSekarang]);
        })->get();

        foreach ($licenses as $license) {
            $user = User::where('id', $license->user_id)->first();
            if(!$user){
                continue;
            }
            Mail::to($user->email)->queue(new RenewEmail($license,$user));
        }

        return 'ok';
    }
}
