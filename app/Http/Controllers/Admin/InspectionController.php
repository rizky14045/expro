<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Mail\UpdateLicenseEmail;
use App\Models\InspectionDetail;
use App\Http\Helper\QrCodeHelper;
use Illuminate\Support\Facades\DB;
use App\Mail\UpdateInspectionEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class InspectionController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $query = Inspection::with('user')->select('inspections.*')->latest(); // Mengambil data inspeksi dan relasi user
    
            return datatables()->of($query)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-'; // Nama pengguna atau tanda "-"
                })
                ->addColumn('inspection_file', function ($row) {
                    return '<a href="' . asset('uploads/inspection_file/' . $row->inspection_file) . '" class="btn btn-success btn-sm" download>Download</a>';
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
                    return ' <button type="button" class="btn btn-info btn-sm btn-print-qrcode" onclick="printQRCode(this)">Print</button>
                                        <div class="d-none"><iframe src="about:blank" class="iframe-qrcode"></iframe></div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.inspection.monitoring', $row->id) . '" class="btn btn-info btn-sm">Monitoring</a>
                        <a href="' . route('admin.inspection.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="' . route('admin.inspection.changeStatus', $row->id) . '" class="btn btn-warning btn-sm">Update Status</a>
                        <form action="' . route('admin.inspection.destroy', $row->id) . '" method="POST" class="d-inline delete-form">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(this)">Hapus</button>
                        </form>
                    ';
                })
                ->rawColumns(['inspection_file', 'qrcode','print', 'action']) // Biarkan HTML di kolom tertentu
                ->make(true);
        }
        return view('admin.inspection.index');
    }

    public function create(){
        $data['key'] = Uuid::uuid4();
        $data['users'] = User::all();
        return view('admin.inspection.create',$data);
    }

    public function store(Request $request){

        try {

            DB::beginTransaction();

            $request->validate([
                'number_inspection' => 'required',
                'user_id' => 'required',
                'object_name' => 'required',
                'object_location' => 'required',
                'inspection_date' => 'required',
                'next_test_date' => 'required',
                'status_level' => 'required',
                'status' => 'required',
                'inspection_file' => 'mimes:pdf',
            ],[
                'number_inspection.required' => 'Nomor Form harus diisi!',
                'user_id.required' => 'User harus diisi!',
                'object_name.required' => 'Object yang di uji harus diisi!',
                'object_location.required' => 'Lokasi object yang di uji harus diisi!',
                'inspection_date.required' => 'Tanggal Inspeksi harus diisi!',
                'next_test_date.required' => 'Tanggal Tes berikutnya harus diisi!',
                'status_level.required' => 'Status harus diisi!',
                'status.required' => 'Keterangan Status harus diisi!',
                // 'inspection_file.required' => 'File harus diisi!',
                'inspection_file.mimes' => 'File harus berupa PDF!',
       
            ]);
            $checkInspection = Inspection::where('key',$request->key)->first();
            if($checkInspection){
                Alert::success('Tambah Berhasil', 'Inspeksi berhasil dibuat!');
                return redirect()->route('admin.inspection.index');
            }

            $inspectionFile = '';

            if($request->hasFile('inspection_file'))
            {      
                $file= $request->file('inspection_file');
                $image_name = 'file-inspection-' . time() .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('uploads/inspection_file/'),$image_name);   
                $inspectionFile = $image_name;
            }
            
            $inspection = Inspection::create([
                'uuid' => Uuid::uuid4(),
                'key' => $request->key,
                'number_inspection' => $request->number_inspection,
                'user_id' => $request->user_id,
                'object_name' => $request->object_name,
                'object_location' => $request->object_location,
                'inspection_date' => $request->inspection_date,
                'next_test_date' => $request->next_test_date,
                'status_level' => $request->status_level,
                'status' => $request->status,
                'inspection_file' => $inspectionFile,
                'note' => $request->note ?? null,
            ]);

            InspectionDetail::create([
                'inspection_id' =>$inspection->id,
                'status_level' => $request->status_level,
                'status' => $request->status,
            ]);

            $user = User::where('id',$request->user_id)->first();
            $qrHelper = new QrCodeHelper();
            $qrcode = $qrHelper->generateImage($inspection,$user);

            $inspection->qrcode = $qrcode;
            $inspection->save();
            DB::commit();
            Alert::success('Tambah Berhasil', 'Inspeksi berhasil dibuat!');
            return redirect()->route('admin.inspection.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function edit($id){
        $inspection = Inspection::where('id',$id)->first();
        if (!$inspection) {
            return redirect()->route('admin.inspection.index');
        }
        $data['inspection'] = $inspection;
        $data['users'] = User::all();
        return view('admin.inspection.edit',$data);
    }

    public function update(Request $request,$id){

        try {
            DB::beginTransaction();
            $request->validate([
                'number_inspection' => 'required',
                'user_id' => 'required',
                'object_name' => 'required',
                'object_location' => 'required',
                'inspection_date' => 'required',
                'next_test_date' => 'required',
                'status_level' => 'required',
                'status' => 'required',
                'inspection_file' => 'mimes:pdf',
            ],[
                'number_inspection.required' => 'Nomor Form harus diisi!',
                'user_id.required' => 'User harus diisi!',
                'object_name.required' => 'Object yang di uji harus diisi!',
                'object_location.required' => 'Lokasi object yang di uji harus diisi!',
                'inspection_date.required' => 'Tanggal Inspeksi harus diisi!',
                'next_test_date.required' => 'Tanggal Tes berikutnya harus diisi!',
                'status_level.required' => 'Status harus diisi!',
                'status.required' => 'Keterangan Status harus diisi!',
                // 'inspection_file.required' => 'File harus diisi!',
                'inspection_file.mimes' => 'File harus berupa PDF!',
       
            ]);
            $inspectionFile = '';

            $user = User::where('id',$request->user_id)->first();
            $inspection = Inspection::where('id',$id)->first();

            if($request->hasFile('inspection_file'))
            {      
                $file= $request->file('inspection_file');
                $image_name = 'file-inspection-' . time() .'.'. $file->getClientOriginalExtension();
                if($inspection->inspection_file){
                    unlink(public_path('uploads/inspection_file/'.$inspection->inspection_file));
                }
                $file->move(public_path('uploads/inspection_file/'),$image_name);   
                $inspectionFile = $image_name;
            }

            $inspection->number_inspection = $request->number_inspection;
            $inspection->user_id = $request->user_id;
            $inspection->object_name = $request->object_name;
            $inspection->object_location = $request->object_location;
            $inspection->inspection_date = $request->inspection_date;
            $inspection->next_test_date = $request->next_test_date;
            $inspection->status_level = $request->status_level;
            $inspection->status = $request->status;
            $inspection->inspection_file = $request->has('inspection_file') ? $inspectionFile : $inspection->inspection_file;
            $inspection->note = $request->note;


            $qrHelper = new QrCodeHelper();
            $qrcode = $qrHelper->generateImage($inspection,$user);
            unlink(public_path('qrcode/'.$inspection->qrcode));

            $inspection->qrcode = $qrcode;

            $inspection->save();

            DB::commit();
            Alert::success('Tambah Berhasil', 'Inspeksi berhasil diubah!');
            return redirect()->route('admin.inspection.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $inspection = Inspection::where('id', $id)->first();
            if (!$inspection) {
                return redirect()->route('admin.inspection.index');
            }
            InspectionDetail::where('inspection_id', $inspection->id)->delete();

            unlink(public_path('uploads/inspection_file/'.$inspection->inspection_file));
            unlink(public_path('qrcode/'.$inspection->qrcode));
            $inspection->delete();

            DB::commit();
            Alert::success('Hapus Berhasil', 'Inspeksi berhasil dihapus!');
            return redirect()->route('admin.inspection.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function statusUpdate($id){
        $inspection = Inspection::where('id',$id)->first();
        if (!$inspection) {
            return redirect()->route('admin.inspection.index');
        }
        $data['inspection'] = $inspection;
        $data['users'] = User::all();
        return view('admin.inspection.status-update',$data);
    }

    public function changeStatus(Request $request,$id){

        try {
            DB::beginTransaction();
            $request->validate([
                'status_level' => 'required',
                'status' => 'required',
            ],[
                'status_level.required' => 'Status harus diisi!',
                'status.required' => 'Keterangan Status harus diisi!',
       
            ]);

            $inspection = Inspection::where('id',$id)->first();

            $inspection->status_level = $request->status_level;
            $inspection->status = $request->status;

            $user = User::where('id',$inspection->user_id)->first();

            Mail::to($user->email)->send(new UpdateInspectionEmail($inspection,$user));

            $inspection->save();

            InspectionDetail::create([
                'inspection_id' =>$inspection->id,
                'status_level' => $request->status_level,
                'status' => $request->status,
            ]);

            DB::commit();
            Alert::success('Tambah Berhasil', 'Status inspeksi berhasil diubah!');
            return redirect()->route('admin.inspection.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function monitoring($id){
        $inspection = Inspection::where('id',$id)->first();
        if (!$inspection) {
            return redirect()->route('admin.inspection.index');
        }
        $data['inspection'] = $inspection;
        $data['users'] = User::all();
        $data['details'] = InspectionDetail::where('inspection_id',$id)->get();
        return view('admin.inspection.monitoring',$data);
    }
}
