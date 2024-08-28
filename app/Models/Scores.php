<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    protected $table = "scores";

    protected $primaryKey = ["uid", "sid"];

    public $incrementing = false;

    protected $fillable = [
        "score",
        "start_difficulty",
        "end_difficulty",
    ];

    protected $start_difficulty;

    protected $end_difficulty;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class, 'session_id', 'sid');
    }
}
