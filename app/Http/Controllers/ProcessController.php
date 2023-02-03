<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Theme;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index(){
        $processes=Process::all();

        return view('admin.processes.index',compact('processes'));
    }
    public function student_index(){
        $theme=Theme::all()
            ->where('student_id',session('hemisaboutme')->student_id_number)
            ->first();

        $process=Process::all()
            ->where('theme_id',$theme->id)
            ->first();

        return view('admin.processes.student_index',compact('process'));
    }
}
