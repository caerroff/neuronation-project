<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    protected $table = "scores";

    protected $primaryKey = "score_id";

    public $incrementing = true;

    protected $fillable = [
        "uid",
        "sid",
        "score",
    ];

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
