<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\License;
use App\Mail\RenewEmail;
use App\Models\RenewLicense;
use Illuminate\Http\Request;
use App\Models\LicenseDetail;
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
                ->addColumn('status', function ($row) {
                    switch ($row->status_level) {
                        case 1: return 'Diproses';
                        case 2: return 'Disetujui';
                        case 3: return 'Revisi';
                        case 4: return 'Ditolak';
                    }
                })
                ->addColumn('license_file', function ($row) {
                    return '<a href="' . asset('uploads/license_file/' . $row->license_file) . '" class="btn btn-success btn-sm" download>Download</a>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('user.license.monitoring', $row->id) . '" class="btn btn-info btn-sm">Monitoring</a>
                    ';
                })
                ->rawColumns(['license_file','action']) // Biarkan kolom HTML
                ->make(true);
        }
        return view('user.license.index');
    }

    public function monitoring($id){
        $userId = Auth::guard('web')->user()->id;
        $license = License::where('id', $id)->where('user_id',$userId)->first();
        if(!$license){
            return redirect()->route('user.license.index');
        }
        $data['users'] = User::all();
        $data['key'] = Uuid::uuid4();
        $data['license'] = $license;
        $data['details'] = LicenseDetail::where('license_id', $id)->get();
        return view('user.license.monitoring',$data);
    }
}
