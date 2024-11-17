<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenseController extends Controller
{
    public function index(){
        return view('user.license.index');
    }

    public function create(){
        return view('user.license.create');
    }

    public function edit(){
        return view('user.license.edit');
    }
}
