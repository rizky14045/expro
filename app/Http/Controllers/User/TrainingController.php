<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
{
    public function index(){
        return view('user.training.index');
    }

    public function create(){
        return view('user.training.create');
    }

    public function edit(){
        return view('user.training.edit');
    }
}
