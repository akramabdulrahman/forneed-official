<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 6/17/2017
 * Time: 12:56 PM
 */

namespace App\Repositories\Traits;


trait DatatableRender
{
    public function getPopulated()
    {
        $table = with(new $this->model())->getTable();

        return $this->model()
            ::with(array('user','extras','sectors','areas'))
            ->selectRaw("distinct {$table}.*")
            ->orderBy('created_at', 'desc');
    }

    public function getPopulatedPivot()
    {
        return $this->model()::all()->map->extrasPopulated->filter()->flatten(1);
    }
}