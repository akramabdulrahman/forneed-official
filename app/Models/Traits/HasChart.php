<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 7/15/2017
 * Time: 11:49 AM
 */

namespace app\Models\Traits;

use App\Models\Chart;

trait HasChart
{

    public function charts()
    {
        return $this->morphs(Chart::class, 'chartable');
    }
}