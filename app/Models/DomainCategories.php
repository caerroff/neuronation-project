<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainCategories extends Model
{
    use HasFactory;

    protected $table = "domainCategories";

    public $timestamps = false;

    protected $primaryKey = "category_id";

    public $incrementing = true;

    /**
     * @var string
     */
    protected $name;

    protected $fillables = [
        "name",
    ];
}
