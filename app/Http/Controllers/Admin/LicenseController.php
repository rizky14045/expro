<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenseController extends Controller
{
    public function index(){
        return view('admin.license.index');
    }

    public function create(){
        return view('admin.license.create');
    }

    public function edit(){
        return view('admin.license.edit');
    }
}
