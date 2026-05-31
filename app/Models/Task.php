<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'priority',
    ];

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
}
