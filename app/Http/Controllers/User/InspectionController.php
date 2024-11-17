<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index(){
        return view('user.inspection.index');
    }

    public function create(){
        return view('user.inspection.create');
    }

    public function edit(){
        return view('user.inspection.edit');
    }
}
