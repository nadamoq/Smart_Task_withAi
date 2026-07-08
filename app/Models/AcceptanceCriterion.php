<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcceptanceCriterion extends Model
{
    //
    protected $fillable = [
        'task_id',
        'criterion',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
