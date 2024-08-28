<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    use HasFactory;

    protected $table = "exercises";

    protected $primaryKey = "exercise_id";

    public $incrementing = true;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $points;

    protected $fillables = [
        "course_id",
        "cat_id",
        "name",
        "points",
    ];

    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');
    }

    public function category()
    {
        return $this->belongsTo(DomainCategories::class, 'cat_id', 'category_id');
    }
}
