<?php

namespace App\Models;

use App\Models\Location\Area;
use App\Models\Surveys\Survey;
use App\Models\Traits\HasChart;
use App\Models\Users\ServiceProvider;
use App\Models\Users\SocialWorker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @SWG\Definition(
 *      definition="Project",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="serialno",
 *          description="serialno",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sector_id",
 *          description="sector_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="service_provider_id",
 *          description="service_provider_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="marginalized_situation_id",
 *          description="marginalized_situation_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Project extends Model
{
    use SoftDeletes, HasChart;

    public $table = 'projects';
    protected $with = ['extras'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at', 'starts_at', 'expires_at'];


    public $fillable = [
        'name',
        'sponsor',
        'description',
        'sector_id',
        'service_provider_id',
        'area_id',
        'starts_at',
        'expires_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sponsor' => 'string',
        'name' => 'string',
        'expires_at' => 'datetime',
        'starts_at' => 'datetime',

        'description' => 'string',
        'sector_id' => 'integer',
        'service_provider_id' => 'integer',
        'area_id' => 'integer',
        'deleted_at' => 'datetime'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }


    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }


    public function in_targets($val)
    {
        return in_array($val, array_values($this->targets->mapWithKeys(function ($v) {
            return [$v->targetable->name];
        })->toArray()));
    }

    public function workers()
    {
        return $this->belongsToMany(SocialWorker::class);
    }

    public function targets_string()
    {

        return $this->extras->mapWithKeys(function ($v) {
            return [ucfirst(str_replace('_', ' ', snake_case($v->name))) => $v->extra];
        });
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    public function getTargetCriteria()
    {
        return $this->surveys()->get()
        ->map->extras
        ->pipe(function ($result) {
            if (!($result->isEmpty())) {
                return $result->flatten(1)->map->id->unique();
            }
            return $this->extras->map->id;
        });
    }

    public function extra_types()
    {
        return $this->belongsToMany(ExtraType::class);
    }
}
