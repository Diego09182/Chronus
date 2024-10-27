<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'tag', 'content', 'status', 'progress', 'schedule', 'start_time', 'finish_time', 'importance'];

    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function remarks()
    {
        return $this->hasMany(Remark::class);
    }
}
