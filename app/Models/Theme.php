<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function process(){
        return $this->hasOne(Process::class,'theme_id');
    }
}
