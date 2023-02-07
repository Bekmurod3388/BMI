<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Theme;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        if (session()->has('loggedin')){
            $themes=Theme::all()
                ->where('student_id',0)
                ->where('level',session('hemisaboutme')->level->name)
                ->where('specialty',session('hemisaboutme')->specialty->code);
        }else{
            $themes=Theme::all()->where('teacher_id',auth()->user()->id);
        }
        return view('admin.themes.index', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'specialty' => 'required',
            'level' => 'required',
        ]);

        try {
            ThemeService::create($request->name, $request->description, $request->specialty, $request->level, auth()->user()->id);
            return redirect()->route('themes')->with('msg', 'Mavzu muvaffaqiyatli yaratildi');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Xatolik yuz berdi');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'specialty' => 'required',
            'level' => 'required',
        ]);
        try {
            ThemeService::update($request->id, $request->name, $request->description, $request->specialty, $request->level);
            return redirect()->route('themes')->with('msg', 'Mavzu muvaffaqiyatli yangilandi');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        try {
            ThemeService::delete($request->id);
            return redirect()->route('themes')->with('msg', 'Mavzu muvaffaqiyatli o`chirildi');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getTheme($id)
    {
        $theme = Theme::find($id);
        if ($theme->student_id==0 ){
            if (Theme::all()->where('student_id', '=', session('hemisaboutme')->student_id_number)->count() ==0){
                $theme->group_name = session('hemisaboutme')->group->name;
                $theme->student_name = session('hemisaboutme')->second_name . ' ' . session('hemisaboutme')->first_name . ' ' . session('hemisaboutme')->third_name;
                $theme->student_id = session('hemisaboutme')->student_id_number;
                $theme->save();
                $process = new Process();
                $process->theme_id = $id;
                $process->save();
                return redirect()->route('process')->with('msg', 'Mavzu tanlandi');
            }else{
                return redirect()->route('themes')->withErrors("Siz boshqa mavzuni tanlab bo'lgansiz");
            }
        }else{
            return redirect()->route('themes')->withErrors("Bu mavzu boshqa talaba tomonidan tanlangan");
        }

    }
}
