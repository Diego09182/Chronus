<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'title', 'content'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
