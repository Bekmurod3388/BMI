<?php

namespace App\Services;
use App\Models\Theme;
class ThemeService
{
    public static function createTheme($name,$description,$teacher_id=0){
        $theme=new Theme();
        $theme->name=$name;
        $theme->description=$description;
        $theme->teacher_id=$teacher_id;
        $theme->save();
        return $theme;
    }


}