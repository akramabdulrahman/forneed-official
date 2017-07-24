<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 7/1/2017
 * Time: 12:19 AM
 */

namespace App\Models\Traits;


use App\Models\Location\Area;
use App\Models\Sector;

trait HasSectors
{
    public function getSectorsPopulatedAttribute()
    {
        return $this->sectorsPopulated()->get()->map->name->implode(',');
    }

    public function getAreasPopulatedAttribute()
    {
        return $this->areasPopulated()->get()->map->name->implode(',');
    }

    public function sectorsPopulated()
    {
        return $this->populated(Sector::class);
    }

    public function areasPopulated()
    {
        return $this->populated(Area::class);
    }

    private function populated($relation)
    {
        return $this->belongsToMany($relation);
    }
}