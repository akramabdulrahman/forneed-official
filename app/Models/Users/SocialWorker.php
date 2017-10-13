<?php

namespace App\Models\Users;

use App\Models\Location\Area;
use App\Models\Project;
use App\Models\Surveys\Survey;
use App\Models\Traits\HasExtra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Flash\Flash;

class SocialWorker extends Model
{
    use HasExtra;
    public $fillable = [
        'is_accepted', 'cv', 'area_id', 'is_accepted', 'address', 'telephone', 'mobile'
    ];
    private $fillableMap = [
        'gender_id' => null,
        'age_id' => null,
    ];
    protected $appends = ['name', 'extrasPopulated'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getNameAttribute()
    {
        
        if ($this->user()->exists()) {
            return $this->user()->first()->name;
        } else {
            return "No User";
        }
    }


    public function calculatePayment($survey)
    {
        $surveys = $this->surveys()->withPivot('count')->where('id', $survey)->select('social_worker_survey.count')->first();
        return [$surveys->count, .5, $surveys->count * .5];
    }


    public function citizens()
    {
        $model = $this;
        if (!$this->projects()->exists()) {
            Flash::warning('You are not Hired in a project yet , 
            stay tuned we will email you once your application gets checked');
            return $this->projects();
        }

        $surveys = $this->projects()
            ->first()->surveys()->get();
        $surveys_ids = $surveys->map->id;
        $surveys_extras = $surveys->map->extras->flatten(1)->pluck('id');
        return
            Citizen::whereDoesntHave('surveys', function ($q) use ($surveys_ids) {
                $q->whereIn('survey_id', $surveys_ids);
            })
            ->whereDoesntHave('user.roles')

                ->whereHas('extras', function ($query) use ($model, $surveys_extras) {
                    $query->whereIn('extras.id',$surveys_extras);
                })
                ->with(array('user'))
            ->selectRaw('distinct citizens.*')->orderBy('id', 'desc');
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class)->withPivot('count');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('withUser', function (Builder $builder) {
            $builder->with('user');
        });
    }
}
