<?php
/**
 * Created by PhpStorm.
 * User: akram
 * Date: 11/10/2016
 * Time: 10:21 AM
 */

namespace App\Models\Traits;


use App\Models\Target;

trait Targetable
{
    public function target()
    {
        return $this->morphMany(Target::class, 'targetable');
    }
}