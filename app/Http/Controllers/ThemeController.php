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
        $themes=Theme::all()
            ->where('teacher_id',auth()->id())
            ->where('specialty',5330600)
            ->where('semester','5-semestr');
        $options = (object)[
            'specialty' => 5330600,
            'status' => 0,
            'semester' => "5-semestr",
        ];
        return view('admin.themes.index', compact('themes', 'options',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'specialty' => 'required',
            'level' => 'required',
            'semester' => 'required',
        ]);

        try {
            ThemeService::create($request->name, $request->description, $request->specialty, $request->level, $request->semester, auth()->user()->id);
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
            'semester' => 'required',
        ]);
        try {
            ThemeService::update($request->id, $request->name, $request->description, $request->specialty, $request->level, $request->semester);
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
                $theme->status = 'process';
                $theme->save();
                $process = new Process();
                $process->theme_id = $id;
                $process->save();
                return redirect()->route('process')->with('msg', 'Mavzu tanlandi');
            }else{
                return redirect()->route('student-themes')->withErrors("Siz boshqa mavzuni tanlab bo'lgansiz");
            }
        }else{
            return redirect()->route('student-themes')->withErrors("Bu mavzu boshqa talaba tomonidan tanlangan");
        }

    }
//for teacher
    public function filter(Request $request)
    {
        $request->validate([
            'specialty' => 'required',
            'semester' => 'required',
            'status' => 'required',
        ]);
        $themes=Theme::all()
            ->where('teacher_id',auth()->id())
        ->when($request->specialty, function ($query) use ($request) {
            return $query->where('specialty', $request->specialty);
        })
        ->when($request->semester, function ($query) use ($request) {
            return $query->where('semester', $request->semester);
        })
        ->when($request->status != 0, function ($query) use ($request) {
            return $query->where('status', $request->status);
        });
        $options = (object)[
            'specialty' => $request->specialty,
            'status' => $request->status,
            'semester' => $request->semester,
        ];



        return view('admin.themes.index', compact('themes','options'));
    }
//for student
    public function themes(){

        $themes=Theme::all()
            ->where('specialty',session('hemisaboutme')->specialty->code)
            ->where('level',session('hemisaboutme')->level->name)
            ->where('semester',session('hemisaboutme')->semester->name)
            ->where('student_id',0);

        $options = (object)[
            'semester' => session('hemisaboutme')->semester->name,

        ];
        return view('admin.themes.student',compact('themes','options'));
    }
    public function themesFilter(Request $request){
        $request->validate([
            'semester'=>'required'
        ]);
        $themes=Theme::all()
            ->where('specialty',session('hemisaboutme')->specialty->code)
            ->where('level',session('hemisaboutme')->level->name)
            ->where('semester',$request->semester)
            ->where('student_id',0);

        $options = (object)[
            'semester' => $request->semester,
        ];
        return view('admin.themes.student',compact('themes','options'));
    }
}
