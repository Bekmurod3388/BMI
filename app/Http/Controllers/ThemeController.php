<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(){
        $themes=Theme::all();
        dd(session('hemistoken'));
        return view('admin.themes.index',compact('themes'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        //TODO teacher profili bn kirilganda teacher id ni berib yuborish kerak leki  hozircha techaer id 0 ga teng, login , parol yo'qligi uchun
        try {
            ThemeService::createTheme($request->name,$request->description,0);
            return redirect()->route('themes')->with('msg','Mavzu muvaffaqiyatli yaratildi');

        }catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Xatolik yuz berdi');
        }
    }

    public function getTheme($id){
        $theme=Theme::find($id);
        $theme->group_name=session('hemisaboutme')->group->name;
        $theme->student_name=session('hemisaboutme')->second_name.' '.session('hemisaboutme')->first_name.' '.session('hemisaboutme')->third_name;
        $theme->student_id=session('hemisaboutme')->student_id_number;
        $theme->save();
        return redirect()->route('themes')->with('msg','Mavzu tanlandi');


    }
}
