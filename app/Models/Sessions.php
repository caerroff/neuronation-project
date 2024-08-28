<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    protected $table = "training_sessions";

    protected $primaryKey = "session_id";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillables = [
        "course_id",
        "category_name",
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');
    }
}
