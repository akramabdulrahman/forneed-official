<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 6/14/2017
 * Time: 10:31 AM
 */

namespace App\Models\Traits;

use App\Models\Users\Citizen;
use DB;
use App\Models\Extra;

trait HasExtra
{
    public function extras()
    {
        return $this->belongsToMany(Extra::class, snake_case(class_basename(get_class($this))) . '_extras');
    }


    function getExtrasPopulatedAttribute()
    {
        return $this->extrasPopulated()->first();
    }

    public function extrasPopulated()
    {
        $pivotModel = (class_basename(get_class($this)) . 'Extra');
        $class = snake_case(class_basename(get_class($this)));
        $query = $this->hasMany('App\Models\\' . ($pivotModel))
            ->selectRaw("{$class}_id")
            ->selectRaw("count({$class}_extras.id)");
        foreach (config('extra_types.' . $class) as $item) {
            $query->selectRaw(" MAX(IF(extras.name = '{$item}', extras.extra, 0)) AS '$item'");
        }
        $query->join('extras', "{$class}_extras.extra_id", '=', 'extras.id')->groupBy("{$class}_id");;
        return $query;
    }




}