<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'file_path',
        'subject_id'
    ];
    
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
