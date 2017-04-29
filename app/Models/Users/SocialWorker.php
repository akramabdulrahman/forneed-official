<?php

namespace App\Models\Users;

use App\Models\Age;
use App\Models\Gender;
use App\Models\Location\Area;
use App\Models\Project;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SocialWorker extends Model
{
    public $fillable = [
        'is_accepted', 'cv', 'area_id', 'is_accepted', 'address', 'telephone', 'mobile'
    ];
    private $fillableMap = [
        'gender_id' => null,
        'age_id' => null,

    ];
    protected $appends = ['name'];

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




    public function surveys()
    {
        return $this->belongsToMany(Survey::class);
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
