<?php
/**
 * Created by PhpStorm.
 * User: akramabdulrahman
 * Date: 3/13/2017
 * Time: 1:44 PM
 */

namespace App\Models\Traits;


use App\Models\Users\Citizen;

trait CitizenProp
{

    public function citizensCount()
    {

        return $this->citizens()->selectRaw('count(citizens.id) as aggregate , '.'citizens.' . str_singular($this->getTable()) . '_id')
            ->groupBy(['citizens.' . str_singular($this->getTable()) . '_id'])->orderBy('citizens.' . str_singular($this->getTable()) . '_id');
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }

}

