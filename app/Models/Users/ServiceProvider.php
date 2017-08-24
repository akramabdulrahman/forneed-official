<?php

namespace App\Models\Users;

use App\Models\Location\Area;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Surveys\Survey;
use App\Models\Traits\HasExtra;
use App\Models\Traits\HasSectors;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasExtra, HasSectors;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'mission_statement',
        'user_id',
        'mobile_number',
        'phone_number',
        'fax',
        'website',
        'contact_person',
        'contact_person_title',
        'is_accepted'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mission_statement' => 'string',
    ];
    protected $appends = array('name', 'sectorsPopulated', 'areasPopulated', 'extrasPopulated');

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function getNameAttribute()
    {
        if ($this->user()->exists()) {
            return $this->user()->first()->name;
        } else {
            return "No User";
        }
    }

    public function surveys()
    {
        return $this->hasManyThrough(Survey::class, Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getSectorsStringAttribute()
    {
        return $this->sectors()->get()->map->name->pipe(function ($items) {
            return empty($items) ? ['no Sectors'] : $items;
        })->implode(',');
    }

    public function getAreasStringAttribute()
    {
        return $this->areas()->get()->map->name->pipe(function ($items) {
            return empty($items) ? ['no Areas'] : $items;
        })->implode(',');
    }


    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }
}
