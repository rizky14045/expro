<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\License;
use App\Mail\RenewEmail;
use App\Models\RenewLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class LicenseController extends Controller
{
    public function index(Request $request){
        
        $userId = Auth::guard('web')->user()->id;
        if ($request->ajax()) {
            $query = License::with('user')->select('licenses.*')->where('user_id', $userId)->latest();
        
            return datatables()->of($query)
                ->addIndexColumn() // Tambahkan nomor urut
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-';
                })
                ->addColumn('license_file', function ($row) {
                    return '<a href="' . asset('uploads/license_file/' . $row->license_file) . '" class="btn btn-success btn-sm" download>Download</a>';
                })
                ->rawColumns(['license_file']) // Biarkan kolom HTML
                ->make(true);
        }
        return view('user.license.index');
    }
}
