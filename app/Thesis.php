<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string name
 * @property string abstract
 * @property string authors
 * @property integer author_phone
 * @property string author_email
 * @property integer tag_id
 * @property integer level_id
 * @property integer supervisor_id
 * @property string location
 * @property boolean published
 * @property integer session
 */
class Thesis extends Model
{
    use SoftDeletes;

    protected $table = "theses";

    protected $fillable = [
        'name',
        'abstract',
        'authors',
        'author_phone',
        'author_email',
        'tag_id',
        'level_id',
        'supervisor_id',
        'location',
        'published',
        'session'
    ];

    public function supervisor()
    {
        return $this->belongsTo("App\Supervisor");
    }

    public function level()
    {
        return $this->belongsTo("App\Level");
    }

    public function tag()
    {
        return $this->belongsTo("App\Tag");
    }
}
