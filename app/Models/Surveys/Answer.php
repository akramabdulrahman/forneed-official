<?php

namespace App\Models\Surveys;

use App\Models\Users\Citizen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @SWG\Definition(
 *      definition="Answer",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question_id",
 *          description="question_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="answer",
 *          description="answer",
 *          type="string"
 *      )
 * )
 */
class Answer extends Model
{
    use SoftDeletes;

    public $table = 'answers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'question_id',
        'answer',
        'order',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer',
        'answer' => 'string',
        'deleted_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function citizens()
    {
        return $this->belongsToMany(Citizen::class);
    }

    public function citizens_count()
    {
        return $this->citizens->count();
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withCitizens', function (Builder $builder) {
            $builder->with('citizens');
        });


    }
}
