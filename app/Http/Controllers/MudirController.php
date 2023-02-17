<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class MudirController extends Controller
{
    public function themes(){
        $groups=Theme::select('group_name')
            ->distinct()
            ->whereNotNull('group_name')
            ->get()
            ->pluck('group_name')
            ->toArray();
        $teachers=User::all('id','mudir_id','name')
            ->where('mudir_id',auth()->user()->id)
        ->pluck('name','id')
        ->toArray();
        $mudirId = auth()->user()->id;

        $themes = Theme::whereHas('teacher', function ($query) use ($mudirId) {
            $query->where('mudir_id', $mudirId);
        })
            ->with('process')
            ->get();

        return view('admin.themes.mudir',compact('groups','teachers','themes'));
    }
}
