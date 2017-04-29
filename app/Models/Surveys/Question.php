<?php

namespace App\Models\Surveys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @SWG\Definition(
 *      definition="Question",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="body",
 *          description="body",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="survey_id",
 *          description="survey_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="step",
 *          description="step",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rule",
 *          description="rule",
 *          type="string"
 *      )
 * )
 */
class Question extends Model
{
    use SoftDeletes;

    public $table = 'questions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'body',
        'survey_id',
        'step',
        'order',
        'deleted_at'
    ];
    public function charts()
    {
        return $this->morphMany(Chart::class, 'chartable');
    }
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'survey_id' => 'integer',
        'step' => 'integer',
        'rule' => 'string',
        'deleted_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('order');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withAnswers', function (Builder $builder) {
            $builder->with('answers');
        });
    }
}
