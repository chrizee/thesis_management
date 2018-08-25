<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervisor extends Model
{
    public static $prefix = ["Engr", "Mr", "Mrs", "Dr", "Prof"];
    use SoftDeletes;

    protected $fillable = [
        "name",
        "title",
        "email",
        "phone",
        "specialization",
        "about"
    ];

    public function thesis()
    {
        return $this->hasMany("App\Thesis");
    }
}
