<?php

namespace App\Services;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Statistic
{


    public static function teachers($mudir_id, $options=[]) {
        $teachers = User::with(['themes' => function($query) use ($options) {
            $query->where('semester', $options->semester);
        }])
            ->where('role', 'teacher')
            ->where('mudir_id', $mudir_id)
            ->get();

        $data = $teachers->map(function($teacher) {
            $count = $teacher->themes->count();
            $percentage = $teacher->themes->sum('percentage');
            $new = $teacher->themes->where('status', 'new')->count();
            $progress = $teacher->themes->where('status', 'progress')->count();
            $end = $teacher->themes->where('status', 'end')->count();

            return [
                'teacher' => $teacher,
                'count' => $count,
                'percentage' => $percentage,
                'new' => $new,
                'progress' => $progress,
                'end' => $end,
            ];
        });

        //sort by count
        if ($options->sort == 'ASC')
            $data = $data->sortBy('count');
        else if ($options->sort == 'DESC')
            $data = $data->sortByDesc('count');

        return (object)$data->toArray();
    }

    public static function students($mudir_id,$options){
        $themes = DB::table('themes')
            ->join('users', 'themes.teacher_id', '=', 'users.id')
            ->where('themes.student_id', '<>', 0)
            ->where('users.mudir_id', '=', $mudir_id)
            ->where('themes.semester', '=', $options->semester)
            ->where('themes.group_name', '=', $options->group)
            ->select('themes.student_name', 'themes.status', 'themes.percentage','users.name as teacher_name')
            ->get();
        return $themes;

    }



}