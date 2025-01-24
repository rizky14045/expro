<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query();

            return datatables()->of($query)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.user.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('admin.user.destroy', $row->id) . '" method="POST" class="d-inline delete-form">
                            ' . csrf_field() . '
                            ' . method_field('delete') . '
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(this)">Hapus</button>
                        </form>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_actived == true) {
                        return 'Aktif';
                    }else{
                        return 'Tidak Aktif';
                    }
                    
                })
                ->rawColumns(['action','status']) // Biarkan kolom 'action' memproses HTML
                ->make(true);
        }

        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required',
                'name' => 'required',
                'address' => 'required',
                'email' => 'required|unique:users,email|email:rfc,dns',
                'phone_number' => 'required',
            ],[
                'number.required' => 'NPWP harus diisi!',
                'name.required' => 'Nama  harus diisi!',
                'address.required' => 'Alamat harus diisi!',
                'email.required' => 'Email harus diisi!',
                'email.unique' => 'Email sudah dipakai sebelumnya!',
                'email.email' => 'Format Email harus benar',
                'phone_number.required' => 'Nomor Handphone harus diisi!',
       
            ]);
            DB::beginTransaction();
            
            $user = User::create([
                'number' => $request->number,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => bcrypt($request->email),
            ]);
            DB::commit();
            Alert::success('Tambah Berhasil', 'User berhasil dibuat!');
            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if(!$user){
            Alert::error('Data Tidak Ada','Data tidak ada!!');
            return redirect()->route('admin.user.index');
        }
        $data['user'] = $user;
        return view('admin.user.edit',$data);
    }

    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            
            $user = User::where('id', $id)->first();
            $user->number = $request->number;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->is_actived = $request->is_actived;
            $user->password = $request->password ?  bcrypt($request->password) : $user->password;
            $user->save();

            DB::commit();
            Alert::success('Ubah Berhasil', 'user berhasil diubah!');
            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $user = User::where('id', $id)->first();
            $user->delete();

            DB::commit();
            Alert::success('Hapus Berhasil', 'User berhasil dihapus!');
            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
