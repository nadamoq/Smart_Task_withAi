<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    //
    protected $guarded = [];
    
    protected static function booted(){

     static::addGlobalScope('user',function (Builder $query) {
        $query->where('user_id',Auth::user()->id);

     });
    }
    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
