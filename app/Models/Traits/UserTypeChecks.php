<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 5/16/2017
 * Time: 6:17 PM
 */

namespace App\Models\Traits;

use App\Models\Users\Citizen;
use App\Models\Users\ServiceProvider;
use App\Models\Users\SocialWorker;

trait UserTypeChecks
{
    public function getUserTypes()
    {
        return ([
            'admin',
            'sp',
            'worker',
            'citizen',
        ]);
    }

    public function isServiceProvider()
    {
        return $this->serviceProvider()->exists();
    }

    public function isCitizen()
    {
        return $this->citizen()->exists();
    }

    public function isWorker()
    {
        return $this->worker()->exists();
    }

    /*relations*/
    public function serviceProvider()
    {
        return $this->hasOne(ServiceProvider::class);
    }

    public function citizen()
    {
        return $this->hasOne(Citizen::class);
    }

    public function worker()
    {
        return $this->hasOne(SocialWorker::class);
    }

    public function getUserTypeAttribute()
    {
        return collect([
            trans('user.type_service_provider') => $this->isServiceProvider(),
            trans('user.type_citizen') => $this->isCitizen(),
            trans('user.type_social_worker') => $this->isWorker(),
        ])->filter(function ($val) {
            return $val;
        })->pipe(function ($data) {
            return $data->isEmpty() ?
                $data->merge([trans('user.type_no_type') => true]) :
                $data;
        })->mapWithKeys(function ($row, $key) {
            return [$key];
        })->merge($this->roles()->pluck('name'))->implode(',');
    }

    public function type_relations()
    {
        return collect([
            "serviceProvider" => $this->isServiceProvider(),
            "citizen" => $this->isCitizen(),
            "worker" => $this->isWorker(),
        ])->filter(function ($v, $k) {
            return $v;
        })->keys()->mapWithKeys(function ($v) {
            return [(str_replace('_', ' ', snake_case($v))) => $this->$v()->first()->toArray()];
        });
    }
}
