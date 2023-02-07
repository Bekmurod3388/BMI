<?php

namespace App\Services;

use App\Models\Process;

class ProcessService
{
    public static function create(){

    }
    public static function update($id, $file=null, $desc=null, $link=null){
        $process = Process::find($id);
        if ($file != null){
            $file_name = time() . '_' . $file->getClientOriginalName();
            $path=$file->storeAs('files', $file_name, 'public');
            $path='/storage/'.$path;
            $process->file = $path;
        }
        $process->content = $desc;
        $process->save();
        if ($link != null){
            $headers = get_headers($link);
            $no=!$headers || strpos( $headers[0], '404') ;
            if ($no or !str_contains($link, 'http') or !str_contains($link, 'github.com') ){
                throw new \Exception('Link not valid');
            }
            $process->link = $link;
        }
        $process->save();
        return $process;
    }

}