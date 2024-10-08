<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = "courses";

    protected $primaryKey = "course_id";

    public $incrementing = true;

    /**
     * @var string
     */
    protected $name;

    public $timestamps = true;

    public function sessions()
    {
        return $this->hasMany(Sessions::class, 'session_id', 'course_id');
    }
}
