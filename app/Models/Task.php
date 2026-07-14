<?php

namespace App\Models;

use App\Enums\Priority;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'user_id',
        'attachment',
        'categories_id',
        'project_id',
        'sprint_id',
        'priority',
    ];

    protected function casts(): array
{
    return [
        'priority' => Priority::class,
        'status'=>Status::class
    ];
}
    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeUser($query){

        return $query->where('user_id', auth()->user()->id);
    }
    protected static function booted(){

     static::addGlobalScope('user',function (Builder $query) {
        $query->where('user_id',Auth::user()->id);

     });
    }
    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }
    public function acceptanceCriteria()
    {
        return $this->hasMany(AcceptanceCriterion::class);
    }
}
