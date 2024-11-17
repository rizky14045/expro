<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
{
    public function index(){
        return view('admin.training.index');
    }

    public function create(){
        return view('admin.training.create');
    }

    public function edit(){
        return view('admin.training.edit');
    }
}
