<?php

namespace App\Services;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Collection;

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



}