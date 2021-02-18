<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'subject_name',
        'subject_code',
        'subject_day',
        'time_from',
        'time_to',
        'max_participant',
        'curr_participant',
        'image_path',
        
    ];

    public function users() {
        return $this->belongsToMany(User::class,'subject_user', 'subject_id', 'student_id');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'subject_id', 'id');
    }

    public function videos() {
        return $this->hasMany(Video::class, 'subject_id', 'id');
    }
}
