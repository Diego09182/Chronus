<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'my_tasks';
    protected $fillable = ['title', 'tag', 'content', 'status', 'progress', 'schedule', 'start_time', 'finish_time', 'importance'];
}
