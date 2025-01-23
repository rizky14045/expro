<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Admin::query();

            return datatables()->of($query)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.admin.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('admin.admin.destroy', $row->id) . '" method="POST" class="d-inline delete-form">
                            ' . csrf_field() . '
                            ' . method_field('delete') . '
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(this)">Hapus</button>
                        </form>';
                })
                ->rawColumns(['action']) // Biarkan kolom 'action' memproses HTML
                ->make(true);
        }
        return view('admin.admin.index');
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email|email:rfc,dns',
                'password' => 'required',
            ],[
                'name.required' => 'Nama harus diisi!',
                'email.required' => 'Email harus diisi!',
                'email.unique' => 'Email sudah dipakai sebelumnya!',
                'email.email' => 'Format Email harus benar',
                'password.required' => 'Password harus diisi!',
       
            ]);

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => null,
            ]);
            
            DB::commit();
            Alert::success('Tambah Berhasil', 'Admin berhasil dibuat!');
            return redirect()->route('admin.admin.index');
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
        $admin = Admin::where('id', $id)->first();
        if(!$admin){
            Alert::error('Data Tidak Ada','Data tidak ada!!');
            return redirect()->route('admin.admin.index');
        }
        $data['admin'] = $admin;
        return view('admin.admin.edit',$data);
    }

    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            
            $admin = Admin::where('id', $id)->first();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password ?  bcrypt($request->password) : $admin->password;
            $admin->save();

            DB::commit();
            Alert::success('Ubah Berhasil', 'Admin berhasil diubah!');
            return redirect()->route('admin.admin.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $admin = Admin::where('id', $id)->first();
            $admin->delete();

            DB::commit();
            Alert::success('Hapus Berhasil', 'Admin berhasil dihapus!');
            return redirect()->route('admin.admin.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
