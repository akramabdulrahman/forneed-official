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

    Public function isWorker()
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
        $type = [];
        if ($this->isServiceProvider()) {
            $type[] = trans('user.type_sp');
        }
        if ($this->isCitizen()) {
            $type[] = trans('user.type_citizen');
        }
        if ($this->is_admin) {
            $type[] = trans('user.type_admin');
        }

        if ($this->isWorker()) {
            $type[] = trans('user.type_worker');
        }

        if (empty($type)) {
            return trans('user.type_no_type');
        }
        $type = implode(' , ', $type);
        $roles = $this->roles()->pluck('name')->implode(',');
        return str_replace('_', ' ', empty($roles) ? $type : "[$roles][$type]");
    }
}