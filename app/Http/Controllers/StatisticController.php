<?php

namespace App\Http\Controllers;

use App\Services\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function teachers(Request $request){
        $options=(object)[
            'sort'=>$request['sort']??'DESC',
            'semester'=>$request['semester']??'8-semestr',
            'year'=>$request['year']??date('Y')-1 .'-'.date('Y'),
        ];
        $teachers = Statistic::teachers(auth()->id(),$options);

        return view('admin.statistic.teachers', compact('teachers','options'));

    }
}
