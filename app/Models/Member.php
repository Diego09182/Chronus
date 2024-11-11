<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'name', 'position'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
