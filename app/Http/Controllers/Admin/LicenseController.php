<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\License;
use App\Mail\RenewEmail;
use App\Models\RenewLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class LicenseController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $query = License::with('user')->select('licenses.*');
        
            return datatables()->of($query)
                ->addIndexColumn() // Tambahkan nomor urut
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-';
                })
                ->addColumn('expired_day', function ($row) {
                    // Hitung selisih hari antara expired_date dan hari ini
                    $tanggal = Carbon::parse($row->expired_date);
                    $tanggalSekarang = Carbon::now();
                    return $tanggalSekarang->diffInDays($tanggal);
                })
                ->addColumn('license_file', function ($row) {
                    return '<a href="' . asset('uploads/license_file/' . $row->license_file) . '" class="btn btn-success btn-sm" download>Download</a>';
                })
                ->addColumn('action', function ($row) {
                    $buttons = '
                        <a href="' . route('admin.license.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="' . route('admin.license.renew', $row->id) . '" class="btn btn-warning btn-sm">Perpanjang</a>';
                    
                    // Tambahkan tombol email jika expired_day <= 31
                    $tanggal = Carbon::parse($row->expired_date);
                    $tanggalSekarang = Carbon::now();

                    $selisihHari = $tanggalSekarang->greaterThan($tanggal) ? -$tanggalSekarang->diffInDays($tanggal) :  $tanggalSekarang->diffInDays($tanggal);
        
                    if ($selisihHari <= 31) {
                        $buttons .= '
                            <form action="' . route('admin.license.email', $row->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-secondary btn-sm">Kirim Email</button>
                            </form>';
                    }
        
                    $buttons .= '
                        <form action="' . route('admin.license.destroy', $row->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>';
        
                    return $buttons;
                })
                ->rawColumns(['license_file', 'action']) // Biarkan kolom HTML
                ->make(true);
        }
        return view('admin.license.index');
    }

    public function create(){
        $data['users'] = User::all();
        $data['key'] = Uuid::uuid4();
        return view('admin.license.create',$data);
    }
    public function store(Request $request){

        try {

            DB::beginTransaction();
            $request->validate([
                'number_license' => 'required',
                'user_id' => 'required',
                'license_name' => 'required',
                'expired_date' => 'required',
                'license_file' => 'mimes:pdf',
            ],[
                'number_license.required' => 'Nomor lisensi harus diisi!',
                'user_id.required' => 'User harus diisi!',
                'license_name.required' => 'Nama lisensi harus diisi!',
                'expired_date.required' => 'Tanggal expired harus diisi!',
                // 'license_file.required' => 'File harus diisi!',
                'license_file.mimes' => 'File harus berupa PDF!',
       
            ]);

            $checkLicense = License::where('key',$request->key)->first();
            if($checkLicense){
                Alert::success('Tambah Berhasil', 'Lisensi berhasil dibuat!');
                return redirect()->route('admin.license.index');
            }

            $licenseFile = '';

            if($request->hasFile('license_file'))
            {      
                $file= $request->file('license_file');
                $image_name = 'file-license-' . time() .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('uploads/license_file/'),$image_name);   
                $licenseFile = $image_name;
            }
            
            License::create([
                'uuid' => Uuid::uuid4(),
                'key' => $request->key,
                'number_license' => $request->number_license,
                'user_id' => $request->user_id,
                'license_name' => $request->license_name,
                'expired_date' => $request->expired_date,
                'license_file' => $licenseFile,
                'note' => $request->note ?? null,
            ]);

            DB::commit();
            Alert::success('Tambah Berhasil', 'License berhasil dibuat!');
            return redirect()->route('admin.license.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function edit($id){
        $data['users'] = User::all();
        $data['key'] = Uuid::uuid4();
        $data['license'] = License::where('id', $id)->first();
        return view('admin.license.edit',$data);
    }

    public function update(Request $request,$id){

        try {
            DB::beginTransaction();
            $request->validate([
                'number_license' => 'required',
                'user_id' => 'required',
                'license_name' => 'required',
                'expired_date' => 'required',
                'license_file' => 'mimes:pdf',
            ],[
                'number_license.required' => 'Nomor lisensi harus diisi!',
                'user_id.required' => 'User harus diisi!',
                'license_name.required' => 'Nama lisensi harus diisi!',
                'expired_date.required' => 'Tanggal expired harus diisi!',
                // 'license_file.required' => 'File harus diisi!',
                'license_file.mimes' => 'File harus berupa PDF!',
       
            ]);

            $licenseFile = '';

            $license = License::where('id',$id)->first();

            if($request->hasFile('license_file'))
            {      
                $file= $request->file('license_file');
                $image_name = 'file-license-' . time() .'.'. $file->getClientOriginalExtension();
                if($license->license_file){
                    unlink(public_path('uploads/license_file/'.$license->license_file));
                }
                $file->move(public_path('uploads/license_file/'),$image_name);   
                $licenseFile = $image_name;
            }

            $license->number_license = $request->number_license;
            $license->user_id = $request->user_id;
            $license->license_name = $request->license_name;
            $license->expired_date = $request->expired_date;
            $license->license_file = $request->has('license_file') ? $licenseFile : $license->license_file;
            $license->note = $request->note;
            $license->save();

            DB::commit();
            Alert::success('Update Berhasil', 'Lisensi berhasil diubah!');
            return redirect()->route('admin.license.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $license = License::where('id', $id)->first();
            if (!$license) {
                return redirect()->route('admin.license.index');
            }

            unlink(public_path('uploads/license_file/'.$license->license_file));
            $license->delete();

            DB::commit();
            Alert::success('Hapus Berhasil', 'Lisensi berhasil dihapus!');
            return redirect()->route('admin.license.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function renew($id){

        $data['users'] = User::all();
        $data['key'] = Uuid::uuid4();
        $data['license'] = License::where('id', $id)->first();
        
        return view('admin.license.renew',$data);
    }

    public function renewUpdate(Request $request,$id){

        try {
            DB::beginTransaction();

            $license = License::where('id',$id)->first();
            $license->expired_date = $request->new_date;
            $license->save();

            RenewLicense::create([
                'license_id' => $license->id,
                'user_id' => $license->user_id,
                'expired_date' => $request->new_date
            ]);
            DB::commit();
            Alert::success('Update Berhasil', 'Lisensi berhasil diperpanjang!');
            return redirect()->route('admin.license.index');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function email($id){

        $license = License::where('id', $id)->first();
        if (!$license) {
            return redirect()->route('admin.license.index');
        }
        $user = User::where('id',$license->user_id)->first();
        if (!$user) {
            return redirect()->route('admin.license.index');
        }
        Mail::to($user->email)->send(new RenewEmail($license,$user));

        Alert::success('Berhasil Terkirim', 'Pemberitahuan berhasil terkirim!');
        return redirect()->route('admin.license.index');
     
    }

}
