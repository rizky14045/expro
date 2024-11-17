<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index(){
        return view('admin.inspection.index');
    }

    public function create(){
        return view('admin.inspection.create');
    }

    public function edit(){
        return view('admin.inspection.edit');
    }
}
