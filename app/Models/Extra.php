<?php

namespace App\Models;

use App\Models\Users\Citizen;
use App\Models\Users\ServiceProvider;
use App\Models\Users\SocialWorker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extra extends Model
{
    protected $withCount = ['citizens', 'service_providers', 'social_workers'];

    public function citizens()
    {
        return $this->belongsToMany(Citizen::class, 'citizen_extras');
    }

    public function service_providers()
    {
        return $this->belongsToMany(ServiceProvider::class, 'service_provider_extras');
    }

    public function social_workers()
    {
        return $this->belongsToMany(SocialWorker::class, 'social_worker_extras');
    }

    public function attrs_populated($attributes, $model)
    {
        $rel = str_plural(snake_case(class_basename($model)));
        return collect($attributes)->map(function ($row) {
            return explode(':', $row);
        })->groupBy(2)->map(function ($cat) use ($rel) {
            return $cat->mapWithKeys(function ($row) use ($rel) {
                return [$row[0] => $this->$rel()->whereHas('extras', function ($query) use ($row) {
                    return $query->where('extra_id', $row[1]);
                })->count()];
            });
        });
    }


}
