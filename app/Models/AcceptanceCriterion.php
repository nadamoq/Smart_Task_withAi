<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcceptanceCriterion extends Model
{
    //
    protected $fillable = [
        'task_id',
        'criteria',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
