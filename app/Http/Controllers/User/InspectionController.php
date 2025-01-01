<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Models\InspectionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InspectionController extends Controller
{
    public function index(Request $request){

        $userId = Auth::guard('web')->user()->id;

        if ($request->ajax()) {
            $query = Inspection::select('inspections.*')->where('user_id', $userId)->latest(); // Mengambil data inspeksi dan relasi user
    
            return datatables()->of($query)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-'; // Nama pengguna atau tanda "-"
                })
                ->addColumn('inspection_file', function ($row) {
                    if ($row->inspection_file) {
                        return '<a href="' . asset('uploads/inspection_file/' . $row->inspection_file) . '" class="btn btn-success btn-sm" download>Download</a>';
                    }else{
                        return '';
                    }
                })
                ->addColumn('status', function ($row) {
                    switch ($row->status_level) {
                        case 1: return 'Diproses';
                        case 2: return 'Disetujui';
                        case 3: return 'Revisi';
                        case 4: return 'Ditolak';
                    }
                })
                ->addColumn('qrcode', function ($row) {
                    return '<a href="' . asset('qrcode/' . $row->qrcode) . '">
                                <img src="' . asset('qrcode/' . $row->qrcode) . '" alt="" width="150" class="qrcode">
                            </a>';
                })
                ->addColumn('print', function ($row) {
                    return ' <button type="button" class="btn btn-info btn-sm btn-print-qrcode-user" onclick="printQRCode(this)">Print</button>
                                        <div class="d-none"><iframe src="about:blank" class="iframe-qrcode"></iframe></div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('user.inspection.monitoring', $row->id) . '" class="btn btn-info btn-sm">Monitoring</a>
                    ';
                })
                ->rawColumns(['inspection_file', 'qrcode','print','action']) // Biarkan HTML di kolom tertentu
                ->make(true);
        }
        return view('user.inspection.index');
    }

    public function monitoring($id){

        $userId = Auth::guard('web')->user()->id;
        $inspection = Inspection::where('id',$id)->where('user_id',$userId)->first();
        if (!$inspection) {
            return redirect()->route('user.inspection.index');
        }
        $data['inspection'] = $inspection;
        $data['users'] = User::all();
        $data['details'] = InspectionDetail::where('inspection_id',$id)->get();
        return view('user.inspection.monitoring',$data);

    }
}
