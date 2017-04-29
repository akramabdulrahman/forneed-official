<?php

namespace App\Models;

use App\Models\Location\Area;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Targetable;
use Illuminate\Database\Eloquent\Builder;

class Target extends Model
{
    /*todo complete rewrite*/
    protected $fillable = ['project_id', 'targetable_id', 'targetable_type'];
    public static $types =
        [
            'gender' => Gender::class,
            'age' => Age::class,
            'area' => Area::class,
            'marital' => MaritalStatus::class,
            'workstat' => WorkingState::class,
            'refugee' => RefugeeState::class,
            'disability' => Disability::class,
            'academic' => AcademicLevel::class,
            'workfield' => WorkField::class,
        ];

    public static function getMultTypes()
    {
        return [
            'gender' => ['base' => Gender::class, 'val' => Gender::all()->pluck('name', 'id')->toArray()],
            'age' =>['base' => Age::class, 'val' => Age::all()->pluck('name', 'id')->toArray()],
            'area' => ['base' => Area::class, 'val' => Area::all()->pluck('name', 'id')->toArray()],
            'marital' => ['base' => MaritalStatus::class, 'val' => MaritalStatus::all()->pluck('name', 'id')->toArray()],
            'workstat' => ['base' => WorkingState::class, 'val' => WorkingState::all()->pluck('name', 'id')->toArray()],
            'refugee' => ['base' => RefugeeState::class, 'val' => RefugeeState::all()->pluck('name', 'id')->toArray()],
            'disability' => ['base' => Disability::class, 'val' => Disability::all()->pluck('name', 'id')->toArray()],
            'academic' =>['base' => AcademicLevel::class, 'val' => AcademicLevel::all()->pluck('name', 'id')->toArray()],
            'workfield' =>['base' => WorkField::class, 'val' => WorkField::all()->pluck('name', 'id')->toArray()],
        ];
    }


    public function targetable()
    {
        return $this->morphTo();
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withTargetable', function (Builder $builder) {
            $builder->with('targetable');
        });
    }

}
