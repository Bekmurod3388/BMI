<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MudirController extends Controller
{
    public function themes(){

        return view('admin.themes.mudir');
    }
}
