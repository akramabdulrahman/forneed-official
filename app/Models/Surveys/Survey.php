<?php

namespace App\Models\Surveys;

use App\Models\Chart;
use App\Models\Extra;
use App\Models\Project;
use App\Models\Traits\HasChart;
use App\Models\Users\Citizen;
use App\Models\Users\SocialWorker;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * @SWG\Definition(
 *      definition="Survey",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="subject",
 *          description="subject",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="project_id",
 *          description="project_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="survey_meta_id",
 *          description="survey_meta_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Survey extends Model
{
    use SoftDeletes, HasChart;

    public $table = 'Surveys';
    protected $with = ['extras'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at', 'expires_at', 'starts_at'];


    public $fillable = [
        'subject',
        'starts_at',
        'expires_at',
        'description',
        'project_id',
        'survey_meta_id',
        'deleted_at',
        'questions_count'
    ];

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject' => 'string',
        'expires_at' => 'datetime',
        'starts_at' => 'datetime',
        'description' => 'string',
        'project_id' => 'integer',
        'survey_meta_id' => 'integer',
        'deleted_at' => 'datetime'
    ];
    protected $appends = ['progress'];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function charts()
    {
        return $this->morphMany(Chart::class, 'chartable');
    }

    public function getTargetCriteria()
    {
        return $this->extras->map->id;
    }
    public function targets_string()
    {

        return $this->extras->mapWithKeys(function ($v) {
            return [ucfirst(str_replace('_', ' ', snake_case($v->name))) => $v->extra];
        });
    }
    public function related_charts()
    {
        return $this->charts()->get()->map(function ($v) {
            return Charts::create($v->theme_chart, $v->theme_lib)
                ->title($v->chart_title)
                ->elementLabel($v->element_label)
                ->responsive(false)
                ->dimensions(0, 300)
                ->labels($v->labels)
                ->values($v->values)
                ->responsive(false)->width(0)->height(300);
        });
    }

    public function getProgressAttribute()
    {
        $expire = $this->expires_at ? $this->expires_at->timestamp : Carbon::now()->addMonths(12)->timestamp;
        $starts = $this->starts_at ? $this->starts_at->timestamp : Carbon::now()->timestamp;
        $result = ($expire - Carbon::now()->timestamp) / (($expire - $starts) + 1);
        return ($result >= 0) ? $result : 0;
    }

    public function Config()
    {
        return $this->belongsToMany(Config::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function citizens()
    {
        return $this->belongsToMany(Citizen::class)->withPivot('is_final_step');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function SocialWorkers()
    {
        return $this->belongsToMany(SocialWorker::class);
    }

    public function SocialWorkers_string()
    {
        return $this->SocialWorkers->mapWithKeys(function ($v) {

            return [$v->user->name];
        })->implode(',');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {

        parent::boot();

        static::addGlobalScope('withQuestions', function (Builder $builder) {
            $builder->with('questions');
        });

        static::addGlobalScope('withWorkers', function (Builder $builder) {
            $builder->with('SocialWorkers');
        });
    }
}
